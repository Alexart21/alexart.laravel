<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CallsController;
use App\Http\Controllers\OAuth\GoogleController;
use App\Http\Controllers\OAuth\GithubController;
use App\Http\Controllers\OAuth\MailruController;
use App\Http\Controllers\OAuth\VkontakteController;
use App\Http\Controllers\OAuth\OdnoklassnikiController;
use App\Http\Controllers\OAuth\YandexController;
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

/*Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::delete('auth/google/destroy/{id}', [GoogleController::class, 'destroy'])->whereNumber(['id'])->name('google.destroy');

Route::get('auth/github', [GithubController::class, 'redirectToGithub']);
Route::get('auth/github/callback', [GithubController::class, 'handleGithubCallback']);
Route::delete('auth/github/destroy/{id}', [GithubController::class, 'destroy'])->whereNumber(['id'])->name('github.destroy');

Route::get('auth/yandex', [YandexController::class, 'redirectToYandex']);
Route::get('auth/yandex/callback', [YandexController::class, 'handleYandexCallback']);
Route::delete('auth/yandex/destroy/{id}', [YandexController::class, 'destroy'])->whereNumber(['id'])->name('yandex.destroy');

Route::get('auth/mailru', [MailruController::class, 'redirectToMailru']);
Route::get('auth/mailru/callback', [MailruController::class, 'handleMailruCallback']);
Route::delete('auth/mailru/destroy/{id}', [MailruController::class, 'destroy'])->whereNumber(['id'])->name('mailru.destroy');

Route::get('auth/odnoklassniki', [OdnoklassnikiController::class, 'redirectToOk']);
Route::get('auth/odnoklassniki/callback', [OdnoklassnikiController::class, 'handleOkCallback']);
Route::delete('auth/odnoklassniki/destroy/{id}', [OdnoklassnikiController::class, 'destroy'])->whereNumber(['id'])->name('odnoklassniki.destroy');

Route::get('auth/vkontakte', [VkontakteController::class, 'redirectToVk']);
Route::get('auth/vkontakte/callback', [VkontakteController::class, 'handleVkCallback']);
Route::delete('auth/vkontakte/destroy/{id}', [VkontakteController::class, 'destroy'])->whereNumber(['id'])->name('vkontakte.destroy');*/

require __DIR__.'/auth.php';
