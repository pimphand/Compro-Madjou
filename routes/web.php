<?php

use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\MasterUserController;
use App\Http\Controllers\Api\Admin\RoleController;
use App\Http\Controllers\Api\Admin\TagController;
use App\Http\Controllers\Sync\XenditController;
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
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {

    Route::middleware(['role:superadmin|dev'])->group(function () {
        Route::resource('/dashboard', DashboardController::class);
        Route::resource('/roles', RoleController::class);
        Route::resource('/tags', TagController::class);
        Route::resource('/user', MasterUserController::class);
    });
});

require __DIR__ . '/auth.php';
