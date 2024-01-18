<?php

use App\Http\Controllers\Api\AvailableDonationController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\DonationController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\PanelApiController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RecapDonationController;
use App\Http\Controllers\Api\SettingCompanyController;
use App\Http\Controllers\Api\ShippingController;
use App\Http\Controllers\Api\WebDonationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('/donate')->group(function () {
    Route::post('/', [DonationController::class, 'requestDonate']);
});

Route::prefix('/available-donations')->group(function () {
    Route::get('/', [AvailableDonationController::class, 'index']);
});

Route::prefix('/news')->group(function () {
    Route::get('/', [NewsController::class, 'index']);
    Route::get('/{id}', [NewsController::class, 'show']);
});

Route::prefix('/products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id}', [ProductController::class, 'show']);
});

Route::prefix('/shipping')->group(function () {
    Route::get('/courier', [ShippingController::class, 'getCourier']);
    Route::get('/provinces', [ShippingController::class, 'getProvinces']);
    Route::get('/cities', [ShippingController::class, 'getCities']);
    Route::post('/costs', [ShippingController::class, 'getCosts']);
});

Route::prefix('/checkouts')->group(function () {
    Route::post('/', [CheckoutController::class, 'doCheckout']);
});

Route::prefix('recap-donation')->group(function () {
    Route::get('/donation-collected', [RecapDonationController::class, 'getDonationCollected']);
    Route::get('/donatur', [RecapDonationController::class, 'getDonatur']);
});

Route::prefix('setting-company')->group(function () {
    Route::get('/', [SettingCompanyController::class, 'index']);
});

Route::prefix('web-donations')->group(function () {
    Route::get('/', [WebDonationController::class, 'show']);
});

Route::prefix('panel-api')->group(function () {
    Route::post('/temp-upload-image', [PanelApiController::class, 'tempUploadImage']);
});
