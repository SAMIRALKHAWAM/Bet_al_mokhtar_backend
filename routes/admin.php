<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Branch\BranchController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\InternalOrder\InternalOrderController;
use App\Http\Controllers\Item\ItemController;
use App\Http\Controllers\Offer\OfferController;
use App\Http\Controllers\Rate\RateController;
use App\Http\Controllers\Table\TableController;
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


Route::controller(EmployeeController::class)->group(function () {
    Route::post('/create_employee', 'store');
    Route::delete('/delete_one_employee/{id}', 'destroy');
    Route::get('/get_one_employee/{id}', 'get_one');
    Route::get('/get_employees', 'indexPagination');
    Route::post('/update_one_employee/{id}', 'update');

});


Route::controller(TableController::class)->group(function () {
    Route::post('/create_table', 'store');
    Route::delete('/delete_one_table/{id}', 'destroy')->name('delete_table');
    Route::get('/get_one_table/{id}', 'get_one');
    Route::get('/get_tables', 'indexPagination');
    Route::post('/update_one_table/{id}', 'update');

});

Route::controller(OfferController::class)->group(function (){
    Route::post('/create_offer', 'store');
    Route::delete('/delete_one_offer/{id}', 'destroy');
    Route::get('/get_one_offer/{id}', 'get_one');
    Route::get('/get_offers', 'indexPagination');
});

Route::controller(InternalOrderController::class)->group(function () {
    Route::post('/create_internal_order', 'store');

});

