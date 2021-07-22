<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\UserController;
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
Route::middleware(['guest', 'throttle:3'])->group(function () {
    // получение токена доступа
    Route::post('/token', [UserController::class, 'token']);
});

// роуты доступные только после авторизации
Route::middleware(['auth:sanctum', 'throttle:' . config('api.requests_per_minute'), 'api.request'])->group(function() {

    /*
    |------------------------------------------
    | Статистика
    |------------------------------------------
    */
    Route::get('/stats', [StatisticController::class, 'total']);
    Route::get('/my-stats', [StatisticController::class, 'my']);

    /*
    |------------------------------------------
    | Эпизоды
    |------------------------------------------
    */
    Route::resource('/episodes', EpisodeController::class)->only(['index', 'show']);

    /*
    |------------------------------------------
    | Персонажи
    |------------------------------------------
    */
    Route::get('/characters', [CharacterController::class, 'index']);
    Route::get('/characters/random', [CharacterController::class, 'random']);

    /*
    |------------------------------------------
    | Цитаты
    |------------------------------------------
    */
    Route::get('/quotes', [QuoteController::class, 'index']);
    Route::get('/quotes/random', [QuoteController::class, 'random']);
});

