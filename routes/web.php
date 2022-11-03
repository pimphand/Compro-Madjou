<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\MasterUserController;
use App\Http\Controllers\Web\RoleController;
use App\Http\Controllers\Web\TagController;
use App\Http\Controllers\Sync\XenditController;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\CategoryBlogController;
use App\Http\Controllers\Web\CategoryTeamController;
use App\Http\Controllers\Web\DetailServiceController;
use App\Http\Controllers\Web\OurClientController;
use App\Http\Controllers\Web\ProgrammingLanguageController;
use App\Http\Controllers\Web\ServiceController;
use App\Http\Controllers\Web\TeamController;

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
        Route::resource('/category-teams', CategoryTeamController::class);
        Route::resource('/teams', TeamController::class);
        Route::resource('/languages', ProgrammingLanguageController::class);
        Route::resource('/blogs', BlogController::class);
        Route::resource('/category-blogs', CategoryBlogController::class);
        Route::resource('/clients', OurClientController::class);
        Route::resource('/services', ServiceController::class);
        Route::resource('/detail-services', DetailServiceController::class);
        Route::resource('/user', MasterUserController::class);
    });
});

require __DIR__ . '/auth.php';
