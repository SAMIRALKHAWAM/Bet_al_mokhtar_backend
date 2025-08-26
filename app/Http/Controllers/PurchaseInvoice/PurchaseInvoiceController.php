<?php

namespace App\Http\Controllers\PurchaseInvoice;

use App\Http\Controllers\BaseCRUDController;
use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseInvoice\CreatePurchaseInvoiceRequest;
use App\Http\Requests\PurchaseInvoice\PurchaseInvoiceIdRequest;
use App\Services\PurchaseInvoice\PurchaseInvoiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PurchaseInvoiceController extends BaseCRUDController
{
    public function __construct(PurchaseInvoiceService $service)
    {
        $this->service = $service;
        $this->createRequest = CreatePurchaseInvoiceRequest::class;
        $this->idRequest = PurchaseInvoiceIdRequest::class;
    }

    public function GetPurchaseInvoiceLines($id,PurchaseInvoiceIdRequest $request){
        $data = Arr::only($request->validated(),['id']);
        $res = $this->service->GetPurchaseInvoiceLines($id,$data);
        return $this->sendResponse(__('custom.Success'), $res);
    }
}
