<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\BaseCRUDController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Item\AddItemImagesRequest;
use App\Http\Requests\Item\CreateItemRequest;
use App\Http\Requests\Item\DeleteItemImagesRequest;
use App\Http\Requests\Item\ItemIdRequest;
use App\Http\Requests\Item\ShowItemsRequest;
use App\Http\Requests\Item\UpdateItemRequest;
use App\Services\Item\ItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ItemController extends BaseCRUDController
{

    public function __construct(ItemService $service)
    {
        $this->service = $service;
        $this->createRequest = CreateItemRequest::class;
        $this->updateRequest = UpdateItemRequest::class;
        $this->idRequest = ItemIdRequest::class;
    }

    public function AddItemImages($id,AddItemImagesRequest $request){
        $arr = Arr::only($request->validated(),['images']);
        $this->service->AddItemImages($id,$arr['images']);
        return $this->sendResponse(__('custom.Success'));
    }


    public function DeleteItemImages($id,DeleteItemImagesRequest $request){
        $arr = Arr::only($request->validated(),['images']);
        $this->service->DeleteItemImages($arr['images']);
        return $this->sendResponse(__('custom.Success'));
    }
}
