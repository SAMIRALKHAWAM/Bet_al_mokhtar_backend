<?php

namespace App\Services\Material;

use App\Models\Material;
use App\Services\BaseService;

class MaterialService extends BaseService
{
    public function __construct(Material $model)
    {
        $this->model = $model;
    }

}
