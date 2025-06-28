<?php

namespace App\Http\Controllers\InternalOrder;

use App\Enum\OrderStatusEnum;
use App\Http\Controllers\BaseCRUDController;
use App\Http\Controllers\Controller;
use App\Http\Requests\InternalOrder\ChangeInternalOrderStatusRequest;
use App\Http\Requests\InternalOrder\CreateInternalOrderRequest;
use App\Http\Requests\InternalOrder\InternalOrderIdRequest;
use App\Models\InternalOrder;
use App\Services\InternalOrder\InternalOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class InternalOrderController extends BaseCRUDController
{
    public function __construct(InternalOrderService $service)
    {
        $this->service = $service;
        $this->createRequest = CreateInternalOrderRequest::class;
        $this->idRequest = InternalOrderIdRequest::class;
    }


    public function ChangeInternalOrderStatus($id, ChangeInternalOrderStatusRequest $request)
    {
        $data = Arr::only($request->validated(), ['table_id', 'branch_id', 'status', 'id']);
        $this->service->ChangeInternalOrderStatus($id, $data);
        return $this->sendResponse(__('custom.Success'));
    }

    public function GetInternalOrderItems($id, InternalOrderIdRequest $request)
    {
        $data = Arr::only($request->validated(), ['id']);
        $res = $this->service->GetInternalOrderItems($id);
        return $this->sendResponse(__('custom.Success'),$res);
    }
}
