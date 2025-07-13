<?php

namespace App\Http\Controllers\WarehouseMaterial;

use App\Http\Controllers\BaseCRUDController;
use App\Http\Controllers\Controller;
use App\Http\Requests\WarehouseMaterial\AddWarehouseMaterialsReqest;
use App\Http\Requests\WarehouseMaterial\AddWarehouseMaterialsRequest;
use App\Http\Requests\WarehouseMaterial\RemoveWarehouseMaterialsRequest;
use App\Services\WarehouseMaterial\WarehouseMaterialService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class WarehouseMaterialController extends BaseCRUDController
{
    public function __construct(WarehouseMaterialService $service)
    {
        $this->service = $service;
    }

    public function AddWarehouseMaterials(AddWarehouseMaterialsRequest $request){
        $data = Arr::only($request->validated(),['branch_id','warehouseman_id','materials']);
        $this->service->AddWarehouseMaterials($data);
        return $this->sendResponse(__('custom.Success'));

    }

    public function RemoveWarehouseMaterials(RemoveWarehouseMaterialsRequest $request){
        $data = Arr::only($request->validated(),['branch_id','warehouseman_id','materials']);
        $this->service->RemoveWarehouseMaterials($data);
        return $this->sendResponse(__('custom.Success'));

    }
}
