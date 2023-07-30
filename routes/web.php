<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\MediaController;
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


Route::get('login', [LoginController::class, 'view'])->name('login-page');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Admin Routes
    Route::get('administrators/change-password/{administrator}', [AdminController::class, 'changePassword'])->name('administrators.change-password');
    Route::get('administrators/historical-changes/{administrator}', [AdminController::class, 'historicalChanges'])->name('administrators.historical-changes');
    Route::post('administrators/change-password/{administrator}', [AdminController::class, 'doChangePassword'])->name('administrators.do-change-password');
    Route::resource('administrators', AdminController::class);

    // Customer Routes
    Route::get('customers/change-password/{customer}', [CustomerController::class, 'changePassword'])->name('customers.change-password');
    Route::get('customers/historical-changes/{customer}', [CustomerController::class, 'historicalChanges'])->name('customers.historical-changes');
    Route::post('customers/change-password/{user}', [CustomerController::class, 'doChangePassword'])->name('customers.do-change-password');
    Route::resource('customers', CustomerController::class);

    // Feature Routes
    Route::get('features/historical-changes/{feature}', [FeatureController::class, 'historicalChanges'])->name('features.historical-changes');
    Route::resource('features', FeatureController::class);

    Route::post('media/uploads', [MediaController::class, 'storeMedia'])->name('media.uploads');
});