<?php

namespace App\Http\Controllers\Material;

use App\Http\Controllers\BaseCRUDController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Material\CreateMaterialRequest;
use App\Http\Requests\Material\MaterialIdRequest;
use App\Http\Requests\Material\UpdateMaterialRequest;
use App\Services\Material\MaterialService;
use Illuminate\Http\Request;

class MaterialController extends BaseCRUDController
{
    public function __construct(MaterialService $service)
    {
        $this->service = $service;
        $this->createRequest = CreateMaterialRequest::class;
        $this->idRequest = MaterialIdRequest::class;
        $this->updateRequest = UpdateMaterialRequest::class;
    }
}
