<?php

namespace App\Http\Controllers\TableReservation;

use App\Http\Controllers\BaseCRUDController;
use App\Http\Controllers\Controller;
use App\Http\Requests\TableReservation\CreateTableReservationRequest;
use App\Services\TableReservation\TableReservationService;
use Illuminate\Http\Request;

class TableReservationController extends BaseCRUDController
{
    public function __construct(TableReservationService $service)
    {
        $this->service = $service;
        $this->createRequest = CreateTableReservationRequest::class;
    }
}
