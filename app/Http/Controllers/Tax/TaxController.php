<?php

namespace App\Http\Controllers\Tax;

use App\Http\Controllers\BaseCRUDController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tax\CreateTaxRequest;
use App\Http\Requests\Tax\TaxIdRequest;
use App\Http\Requests\Tax\UpdateTaxRequest;
use App\Services\Tax\TaxService;
use Illuminate\Http\Request;

class TaxController extends BaseCRUDController
{
    public function __construct(TaxService $service)
    {
        $this->service = $service;
        $this->createRequest = CreateTaxRequest::class;
        $this->idRequest = TaxIdRequest::class;
        $this->updateRequest = UpdateTaxRequest::class;
    }
}
