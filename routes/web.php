<?php

use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\SubCriteriaController;
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

    Route::prefix('recruitment')->name('recruitment.')->group(function () {
        Route::get('', [RecruitmentController::class, 'index'])->name('index');
        Route::get('create', [RecruitmentController::class, 'create'])->name('create');
        Route::post('', [RecruitmentController::class, 'store'])->name('store');
        Route::get('edit/{recruitment:slug}', [RecruitmentController::class, 'edit'])->name('edit');
        Route::put('{recruitment:slug}', [RecruitmentController::class, 'update'])->name('update');
        Route::delete('{recruitment:slug}', [RecruitmentController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('criteria')->name('criteria.')->group(function () {
        Route::get('', [CriteriaController::class, 'index'])->name('index');
        Route::post('create', [CriteriaController::class, 'create'])->name('create');
        Route::post('', [CriteriaController::class, 'store'])->name('store');
        Route::get('edit/{criteria:slug}', [CriteriaController::class, 'edit'])->name('edit');
        Route::put('{criteria:slug}', [CriteriaController::class, 'update'])->name('update');
        Route::delete('{criteria:slug}', [CriteriaController::class, 'destroy'])->name('destroy');
        Route::post('get-data', [CriteriaController::class, 'getData'])->name('get-data');
    });

    Route::prefix('sub-criteria')->name('sub-criteria.')->group(function () {
        Route::get('', [SubCriteriaController::class, 'index'])->name('index');
        Route::get('create', [SubCriteriaController::class, 'create'])->name('create');
        Route::post('', [SubCriteriaController::class, 'store'])->name('store');
        Route::get('edit/{sub_criteria:slug}', [SubCriteriaController::class, 'edit'])->name('edit');
        Route::put('{sub_criteria:slug}', [SubCriteriaController::class, 'update'])->name('update');
        Route::delete('{sub_criteria:slug}', [SubCriteriaController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('account')->name('account.')->group(function () {
        Route::get('profile-information', function () {
            return view('app.account.profile-information');
        })->name('profile-information');
        Route::get('update-password', function () {
            return view('app.account.update-password');
        })->name('update-password');
    });
});
