<?php

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
require base_path('routes/resources/users.php');

Route::middleware('guest')->get('/i-am-alive', function (Request $request) {
    return response()->json(['alive' => true], 200);
});
