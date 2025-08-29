<?php

namespace App\Http\Controllers\Warehouse;

use App\Http\Controllers\BaseCRUDController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Warehouse\WarehouseIdRequest;
use App\Services\Warehouse\WarehouseService;
use Illuminate\Http\Request;

class WarehouseController extends BaseCRUDController
{

    public function __construct(WarehouseService $service)
    {
        $this->service = $service;
        $this->idRequest = WarehouseIdRequest::class;
    }

}
