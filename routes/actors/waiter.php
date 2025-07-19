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

//
//
//Route::controller(BranchController::class)->group(function () {
//    Route::post('/create_branch', 'store');
//    Route::post('/update_one_branch/{id}', 'update');
//    Route::get('/get_branches', 'index');
//    Route::get('/get_one_branch/{id}', 'get_one');
//    Route::delete('/delete_one_branch/{id}', 'destroy');
//});
//
//Route::controller(CategoryController::class)->group(function () {
//    Route::post('/create_category', 'store');
//    Route::post('/update_one_category/{id}', 'update');
//    Route::get('/get_categories', 'index');
//    Route::get('/get_one_category/{id}', 'get_one');
//    Route::delete('/delete_one_category/{id}', 'destroy');
//});
//
//Route::controller(ItemController::class)->group(function () {
//    Route::post('/create_item', 'store');
//    Route::get('/get_items', 'index');
//    Route::get('/get_one_item/{id}', 'get_one');
//    Route::delete('/delete_one_item/{id}', 'destroy');
//    Route::post('/update_one_item/{id}', 'update');
//    Route::post('/add_item_images/{id}', 'AddItemImages');
//    Route::post('/delete_item_images/{id}', 'DeleteItemImages');
//});
//
//Route::controller(RateController::class)->group(function () {
//    Route::post('/create_rate', 'store');
//    Route::get('/get_rates', 'index');
//
//});
//
//
//Route::controller(EmployeeController::class)->group(function () {
//    Route::post('/create_employee', 'store');
//    Route::delete('/delete_one_employee/{id}', 'destroy');
//    Route::get('/get_one_employee/{id}', 'get_one');
//    Route::get('/get_employees', 'indexPagination');
//    Route::post('/update_one_employee/{id}', 'update');
//
//});
//
//
//Route::controller(TableController::class)->group(function () {
//    Route::post('/create_table', 'store');
//    Route::delete('/delete_one_table/{id}', 'destroy')->name('delete_table');
//    Route::get('/get_one_table/{id}', 'get_one');
//    Route::get('/get_tables', 'indexPagination');
//    Route::post('/update_one_table/{id}', 'update');
//    Route::post('/table_change_status/{id}', 'TableChangeStatus');
//
//});
//
//Route::controller(OfferController::class)->group(function () {
//    Route::post('/create_offer', 'store');
//    Route::delete('/delete_one_offer/{id}', 'destroy');
//    Route::get('/get_one_offer/{id}', 'get_one');
//    Route::get('/get_offers', 'indexPagination');
//});
//
//Route::controller(InternalOrderController::class)->group(function () {
//    Route::post('/create_internal_order', 'store');
//    Route::post('/update_internal_order/{id}', 'update');
//    Route::post('/change_internal_order_status/{id}', 'ChangeInternalOrderStatus');
//    Route::get('/get_internal_order_items/{id}', 'GetInternalOrderItems')->name('GetInternalOrderItems');
//    Route::get('/get_internal_orders', 'indexPagination');
//
//});
//
//Route::controller(ExternalOrderController::class)->group(function () {
//    Route::post('/create_external_order', 'store');
//    Route::post('/change_external_order_status/{id}', 'ChangeExternalOrderStatus');
//    Route::post('/accept_external_order/{id}','AcceptExternalOrder');
//});
//
//
//Route::controller(InvoiceController::class)->group(function () {
//    Route::post('/change_invoice_status/{id}', 'ChangeInvoiceStatus');
//    Route::get('/get_one_invoice/{id}', 'get_one')->name('get_one_invoice');
//    Route::get('/print_invoice/{id}', 'PrintInvoice')->name('print_invoice');
//    Route::get('/get_invoices', 'indexPagination');
//
//});
//
//Route::controller(TaxController::class)->group(function () {
//
//    Route::post('/create_tax', 'store');
//    Route::delete('/delete_one_tax/{id}', 'destroy');
//    Route::post('/update_one_tax/{id}', 'update');
//    Route::get('/get_one_tax/{id}', 'get_one');
//    Route::get('/get_taxes', 'index');
//});
//
//
//Route::controller(DiscountController::class)->group(function () {
//    Route::post('/create_discount', 'store');
//    Route::delete('/delete_one_discount/{id}', 'destroy');
//    Route::post('/update_one_discount/{id}', 'update');
//    Route::get('/get_one_discount/{id}', 'get_one');
//    Route::get('/get_discounts', 'index');
//});
//
//
//Route::controller(MaterialController::class)->group(function () {
//    Route::post('/create_material', 'store');
//    Route::delete('/delete_one_material/{id}', 'destroy');
//    Route::post('/update_one_material/{id}', 'update');
//    Route::get('/get_one_material/{id}', 'get_one');
//    Route::get('/get_materials', 'index');
//});
//
//Route::controller(WarehouseMaterialController::class)->group(function () {
//    Route::get('/get_warehouse_materials', 'index');
//    Route::post('/add_warehouse_materials', 'AddWarehouseMaterials');
//    Route::post('/remove_warehouse_materials', 'RemoveWarehouseMaterials');
//});
//
//Route::controller(WarehouseController::class)->group(function () {
//
//    Route::get('/get_one_warehouse/{id}', 'get_one');
//    Route::get('/get_warehouses', 'index');
//});
//
//Route::controller(AuthController::class)->group(function () {
//
//    Route::post('/employee_login', 'Login')->name('employee_login');
//    Route::post('/admin_login', 'Login')->name('admin_login');
//    Route::post('/user_login', 'Login')->name('user_login');
//    Route::post('/employee_logout', 'Logout')->name('employee_logout');
//    Route::post('/admin_logout', 'Logout')->name('admin_logout');
//    Route::post('/user_logout', 'Logout')->name('user_logout');
//
//});


Route::controller(AuthController::class)->group(function () {
    Route::post('/employee_login', 'Login')->name('employee_login');
});


Route::middleware(['auth:Employee', 'employee.type:waiter', 'scope:Employee'])->group(function () {
    Route::controller(AuthController::class)->group(function () {

        Route::post('/employee_logout', 'Logout')->name('employee_logout');
    });

    Route::controller(InvoiceController::class)->group(function () {
        Route::post('/change_invoice_status/{id}', 'ChangeInvoiceStatus');
        Route::get('/get_one_invoice/{id}', 'get_one')->name('get_one_invoice');
    });

    Route::controller(InternalOrderController::class)->group(function () {
        Route::post('/create_internal_order', 'store');
        Route::post('/update_internal_order/{id}', 'update');
        Route::post('/change_internal_order_status/{id}', 'ChangeInternalOrderStatus');
        Route::get('/get_internal_orders', 'indexPagination');

    });

    Route::controller(ItemController::class)->group(function () {
        Route::get('/get_items', 'index');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/get_categories', 'index');
    });

    Route::controller(OfferController::class)->group(function () {
    Route::get('/get_offers', 'indexPagination');
});

    Route::controller(TableController::class)->group(function () {
    Route::get('/get_tables', 'indexPagination');
    Route::post('/table_change_status/{id}', 'TableChangeStatus');
});
});


