<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\OrderController;

//AuthController
Route::post('/register', [AuthController::class, 'register']); // Register a new user
Route::post('/login', [AuthController::class, 'login']); // Login an existing user

//ConcertController
Route::get('/concerts', [ConcertController::class, 'index'])->name('concerts.index');   // Display concerts
Route::get('/concerts/{concert}', [ConcertController::class, 'show'])->name('concerts.show');   // Display single concert

//TicketController
Route::get('/concerts/{concertId}/tickets', [TicketController::class, 'index'])->name('tickets.index');   // Show tickets for specific concert
Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');   // Show specific ticket details


Route::middleware('auth:sanctum')->group(function () {
    //ConcertController for creating/deleting concert
    Route::get('/concerts/create', [ConcertController::class, 'create'])->name('concerts.create');   // Show form for creating concert
    Route::post('/concerts', [ConcertController::class, 'store'])->name('concerts.store');   // Store concert
    Route::delete('/concerts/{concert}', [ConcertController::class, 'destroy'])->name('concerts.destroy');   // Delete concert

    //TicketController for creating/deleting ticket
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');   // Store new ticket
    Route::delete('/tickets/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');   // Delete ticket

    //OrderController
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');   // Show all orders for the logged-in user
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');   // Show specific order details
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');   // Store new order

    //AuthController
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout'); // Authenticated users can log out
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
