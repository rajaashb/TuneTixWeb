<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/concerts', [ConcertController::class, 'index']);
Route::get('/concerts/{id}', [ConcertController::class, 'show']);
Route::get('/tickets/{id}', [TicketController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders', [OrderController::class, 'index']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
