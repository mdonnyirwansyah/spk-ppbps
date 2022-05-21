<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecruitmentController;
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

    Route::resource('recruitment', RecruitmentController::class)->except('show');

    Route::prefix('account')->name('account.')->group(function () {
        Route::get('profile-information', function () {
            return view('app.account.profile-information');
        })->name('profile-information');
        Route::get('update-password', function () {
            return view('app.account.update-password');
        })->name('update-password');
    });
});
