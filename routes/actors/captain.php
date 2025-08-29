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
use App\Http\Controllers\Tax\TaxController;
use App\Http\Controllers\Warehouse\WarehouseController;
use App\Http\Controllers\WarehouseMaterial\WarehouseMaterialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post('/employee_login', 'Login')->name('employee_login');
});

Route::middleware(['auth:Employee', 'employee.type:captain', 'scope:Employee'])->group(function () {
    Route::controller(AuthController::class)->group(function () {

        Route::post('/employee_logout', 'Logout')->name('employee_logout');
    });

    Route::controller(InternalOrderController::class)->group(function () {
        Route::get('/get_internal_order_items/{id}', 'GetInternalOrderItems')->name('GetInternalOrderItems');
        Route::post('/change_internal_order_status/{id}', 'ChangeInternalOrderStatus');
        Route::get('/get_internal_orders', 'indexPagination');

    });

    Route::controller(ExternalOrderController::class)->group(function () {
    Route::post('/change_external_order_status/{id}', 'ChangeExternalOrderStatus');
});
});


