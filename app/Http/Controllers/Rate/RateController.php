<?php

namespace App\Http\Controllers\Rate;

use App\Http\Controllers\BaseCRUDController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Rate\CreateRateRequest;
use App\Services\Rate\RateService;
use Illuminate\Http\Request;

class RateController extends BaseCRUDController
{
    public function __construct(RateService $service)
    {
        $this->service = $service;
        $this->createRequest = CreateRateRequest::class;
    }


}
