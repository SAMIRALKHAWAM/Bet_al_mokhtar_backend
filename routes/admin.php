<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Branch\BranchController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Item\ItemController;
use App\Http\Controllers\Rate\RateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::controller(BranchController::class)->group(function () {
    Route::post('/create_branch', 'store');
    Route::post('/update_one_branch/{id}', 'update');
    Route::get('/get_branches', 'index');
    Route::get('/get_one_branch/{id}', 'get_one');
    Route::delete('/delete_one_branch/{id}', 'destroy');
});

Route::controller(CategoryController::class)->group(function () {
    Route::post('/create_category', 'store');
    Route::post('/update_one_category/{id}', 'update');
    Route::get('/get_categories', 'index');
    Route::get('/get_one_category/{id}', 'get_one');
    Route::delete('/delete_one_category/{id}', 'destroy');
});

Route::controller(ItemController::class)->group(function () {
    Route::post('/create_item', 'store');
    Route::get('/get_items', 'index');
    Route::get('/get_one_item/{id}', 'get_one');
    Route::delete('/delete_one_item/{id}', 'destroy');
    Route::post('/update_one_item/{id}', 'update');
    Route::post('/add_item_images/{id}','AddItemImages');
    Route::post('/delete_item_images/{id}','DeleteItemImages');
});

Route::controller(RateController::class)->group(function () {
    Route::post('/create_rate', 'store');
    Route::get('/get_rates', 'index');

});

