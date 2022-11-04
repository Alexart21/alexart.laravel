<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CallsController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\OAuth\OauthController;

Route::get('/', [ ContentController::class, 'index' ])->name('content.index');
// все остальные страницы кроме главной
Route::get('/{page}', [ ContentController::class, 'page' ])->name('content.page')->whereIn('page', ['sozdanie', 'prodvijenie', 'portfolio', 'parsing']);

Route::get('/test', [ TestController::class, 'index' ])->name('test.index');
Route::post('/test', [ TestController::class, 'store' ])->name('test.store');

//Route::post('/post', [ PostsController::class, 'store' ])->name('post.store');
//Route::post('/call', [ CallsController::class, 'store' ])->name('call.store');

// ограничения описаны в app/Providers/AppServiceProvider.php
Route::middleware(['throttle:formsLimit'])->group(function () {
    Route::post('/post', [ PostsController::class, 'store' ])->name('post.store');
    Route::post('/call', [ CallsController::class, 'store' ])->name('call.store');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('auth/{service}', [OauthController::class, 'redirectToService'])->whereIn('service', ['google', 'github', 'mailru', 'odnoklassniki', 'vkontakte', 'yandex']);
Route::get('auth/{service}/callback', [OauthController::class, 'handleCallback'])->whereIn('service', ['google', 'github', 'mailru', 'odnoklassniki', 'vkontakte', 'yandex']);
Route::delete('auth/destroy/{id}', [OauthController::class, 'destroy'])->whereNumber(['id'])->name('oauth.destroy');

require __DIR__.'/auth.php';

require __DIR__.'/admin.php';
