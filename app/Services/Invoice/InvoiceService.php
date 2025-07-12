<?php

namespace App\Services\Invoice;

use App\Enum\OrderStatusEnum;
use App\Http\Requests\Invoice\ShowInvoicesRequest;
use App\Models\Discount;
use App\Models\Invoice;
use App\Models\InvoiceDiscount;
use App\Models\InvoiceTax;
use App\Models\Tax;
use App\Services\BaseService;

class InvoiceService extends BaseService
{

    public function __construct(Invoice $model)
    {
        $this->model = $model;
    }

    public function ChangeInvoiceStatus($id, $data)
    {
        $invoice = $this->getOne($id);
        $invoice->update(['status' => $data['status']]);
        if ($data['status'] == OrderStatusEnum::DONE) {
            $invoice->internalOrders()->update([
                'status' => OrderStatusEnum::DONE,
            ]);
            $invoice->Table()->update([
                'invoice_id' => null,
                'available' => 1
            ]);
        }elseif ($data['status'] == OrderStatusEnum::PRINT){
            if (!empty($data['discount_id'])){
                $discount = Discount::find($data['discount_id']);
                $amount = ($discount->percent * $invoice->full_price) / 100 ;
                InvoiceDiscount::create([
                    'invoice_id' => $invoice->id,
                    'discount_id' => $discount->id,
                    'percent' => $discount->percent,
                    'amount' => $amount
                ]);
                $invoice->update(['discount' => $amount]);
            }

            if (($data['discount'] > 0 )){
                $invoice->increment('discount',$data['discount']);
            }

            $taxes = Tax::get();
            foreach ($taxes as $tax){
                $amount = ($tax->percent * $invoice->full_price) / 100 ;
                InvoiceTax::create([
                    'invoice_id' => $invoice->id,
                    'tax_id' => $tax->id,
                    'percent' => $tax->percent,
                    'amount' => $amount
                ]);
                $invoice->increment('tax',$amount);
            }

            $final_price = $invoice->full_price + $invoice->tax - $invoice->discount;
            $invoice->update(['final_price' => $final_price]);
        }
    }

    public function PrintInvoice($id){
        $invoice = $this->getOne($id);
        $offersGrouped = collect();
        $productsGrouped = collect();

        foreach ($invoice->InternalOrders as $order) {
            foreach ($order->internalOrderOffers as $orderOffer) {
                $offer = $orderOffer->Offer;
                if (!$offer) continue;

                if ($offersGrouped->has($offer->id)) {
                    $existing = $offersGrouped->get($offer->id);
                    $existing['quantity'] += $orderOffer->quantity;
                    $existing['total_price'] += $offer->price * $orderOffer->quantity;
                    $offersGrouped->put($offer->id, $existing);
                } else {
                    $offersGrouped->put($offer->id, [
                        'id' => $offer->id,
                        'name' => $offer->name,
                        'description' => $offer->description,
                        'price' => $offer->price,
                        'quantity' => $orderOffer->quantity,
                        'total_price' => $offer->price * $orderOffer->quantity,
                    ]);
                }
            }
        }

        foreach ($invoice->InternalOrders as $order) {
            foreach ($order->internalOrderLines as $orderLine) {
                $item = $orderLine->item;
                if (!$item) continue;

                if ($productsGrouped->has($item->id)) {
                    $existing = $productsGrouped->get($item->id);
                    $existing['quantity'] += $orderLine->quantity;
                    $existing['total_price'] += $item->price * $orderLine->quantity;
                    $productsGrouped->put($item->id, $existing);
                } else {
                    $productsGrouped->put($item->id, [
                        'id' => $item->id,
                        'name' => $item->name,
                        'description' => $item->description ?? '',
                        'price' => $item->price,
                        'quantity' => $orderLine->quantity,
                        'total_price' => $item->price * $orderLine->quantity,
                    ]);
                }
            }
        }
        $invoice = $this->getOne($id);
        $res['invoice'] = $invoice;
        $res['items'] = $productsGrouped->values();
        $res['offers'] = $offersGrouped->values();
        $res['taxes'] = $invoice->InvoiceTaxes;
        $res['discounts'] = $invoice->InvoiceDiscounts;
        unset($invoice->InvoiceTaxes,$invoice->InvoiceDiscounts);
        return $res;

    }

    public function getAllPagination($where = [])
    {
        $data = \app(ShowInvoicesRequest::class);
        if (!empty($data['branchId'])){
            $where[] = ['branch_id',$data['branchId']];
        }
        if (!empty($data['status'])){
            $where[] = ['status',$data['status']];
        }
        return parent::getAllPagination($where); // TODO: Change the autogenerated stub
    }
}
