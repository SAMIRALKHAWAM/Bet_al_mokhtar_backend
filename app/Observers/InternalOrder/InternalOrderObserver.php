<?php

namespace App\Observers\InternalOrder;

use App\Models\InternalOrder;
use App\Models\InternalOrderItem;
use App\Models\InternalOrderOffer;
use App\Models\Item;
use App\Models\Offer;
use App\Traits\FileTrait;

class InternalOrderObserver
{
    use FileTrait;

    /**
     * Handle the User "created" event.
     */
    public function created(InternalOrder $internalOrder): void
    {
       $full_price = 0.00;
       $items = \request()->items;
       $offers = \request()->offers;
        if (!empty($items)) {
            $full_price += $this->AddInternalOrderItems($internalOrder->id, $items);
        }

        if (!empty($offers)) {
            $full_price += $this->AddInternalOrderoffers($internalOrder->id, $offers);
        }
        $internalOrder->update(['full_price' => $full_price]);
     }

    private function AddInternalOrderItems( $id,  $items)
    {
        $price = 0.00;
        foreach ($items as $item){
        $neededItem = Item::find($item['item_id']);
        $internalOrderItem = InternalOrderItem::create([
            'internal_order_id' => $id,
            'item_id' => $item['item_id'],
            'quantity' => $item['quantity'],
            'price' => $item['quantity'] * $neededItem->price
        ]);
        $price += $internalOrderItem->price;
        }
        return $price;
    }

    private function AddInternalOrderoffers( $id,  $offers)
    {
        $price = 0.00;
        foreach ($offers as $offer){
            $neededOffer = Offer::find($offer['offer_id']);
            $internalOrderOffer = InternalOrderOffer::create([
                'internal_order_id' => $id,
                'offer_id' => $offer['offer_id'],
                'quantity' => $offer['quantity'],
                'price' => $offer['quantity'] * $neededOffer->price
            ]);
            $price += $internalOrderOffer->price;
        }
        return $price;
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(InternalOrder $internalOrder): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(InternalOrder $internalOrder): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(InternalOrder $internalOrder): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(InternalOrder $internalOrder): void
    {
        //
    }


}
