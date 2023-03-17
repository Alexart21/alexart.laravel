<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CallsController;
use App\Http\Controllers\SocketsController;
use App\Http\Controllers\BotController;

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

// проверка telegramm bot
Route::get('/bot', [ BotController::class, 'index' ])->name('bot.index');
Route::post('/bot', [ BotController::class, 'index' ])->name('bot.index');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::post('/test', [ TestController::class, 'store' ])->name('test.store');
// это эксперименты с сервисом DaData
Route::post('/mail/info', [ PostsController::class, 'info' ])->name('post.info');
Route::post('/zvonok/info', [ CallsController::class, 'info' ])->name('zvonok.info');

Route::post("/sockets/connect", [SocketsController::class, "connect"]);
