<?php

use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\VideoController;
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

Route::get('/', function () {
    return view('login');
});


Route::prefix('admin')->group(function () {

    Route::name('admin.')->group(function () {

        Route::resources([
            'users' => UserController::class,
            'customers' => CustomerController::class,
            'videos' => VideoController::class,
        ]);

    });

});
