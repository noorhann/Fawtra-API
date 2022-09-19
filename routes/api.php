<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//auth routes
Route::middleware(['api'])->group(function () {
    Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::get('/profile', [App\Http\Controllers\Api\AuthController::class, 'userProfile']);
    Route::post('/update/profile', [App\Http\Controllers\Api\AuthController::class, 'updateProfile']);
    Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register']);

});


//Customer route 
Route::middleware(['auth'])->group(function () {
    Route::get('/statistics', [App\Http\Controllers\Api\StatisticController::class, 'GetStatistic']);

    Route::post('/add/customer', [App\Http\Controllers\Api\CustomersController::class, 'AddCustomer']);
    Route::post('/update/customer/{id}', [App\Http\Controllers\Api\CustomersController::class, 'updateCustomer']);
    Route::post('/delete/customer/{id}', [App\Http\Controllers\Api\CustomersController::class, 'delete']);
    Route::get('/search/customers', [App\Http\Controllers\Api\CustomersController::class, 'search']);
    Route::get('/customers/numbers', [App\Http\Controllers\Api\CustomersController::class, 'customer_number']);

    Route::get('/listcustomers', [App\Http\Controllers\Api\CustomersController::class, 'GetListCustomers']);
    Route::get('/customers', [App\Http\Controllers\Api\CustomersController::class, 'ListCustomers']);
    Route::post('/showcustomer', [App\Http\Controllers\Api\CustomersController::class, 'ShowCustomer']);
    
    Route::post('/add/car', [App\Http\Controllers\Api\CarController::class, 'AddCar']);
    Route::post('/update/car/{id}', [App\Http\Controllers\Api\CarController::class, 'updateCar']);
    Route::post('/delete/car/{id}', [App\Http\Controllers\Api\CarController::class, 'delete']);
    Route::get('/search/cars/{id}', [App\Http\Controllers\Api\CarController::class, 'search']);

});

//invoices routes
Route::middleware(['auth'])->group(function () {

    Route::get('/final/invoices', [App\Http\Controllers\Api\InvoiceController::class, 'final_invoice']);
    Route::get('/pending/invoices', [App\Http\Controllers\Api\InvoiceController::class, 'pending_invoice']);
    Route::get('/export/final/invoices', [App\Http\Controllers\Api\InvoiceController::class, 'export_final_invoice']);
    Route::get('/export/pending/invoices', [App\Http\Controllers\Api\InvoiceController::class, 'export_pending_invoice']);
  
    Route::get('/show/final/invoice/{id}', [App\Http\Controllers\Api\InvoiceController::class, 'show_final_invoice']);
    Route::get('/show/pending/invoice/{id}', [App\Http\Controllers\Api\InvoiceController::class, 'show_pending_invoice']);
    Route::get('/perview/final/invoice/{id}', [App\Http\Controllers\Api\InvoiceController::class, 'preview_final_invoice']);
    
    Route::get('/search/final/invoice', [App\Http\Controllers\Api\InvoiceController::class, 'search_final']);
    Route::get('/search/pending/invoice', [App\Http\Controllers\Api\InvoiceController::class, 'search_pending']);
   

    Route::post('/invoiced/pending/{id}', [App\Http\Controllers\Api\InvoiceController::class, 'invoiced_pending']);

    Route::post('/create/invoice', [App\Http\Controllers\Api\InvoiceController::class, 'create']);
    Route::post('/create/service', [App\Http\Controllers\Api\InvoiceController::class, 'service_name']);
    Route::post('/update/invoice/{id}', [App\Http\Controllers\Api\InvoiceController::class, 'update_invoice']);
    Route::post('/update/service/{id}', [App\Http\Controllers\Api\InvoiceController::class, 'update_service']);

    Route::get('/encoded/data/{id}', [App\Http\Controllers\Api\InvoiceController::class, 'encode_date']);

    Route::get('/filter/final/invoice', [App\Http\Controllers\Api\InvoiceController::class, 'filter_final']);
    Route::get('/filter/pending/invoice', [App\Http\Controllers\Api\InvoiceController::class, 'filter_pending']);
   
    Route::get('/invoice/data', [App\Http\Controllers\Api\InvoiceController::class, 'get_invoice_data']);
    Route::get('/service/data/{id}', [App\Http\Controllers\Api\InvoiceController::class, 'get_service_data']);

    Route::post('/invoice/image', [App\Http\Controllers\Api\InvoiceController::class, 'store_image']);
    Route::get('/invoice/image/{id}', [App\Http\Controllers\Api\InvoiceController::class, 'get_images']);
    Route::post('/delete/invoice/image/{id}', [App\Http\Controllers\Api\InvoiceController::class, 'delete_image']);
    Route::post('/update/invoice/image/{id}', [App\Http\Controllers\Api\InvoiceController::class, 'update_image']);

    Route::get('/reports', [App\Http\Controllers\Api\ReportController::class, 'total_reports']);
    Route::get('/reports/date', [App\Http\Controllers\Api\ReportController::class, 'total_filter_date']);

});



//tyre attributes 
Route::middleware(['auth'])->group(function () {
    Route::get('/width', [App\Http\Controllers\WidthController::class, 'index']);
    Route::post('/add/width', [App\Http\Controllers\WidthController::class, 'add']);
    Route::post('/delete/width/{id}', [App\Http\Controllers\WidthController::class, 'delete']);

    Route::get('/height', [App\Http\Controllers\HeightController::class, 'index']);
    Route::post('/add/height', [App\Http\Controllers\HeightController::class, 'add']);
    Route::post('/delete/height/{id}', [App\Http\Controllers\HeightController::class, 'delete']);

    Route::get('/diameter', [App\Http\Controllers\DiameterController::class, 'index']);
    Route::post('/add/diameter', [App\Http\Controllers\DiameterController::class, 'add']);
    Route::post('/delete/diameter/{id}', [App\Http\Controllers\DiameterController::class, 'delete']);

    Route::get('/week', [App\Http\Controllers\WeekController::class, 'index']);
    Route::post('/add/week', [App\Http\Controllers\WeekController::class, 'add']);
    Route::post('/delete/week/{id}', [App\Http\Controllers\WeekController::class, 'delete']);

    Route::get('/year', [App\Http\Controllers\YearController::class, 'index']);
    Route::post('/add/year', [App\Http\Controllers\YearController::class, 'add']);
    Route::post('/delete/year/{id}', [App\Http\Controllers\YearController::class, 'delete']);

    Route::get('/brand', [App\Http\Controllers\BrandController::class, 'index']);
    Route::post('/add/brand', [App\Http\Controllers\BrandController::class, 'add']);
    Route::post('/delete/brand/{id}', [App\Http\Controllers\BrandController::class, 'delete']);

    Route::get('/country', [App\Http\Controllers\CountryOriginalController::class, 'index']);
    Route::post('/add/country', [App\Http\Controllers\CountryOriginalController::class, 'add']);
    Route::post('/delete/country/{id}', [App\Http\Controllers\CountryOriginalController::class, 'delete']);

    Route::get('/speed', [App\Http\Controllers\SpeedIndexController::class, 'index']);
    Route::post('/add/speed', [App\Http\Controllers\SpeedIndexController::class, 'add']);
    Route::post('/delete/speed/{id}', [App\Http\Controllers\SpeedIndexController::class, 'delete']);

    Route::get('/branch', [App\Http\Controllers\LocationController::class, 'index']);
    Route::post('/add/branch', [App\Http\Controllers\LocationController::class, 'add']);
    Route::post('/delete/branch/{id}', [App\Http\Controllers\LocationController::class, 'delete']);


    Route::get('/tyre', [App\Http\Controllers\TyreController::class, 'index']);
    Route::post('/add/tyre', [App\Http\Controllers\TyreController::class, 'add']);
    Route::post('/delete/tyre/{id}', [App\Http\Controllers\TyreController::class, 'delete']);
    Route::post('/update/tyre/{id}', [App\Http\Controllers\TyreController::class, 'update']);

    Route::get('/search_filter/tyre', [App\Http\Controllers\TyreController::class, 'search_filter']);

});
Route::get('/expire', [App\Http\Controllers\TyreController::class, 'expire']);
