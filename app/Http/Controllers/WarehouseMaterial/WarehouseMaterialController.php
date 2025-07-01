<?php

namespace App\Http\Controllers\WarehouseMaterial;

use App\Http\Controllers\BaseCRUDController;
use App\Http\Controllers\Controller;
use App\Services\WarehouseMaterial\WarehouseMaterialService;
use Illuminate\Http\Request;

class WarehouseMaterialController extends BaseCRUDController
{
    public function __construct(WarehouseMaterialService $service)
    {
        $this->service = $service;
    }
}
