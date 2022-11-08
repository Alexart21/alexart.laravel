<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CallsController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\OAuth\OauthController;
use App\Http\Controllers\Admin\DefaultController;
use App\Http\Controllers\Admin\CKEditorController;

Route::get('/', [ ContentController::class, 'index' ])->name('content.index');

Route::get('/test', [ TestController::class, 'index' ])->name('test.index');
Route::post('/test', [ TestController::class, 'store' ])->name('test.store');

// все остальные страницы кроме главной
Route::get('/{page}', [ ContentController::class, 'page' ])->name('content.page')->whereIn('page', ['sozdanie', 'prodvijenie', 'portfolio', 'parsing', 'bla']);
//Route::get('/{page}', [ ContentController::class, 'page' ])->name('content.page');



// ограничения описаны в app/Providers/AppServiceProvider.php
Route::middleware(['throttle:formsLimit'])->group(function () {
    Route::post('/mail', [ PostsController::class, 'store' ])->name('mail.store');
    Route::post('/zvonok', [ CallsController::class, 'store' ])->name('zvonok.store');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('auth/{service}', [OauthController::class, 'redirectToService'])->whereIn('service', ['google', 'github', 'mailru', 'odnoklassniki', 'vkontakte', 'yandex']);
Route::get('auth/{service}/callback', [OauthController::class, 'handleCallback'])->whereIn('service', ['google', 'github', 'mailru', 'odnoklassniki', 'vkontakte', 'yandex']);

//Route::post('ckeditor/image_upload', 'CKEditorController@upload')->name('upload');
Route::post('ckeditor/image_upload', [ CKEditorController::class, 'upload' ])->name('upload');

require __DIR__.'/auth.php';

require __DIR__.'/admin.php';
