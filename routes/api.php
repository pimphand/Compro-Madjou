<?php

use App\Http\Controllers\Api\Payment\InvoiceController;
use App\Http\Controllers\Api\Payment\XenditController;
use App\Http\Controllers\Api\v1\BlogController;
use App\Http\Controllers\Api\v1\CategoryTeamController;
use App\Http\Controllers\Api\v1\TagController;
use App\Http\Controllers\Api\v1\TeamController;
use App\Http\Controllers\Api\v1\DetailServiceController;
use App\Http\Controllers\Api\v1\OurClientController;
use App\Http\Controllers\Api\v1\ServiceController;
use App\Http\Controllers\Api\v1\CarrerController;
use App\Http\Controllers\Api\v1\CategoryBlogController;
use App\Http\Controllers\Api\v1\EmployeeRegistrationController;
use App\Http\Controllers\Api\v1\EventController;
use App\Http\Controllers\Api\v1\EventRegisterController;
use App\Http\Controllers\Api\v1\MessageController;
use App\Http\Controllers\Api\v1\NotificationController;
use App\Http\Controllers\Api\v1\PackageController;
use App\Http\Controllers\Api\v1\ProfileController;
use App\Http\Controllers\Api\v1\ProjectController;
use App\Http\Controllers\Api\v1\ProjectTypeController;
use App\Http\Controllers\Api\v1\SubscribeController;
use App\Http\Controllers\Web\OrderController;
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

Route::group(["prefix" => 'v1'], function () {

    Route::resource('/notifications', NotificationController::class);

    Route::resource('/category-blogs', CategoryBlogController::class);

    Route::resource('/blogs', BlogController::class);

    Route::resource('/employees', EmployeeRegistrationController::class);

    Route::resource('/clients', OurClientController::class);

    Route::resource('/services', ServiceController::class);

    Route::resource('/detail-services', DetailServiceController::class);

    Route::resource('/project-types', ProjectTypeController::class);

    Route::resource('/projects', ProjectController::class);

    Route::resource('/careers', CarrerController::class);

    Route::resource('/packages', PackageController::class);

    Route::resource('/category-teams', CategoryTeamController::class);

    Route::resource('/teams', TeamController::class);

    Route::resource('/tags', TagController::class);

    Route::resource('/subscribes', SubscribeController::class);

    Route::resource('/messages', MessageController::class);

    Route::resource('/event-registers', EventRegisterController::class);

    Route::resource('/events', EventController::class);

    Route::post('/order/{id}', [OrderController::class, 'create']);
});

Route::group(['prefix' => 'xendit'], function () {
    Route::get('/balance', [XenditController::class, 'balance']);
    Route::get('/payment', [XenditController::class, 'payment']);
    Route::get('/virtual-account', [XenditController::class, 'virtualAccount']);
    Route::post('/callback_virtual_account', [XenditController::class, 'pay']);
    Route::post('/create-invoice/{id}', [InvoiceController::class, 'createInv']);
    Route::get('/invoice', [InvoiceController::class, 'getInvoice']);
});


Route::group(['middleware' => 'auth'], function () {
    Route::middleware(['role:superadmin|dev|admin'])->group(function () {
        Route::resource('/profile', ProfileController::class);
    });
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
