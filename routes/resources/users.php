<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('apikey')->prefix('users')->group(function() {

    Route::get('/{userId}', UserController::class . '@show')
        ->where('userId', '[0-9]+');

    Route::put('/{userId}', UserController::class . '@update');

    Route::delete('/{userId}', UserController::class . '@remove')
        ->where('userId', '[0-9]+');

    Route::get('/', UserController::class . '@index');

});
