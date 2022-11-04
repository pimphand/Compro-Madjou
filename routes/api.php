<?php

use App\Http\Controllers\Api\v1\CategoryTeamController;
use App\Http\Controllers\Api\v1\TagController;
use App\Http\Controllers\Api\v1\TeamController;
use App\Http\Controllers\Api\v1\DetailServiceController;
use App\Http\Controllers\Api\v1\OurClientController;
use App\Http\Controllers\Api\v1\ServiceController;
use App\Http\Controllers\Api\v1\CareerController;
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

Route::resource('/clients', OurClientController::class);

Route::resource('/services', ServiceController::class);

Route::resource('/detail-services', DetailServiceController::class);

Route::resource('/careers', CareerController::class);

Route::resource('/category-team', CategoryTeamController::class);

Route::resource('/team', TeamController::class);

Route::resource('/tags', TagController::class);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
