<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\QuoteController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

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