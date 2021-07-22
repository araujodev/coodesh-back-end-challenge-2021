<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

Route::middleware('apikey')->group(function (){

    Route::get('/', function (){
        return response()->json([
            'message' => trans('messages.is_running')
        ], Response::HTTP_OK);
    });

});
