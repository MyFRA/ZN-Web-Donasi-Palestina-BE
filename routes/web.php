<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\DonationPackageController;
use App\Http\Controllers\Panel\DonationPackagesCollectedController;
use App\Http\Controllers\Panel\NewsController;
use App\Http\Controllers\Panel\ProductDonationController;
use App\Http\Controllers\Panel\ProductDonationOrderCollectedController;
use App\Http\Controllers\Panel\SettingController;
use App\Http\Controllers\Panel\SettingWebDonationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group([
    'prefix' => '/panel',
    'middleware' => ['auth']
], function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::prefix('/news')->group(function () {
        Route::get('/', [NewsController::class, 'index']);
        Route::get('/create', [NewsController::class, 'create']);
        Route::post('/', [NewsController::class, 'store']);
        Route::get('/{id}/edit', [NewsController::class, 'edit']);
        Route::put('/{id}', [NewsController::class, 'update']);
        Route::delete('/{id}', [NewsController::class, 'destroy']);
    });

    Route::prefix('/setting')->group(function () {
        Route::get('/', [SettingController::class, 'edit']);
        Route::put('/', [SettingController::class, 'update']);
    });

    Route::prefix('/setting-web-donation')->group(function () {
        Route::get('/', [SettingWebDonationController::class, 'index']);
        Route::put('/', [SettingWebDonationController::class, 'update']);
    });

    Route::prefix('/donation-packages')->group(function () {
        Route::get('/', [DonationPackageController::class, 'index']);
        Route::get('/create', [DonationPackageController::class, 'create']);
        Route::post('/', [DonationPackageController::class, 'store']);
        Route::get('/{id}/edit', [DonationPackageController::class, 'edit']);
        Route::put('/{id}', [DonationPackageController::class, 'update']);
        Route::delete('/{id}', [DonationPackageController::class, 'destroy']);
    });

    Route::prefix('/product-donations')->group(function () {
        Route::get('/', [ProductDonationController::class, 'index']);
        Route::get('/create', [ProductDonationController::class, 'create']);
        Route::post('/', [ProductDonationController::class, 'store']);
        Route::get('/{id}/edit', [ProductDonationController::class, 'edit']);
        Route::put('/{id}', [ProductDonationController::class, 'update']);
        Route::delete('/{id}', [ProductDonationController::class, 'destroy']);
    });

    Route::prefix('/donation-packages-collected')->group(function () {
        Route::get('/', [DonationPackagesCollectedController::class, 'index']);
    });

    Route::prefix('/product-donation-orders-collected')->group(function () {
        Route::get('/', [ProductDonationOrderCollectedController::class, 'index']);
        Route::put('/{id}/shipped', [ProductDonationOrderCollectedController::class, 'updateToShipped']);
    });
});

Auth::routes();

Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm']);
    Route::post('/login', [LoginController::class, 'login']);
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
