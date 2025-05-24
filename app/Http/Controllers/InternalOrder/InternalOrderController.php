<?php

namespace App\Http\Controllers\InternalOrder;

use App\Http\Controllers\BaseCRUDController;
use App\Http\Controllers\Controller;
use App\Services\InternalOrder\InternalOrderService;
use Illuminate\Http\Request;

class InternalOrderController extends BaseCRUDController
{
    public function __construct(InternalOrderService $service)
    {
        $this->service = $service;
    }
}
