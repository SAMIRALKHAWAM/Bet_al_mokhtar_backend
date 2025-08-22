<?php

namespace App\Services\TableReservation;

use App\Models\TableReservation;
use App\Services\BaseService;

class TableReservationService extends BaseService
{
    public function __construct(TableReservation $model)
    {
        $this->model = $model;
    }
}
