<?php

use App\Http\Controllers\API\ChannelAPIController;
use App\Http\Controllers\API\LoginUserAPIController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterUserAPIController;
use Illuminate\Support\Facades\Log;

// Route::get('/bondan', function () {
//     return "Hello World !";
// });
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::controller(RegisterController::class)->group(function(){
//     Route::post('register', 'register');
//     Route::post('login', 'login');
// });
Route::post('/register', [RegisterUserAPIController::class, 'store']);
Route::post('/login', [LoginUserAPIController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/channels', [ChannelAPIController::class, 'index']);
    Route::post('/channels', [ChannelAPIController::class, 'store']);
});