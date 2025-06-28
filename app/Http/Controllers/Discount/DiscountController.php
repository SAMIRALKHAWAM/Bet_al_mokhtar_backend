<?php

namespace App\Http\Controllers\Discount;

use App\Http\Controllers\BaseCRUDController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Discount\CreateDiscountRequest;
use App\Http\Requests\Discount\DiscountIdRequest;
use App\Http\Requests\Discount\UpdateDiscountRequest;
use App\Services\Discount\DiscountService;
use Illuminate\Foundation\Events\DiscoverEvents;
use Illuminate\Http\Request;

class DiscountController extends BaseCRUDController
{
    public function __construct(DiscountService $service)
    {
        $this->service = $service;
        $this->createRequest = CreateDiscountRequest::class;
        $this->idRequest = DiscountIdRequest::class;
        $this->updateRequest = UpdateDiscountRequest::class;
    }
}
