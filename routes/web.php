<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\MasterUserController;
use App\Http\Controllers\Web\RoleController;
use App\Http\Controllers\Web\TagController;
use App\Http\Controllers\Sync\XenditController;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\CarrerController;
use App\Http\Controllers\Web\CategoryBlogController;
use App\Http\Controllers\Web\CategoryTeamController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\DetailServiceController;
use App\Http\Controllers\Web\EmployeeRegistrationController;
use App\Http\Controllers\Web\MessageController;
use App\Http\Controllers\Web\NotificationController;
use App\Http\Controllers\Web\OurClientController;
use App\Http\Controllers\Web\ProgrammingLanguageController;
use App\Http\Controllers\Web\ProjectController;
use App\Http\Controllers\Web\ProjectTypeController;
use App\Http\Controllers\Web\ServiceController;
use App\Http\Controllers\Web\SettingController;
use App\Http\Controllers\Web\SubscribeController;
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
    return view('auth.login');
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
        Route::resource('/project-types', ProjectTypeController::class);
        Route::resource('/project', ProjectController::class);
        Route::resource('/careers', CarrerController::class);
        Route::resource('/employees', EmployeeRegistrationController::class);
        Route::resource('/messages', MessageController::class);
        Route::resource('/notifications', NotificationController::class);
        Route::resource('/subscribes', SubscribeController::class);
        Route::resource('/settings', SettingController::class);
        Route::resource('/contacts', ContactController::class);
        Route::resource('/user', MasterUserController::class);
    });
});

require __DIR__ . '/auth.php';
