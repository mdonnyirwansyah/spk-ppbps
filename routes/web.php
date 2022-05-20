<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::prefix('account')->name('user-')->group(function () {
        Route::get('profile-information', function () {
            return view('app.user.profile-information');
        })->name('profile-information');
        Route::get('password', function () {
            return view('app.user.password');
        })->name('password');
    });
});
