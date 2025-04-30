<?php

namespace App\Services\Branch;


use App\Models\Branch;
use App\Services\BaseService;

class BranchService extends BaseService
{

    public function __construct(Branch $model)
    {
       $this->model = $model;

    }

}
