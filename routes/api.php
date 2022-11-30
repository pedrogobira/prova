<?php

use App\Http\Controllers\Jogos\JogoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Times\JogadorController;
use App\Http\Controllers\Times\TimeController;
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

Route::prefix('auth')->group(function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('time', [TimeController::class, 'store']);
    Route::put('time/{id}', [TimeController::class, 'update']);
    Route::get('time', [TimeController::class, 'getAll']);

    Route::post('jogador', [JogadorController::class, 'store']);
    Route::put('jogador/{id}', [JogadorController::class, 'update']);
    Route::get('jogador', [JogadorController::class, 'getAll']);

    Route::post('jogo', [JogoController::class, 'store']);
    Route::put('jogo/{id}', [JogoController::class, 'update']);
    Route::get('jogo', [JogoController::class, 'getJogos']);
    Route::get('classificacao', [JogoController::class, 'getClassificacao']);
    Route::get('ranking-de-jogadores', [JogoController::class, 'getRankingDeJogador']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
