<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\DonationPackageController;
use App\Http\Controllers\Panel\SettingController;
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

    Route::prefix('/setting')->group(function () {
        Route::get('/', [SettingController::class, 'edit']);
        Route::put('/', [SettingController::class, 'update']);
    });

    Route::prefix('/donation-packages')->group(function () {
        Route::get('/', [DonationPackageController::class, 'index']);
        Route::get('/create', [DonationPackageController::class, 'create']);
        Route::post('/', [DonationPackageController::class, 'store']);
        Route::get('/{id}/edit', [DonationPackageController::class, 'edit']);
        Route::put('/{id}', [DonationPackageController::class, 'update']);
        Route::delete('/{id}', [DonationPackageController::class, 'destroy']);
    });
});

Auth::routes();

Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm']);
    Route::post('/login', [LoginController::class, 'login']);
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
