<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\RequestController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Customer\VideoController as AppVideoController;
use App\Http\Controllers\LoginController;
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


// ===========================
// Authentication
// ===========================
Route::any('login',[LoginController::class, 'login'])->name('login')->middleware('guest');
Route::get('logout',[LoginController::class, 'logout'])->name('logout')->middleware('auth');


Route::middleware(['auth'])->group(function () {

    Route::get('/',[LoginController::class, 'home'])->name('home');

    // ===========================
    // Customer Route
    // ===========================

    Route::middleware(['is_customer'])->group(function () {

        Route::prefix('customer')->group(function () {

            Route::name('customer.')->group(function () {

                Route::get('videos',[AppVideoController::class, 'index'])->name('videos.index');
                Route::get('videos/request/{video}',[AppVideoController::class, 'request'])->name('videos.request');
                Route::get('videos/{video}',[AppVideoController::class, 'show'])->name('videos.show');

            });

        });

    });

    // ===========================
    // Admin Route
    // ===========================

    Route::middleware(['is_admin'])->group(function () {

        Route::prefix('admin')->group(function () {

            Route::name('admin.')->group(function () {

                Route::resources([
                    'users' => UserController::class,
                    'customers' => CustomerController::class,
                    'videos' => VideoController::class,
                ]);


                Route::get('requests',[RequestController::class, 'index'])->name('requests.index');
                Route::get('requests/{req}',[RequestController::class, 'show'])->name('requests.show');
                Route::post('requests/{req}',[RequestController::class, 'accept'])->name('requests.accept');
                Route::delete('requests/{req}',[RequestController::class, 'destroy'])->name('requests.destroy');


            });

        });

    });



});
