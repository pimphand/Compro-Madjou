<?php

use App\Http\Controllers\Api\Admin\CategoryTeamController;
use App\Http\Controllers\Api\Admin\TagController;
use App\Http\Controllers\Api\Admin\TeamController;
use App\Http\Controllers\Api\v1\DetailServiceController;
use App\Http\Controllers\Api\v1\OurClientController;
use App\Http\Controllers\Api\v1\ServiceController;
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

Route::resource('/category-team', CategoryTeamController::class);

Route::resource('/team', TeamController::class);

Route::resource('/tags', TagController::class);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
