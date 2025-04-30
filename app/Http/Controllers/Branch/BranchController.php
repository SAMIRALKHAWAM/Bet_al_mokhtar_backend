<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\BaseCRUDController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Branch\BranchIdRequest;
use App\Http\Requests\Branch\CreateBranchRequest;
use App\Http\Requests\Branch\UpdateBranchRequest;
use App\Services\Branch\BranchService;
use Illuminate\Http\Request;

class BranchController extends BaseCRUDController
{

    public function __construct(BranchService $service)
    {
        $this->service = $service;
        $this->createRequest = CreateBranchRequest::class;
        $this->updateRequest = UpdateBranchRequest::class;
        $this->idRequest = BranchIdRequest::class;
    }


}
