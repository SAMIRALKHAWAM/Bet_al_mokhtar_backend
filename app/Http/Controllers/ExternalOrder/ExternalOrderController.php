<?php

namespace App\Http\Controllers\ExternalOrder;

use App\Http\Controllers\BaseCRUDController;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExternalOrder\CreateExternalOrderRequest;
use App\Services\ExternalOrder\ExternalOrderService;
use Illuminate\Http\Request;

class ExternalOrderController extends BaseCRUDController
{
    public function __construct(ExternalOrderService $service)
    {
        $this->service = $service;
        $this->createRequest = CreateExternalOrderRequest::class;
    }
}
