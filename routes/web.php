<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Panel\DashboardController;
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
});

Auth::routes();

Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm']);
    Route::post('/login', [LoginController::class, 'login']);
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
