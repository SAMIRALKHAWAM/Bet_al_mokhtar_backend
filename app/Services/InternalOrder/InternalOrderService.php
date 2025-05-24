<?php

namespace App\Services\InternalOrder;

use App\Models\InternalOrder;
use App\Services\BaseService;

class InternalOrderService extends BaseService
{
    public function __construct(InternalOrder $model)
    {
        $this->model = $model;
    }
}
