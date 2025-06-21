<?php

namespace App\Http\Controllers\Offer;

use App\Http\Controllers\BaseCRUDController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Offer\CreateOfferRequest;
use App\Http\Requests\Offer\OfferIdRequest;
use App\Services\Offer\OfferService;
use Illuminate\Http\Request;

class OfferController extends BaseCRUDController
{

    public function __construct(OfferService $service)
    {
        $this->service = $service;
        $this->createRequest = CreateOfferRequest::class;
        $this->idRequest = OfferIdRequest::class;
    }


}
