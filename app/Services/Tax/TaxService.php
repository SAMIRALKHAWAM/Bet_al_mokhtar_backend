<?php

namespace App\Services\Tax;

use App\Models\Tax;
use App\Services\BaseService;

class TaxService extends BaseService
{

    public function __construct(Tax $model)
    {
        $this->model = $model;
    }

}
