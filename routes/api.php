<?php

use App\Http\Controllers\ApiTokenController;
use App\Http\Controllers\AdminSaleController;
use App\Http\Controllers\ClientMoviesController;
use App\Http\Controllers\ClientHallController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AdminMovieController;
use \App\Http\Controllers\AdminHallController;
use \App\Http\Controllers\AdminSeatController;
use \App\Http\Controllers\AdminSeanceController;
use \App\Http\Controllers\ClientTicketController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResources([
        '/sales' => AdminSaleController::class,
        '/movies' => AdminMovieController::class,
        '/halls' => AdminHallController::class,
        '/seats' => AdminSeatController::class,
        '/seances' => AdminSeanceController::class,
    ]);
});

Route::get('/ticket/{ticketId}', [ClientTicketController::class, 'show']);
Route::post('/ticket', [ClientTicketController::class, 'store']);
Route::post('/tokens/create', [ApiTokenController::class, 'createToken']);
Route::get('/movies', [ClientMoviesController::class, 'index']);
Route::get('/{date}/seance/{seanceId}', [ClientHallController::class, 'show']);
