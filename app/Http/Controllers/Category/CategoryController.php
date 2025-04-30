<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\BaseCRUDController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryIdRequest;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Services\Category\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends BaseCRUDController
{

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
        $this->createRequest = CreateCategoryRequest::class;
        $this->updateRequest = UpdateCategoryRequest::class;
        $this->idRequest = CategoryIdRequest::class;
    }
}
