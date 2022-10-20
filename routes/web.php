<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CallsController;
use App\Http\Controllers\OAuth\GoogleController;

Route::get('/', [ ContentController::class, 'index' ])->name('content.index');
// все остальные страницы кроме главной
Route::get('/{page}', [ ContentController::class, 'page' ])->name('content.page')->whereIn('page', ['sozdanie', 'prodvijenie', 'portfolio', 'parsing']);

Route::post('/post', [ PostsController::class, 'store' ])->name('post.store');

Route::post('/call', [ CallsController::class, 'store' ])->name('call.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

require __DIR__.'/auth.php';
