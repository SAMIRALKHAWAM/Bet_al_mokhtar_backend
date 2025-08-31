<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Branch\BranchController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Discount\DiscountController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\ExternalOrder\ExternalOrderController;
use App\Http\Controllers\InternalOrder\InternalOrderController;
use App\Http\Controllers\Invoice\InvoiceController;
use App\Http\Controllers\Item\ItemController;
use App\Http\Controllers\Material\MaterialController;
use App\Http\Controllers\Offer\OfferController;
use App\Http\Controllers\Rate\RateController;
use App\Http\Controllers\Table\TableController;
use App\Http\Controllers\TableReservation\TableReservationController;
use App\Http\Controllers\Tax\TaxController;
use App\Http\Controllers\Warehouse\WarehouseController;
use App\Http\Controllers\WarehouseMaterial\WarehouseMaterialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/user_login', 'Login')->name('user_login');
});


Route::middleware(['auth:User', 'scope:User'])->group(function () {
    Route::controller(AuthController::class)->group(function () {

        Route::post('/user_login', 'Login')->name('user_login');
    });


    Route::controller(ItemController::class)->group(function () {
        Route::get('/get_items', 'index');
        Route::get('/get_one_item/{id}', 'get_one');
    });

    Route::controller(OfferController::class)->group(function () {
        Route::get('/get_offers', 'indexPagination');
    });

    Route::controller(TableReservationController::class)->group(function () {


        Route::post('/add_table_reservation', 'store');

    });

    Route::controller(BranchController::class)->group(function () {
        Route::get('/get_branches', 'index');
    });

    Route::controller(DiscountController::class)->group(function () {
        Route::get('/get_discounts', 'index');
    });

    Route::controller(ExternalOrderController::class)->group(function () {
        Route::post('/create_external_order', 'store');
        Route::post('/accept_external_order/{id}', 'AcceptExternalOrder');
    });

    Route::controller(RateController::class)->group(function () {
        Route::post('/create_rate', 'store');
    });

    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/print_invoice/{id}', 'PrintInvoice')->name('print_invoice');
        Route::get('/get_invoices', 'indexPagination');

    });
});


