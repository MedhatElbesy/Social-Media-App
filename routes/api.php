<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/




Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::post('logout',[LogoutController::class,'logout'])->middleware('auth:sanctum');
Route::get('set-locale/{locale}', [LocaleController::class, 'setLocale']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('tweet', [TweetController::class, 'createTweet']);

    Route::controller(UserController::class)->group(function(){
        Route::post('follow/{user}','follow');
        Route::get('timeline','timeline');
    });

});
