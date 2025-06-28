<?php

namespace App\Http\Controllers\Invoice;

use App\Enum\OrderStatusEnum;
use App\Http\Controllers\BaseCRUDController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Invoice\ChangeInvoiceStatusRequest;
use App\Http\Requests\Invoice\InvoiceIdRequest;
use App\Models\Invoice;
use App\Services\Invoice\InvoiceService;
use App\Services\Item\ItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class InvoiceController extends BaseCRUDController
{
    public function __construct(InvoiceService $service)
    {
        $this->service = $service;
        $this->idRequest = InvoiceIdRequest::class;
    }

    public function ChangeInvoiceStatus($id, ChangeInvoiceStatusRequest $request)
    {
        $data = Arr::only($request->validated(), ['table_id', 'branch_id', 'status', 'id','discount','discount_id']);
        $this->service->ChangeInvoiceStatus($id,$data);
        return $this->sendResponse(__('custom.Success'));
    }

    public function PrintInvoice($id,InvoiceIdRequest $request)
    {
        $data = Arr::only($request->validated(), ['id']);
        $res = $this->service->PrintInvoice($id);
        return $this->sendResponse(__('custom.Success'),$res);
    }


}
