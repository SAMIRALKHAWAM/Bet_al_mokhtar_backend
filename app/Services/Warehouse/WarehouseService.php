<?php

namespace App\Services\Warehouse;

use App\Models\Warehouse;
use App\Services\BaseService;

class WarehouseService extends BaseService
{
    public function __construct(Warehouse $model)
    {
        $this->model = $model;
    }
}
