<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('user', [UserController::class, 'create']);
    Route::post('event', [EventController::class, 'create']);
    Route::post('event/update/{id}', [EventController::class, 'update']);
    Route::delete('event/delete/{id}', [EventController::class, 'destroy']);
    Route::get('event', [EventController::class, 'index']);
    Route::get('event/{id}', [EventController::class, 'show']);
    Route::get('ticket', [TicketController::class, 'index']);
});
