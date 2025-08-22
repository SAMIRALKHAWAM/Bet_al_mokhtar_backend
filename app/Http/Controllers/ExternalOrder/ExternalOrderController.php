<?php

namespace App\Http\Controllers\ExternalOrder;

use App\Http\Controllers\BaseCRUDController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExternalOrder\AcceptExternalOrderRequest;
use App\Http\Requests\ExternalOrder\ChangeExternalOrderStatusRequest;
use App\Http\Requests\ExternalOrder\CreateExternalOrderRequest;
use App\Http\Requests\InternalOrder\ChangeInternalOrderStatusRequest;
use App\Services\ExternalOrder\ExternalOrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ExternalOrderController extends BaseCRUDController
{
    public function __construct(ExternalOrderService $service)
    {
        $this->service = $service;
        $this->createRequest = CreateExternalOrderRequest::class;
    }

    public function ChangeExternalOrderStatus($id, ChangeExternalOrderStatusRequest $request)
    {
        $data = Arr::only($request->validated(), ['status', 'id','deliveryman_id']);
        $this->service->ChangeExternalOrderStatus($id, $data);
        return $this->sendResponse(__('custom.Success'));
    }

    public function AcceptExternalOrder($id,AcceptExternalOrderRequest $request){
        $data = Arr::only($request->validated(), ['user_id', 'id']);
        $this->service->AcceptExternalOrder($id, $data);
        return $this->sendResponse(__('custom.Success'));
    }
}
