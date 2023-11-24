<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RefundController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketLevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VenueController;
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


Route::get('ticket/{id}', [TicketController::class, 'show']);

Route::post('login', [UserController::class, 'store']);
Route::post('register', [UserController::class, 'register']);
Route::post('register', [UserController::class, 'register']);
Route::get('user/{id}', [UserController::class, 'show']);
Route::post('forgot-password', [UserController::class, 'forgotPassword']);
Route::post('reset-password', [UserController::class, 'resetPassword']);

Route::get('venue', [VenueController::class, 'index']);

Route::get('event', [EventController::class, 'index']);

Route::get('discount/event/{event_id}', [DiscountController::class, 'get']);
Route::get('level/{event_id}', [TicketLevelController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('update-password', [UserController::class, 'changePassword']);

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/', [UserController::class, 'create']);
        Route::post('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });


    Route::prefix('venue')->group(function () {
        Route::post('/', [VenueController::class, 'create']);
        Route::put('/{id}', [VenueController::class, 'update']);
        Route::get('/user', [VenueController::class, 'showUser']);
        Route::get('/{id}', [VenueController::class, 'show']);
        Route::delete('/{id}', [VenueController::class, 'destroy']);
    });


    Route::prefix('event')->group(function () {
        Route::post('/', [EventController::class, 'create']);
        Route::post('/{id}/image', [EventController::class, 'addImage']);
        Route::post('/{id}', [EventController::class, 'update']);
        Route::get('/user', [EventController::class, 'showUser']);

        Route::delete('/{id}/image/{index}', [EventController::class, 'deleteImage']);
        Route::delete('/{id}', [EventController::class, 'destroy']);
        // Route::get('/', [EventController::class, 'index']);
    });

    Route::prefix('ticket')->group(function () {
        // Route::post('/', [TicketController::class, 'create']);
        // Route::get('/', [TicketController::class, 'index']);
        Route::get('', [TicketController::class, 'show']);
        Route::get('/{event_id}', [TicketController::class, 'showEvent']);
        Route::get('/{id}', [TicketController::class, 'show']);
    });

    Route::prefix('order')->group(function () {
        Route::post('/', [OrderController::class, 'create']);
        Route::get('/', [OrderController::class, 'index']);
    });

    Route::prefix('discount')->group(function () {
        Route::post('/', [DiscountController::class, 'create']);
        Route::get('/', [DiscountController::class, 'index']);
        Route::put('/{id}', [DiscountController::class, 'update']);
        Route::delete('/{id}', [DiscountController::class, 'destroy']);
    });

    Route::prefix('level')->group(function () {
        Route::post('/', [TicketLevelController::class, 'create']);
        Route::put('/{id}', [TicketLevelController::class, 'update']);
        Route::delete('/{id}', [TicketLevelController::class, 'destroy']);
    });

    Route::prefix('campaign')->group(function () {
        Route::get('/event/{event_id}', [CampaignController::class, 'show']);
        Route::post('/', [CampaignController::class, 'create']);
        Route::put('/{id}', [CampaignController::class, 'update']);
        Route::delete('/{id}', [CampaignController::class, 'destroy']);
    });

    Route::prefix('setting')->group(function () {
        Route::get('/', [SettingController::class, 'index']);
        Route::post('/', [SettingController::class, 'create']);
        Route::put('/{id}', [SettingController::class, 'update']);
    })->middleware('can:isSuperAdmin');

    Route::prefix('refund')->group(function () {
        Route::post('/', [RefundController::class, 'create']);
        Route::put('/', [RefundController::class, 'index'])->middleware('can:isSuperAdmin');
        Route::get('/{order_id}', [RefundController::class, 'show']);
    });
});

Route::get('event/{id}', [EventController::class, 'show']);
