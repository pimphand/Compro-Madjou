<?php

use App\Http\Controllers\Api\v1\CategoryTeamController;
use App\Http\Controllers\Api\v1\TagController;
use App\Http\Controllers\Api\v1\TeamController;
use App\Http\Controllers\Api\v1\DetailServiceController;
use App\Http\Controllers\Api\v1\OurClientController;
use App\Http\Controllers\Api\v1\ServiceController;
use App\Http\Controllers\Api\v1\CarrerController;
use App\Http\Controllers\Api\v1\EmployeeRegistrationController;
use App\Http\Controllers\Api\v1\MessageController;
use App\Http\Controllers\Api\v1\NotificationController;
use App\Http\Controllers\Api\v1\ProjectController;
use App\Http\Controllers\Api\v1\ProjectTypeController;
use App\Http\Controllers\Api\v1\SubscribeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(["prefix" => 'v1'], function(){

Route::resource('/notifications', NotificationController::class);

Route::resource('/category-blogs', CategoryBlog::class);

Route::resource('/blogs', Blog::class);

Route::resource('/employees', EmployeeRegistrationController::class);

Route::resource('/clients', OurClientController::class);

Route::resource('/services', ServiceController::class);

Route::resource('/detail-services', DetailServiceController::class);

Route::resource('/project-types', ProjectTypeController::class);

Route::resource('/projects', ProjectController::class);

Route::resource('/careers', CarrerController::class);

Route::resource('/category-teams', CategoryTeamController::class);

Route::resource('/teams', TeamController::class);

Route::resource('/tags', TagController::class);

route::resource('/subscribes', SubscribeController::class);

route::resource('/messages', MessageController::class);

});




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
