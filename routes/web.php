<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\OAuth\OauthController;
use App\Http\Controllers\Admin\CKEditorController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CallsController;

Route::get('/', [ ContentController::class, 'index' ])->name('content.index');

Route::prefix('test')->controller(TestController::class)->group(function (){
    Route::get('/', 'index')->name('test.index');
    Route::get('/dadata', 'dadata')->name('test.dadata');
    Route::get('/address', 'address')->name('test.address');
    Route::post('/info', 'info')->name('test.info');
    Route::post('/save', 'save')->name('test.save');
});

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

require __DIR__.'/ws.php';

require __DIR__.'/admin.php';

require __DIR__.'/auth.php';

// все остальные страницы кроме главной
//Route::get('/{page}', [ ContentController::class, 'page' ])->name('content.page')->whereIn('page', ['sozdanie', 'prodvijenie', 'portfolio', 'parsing', 'bla']);
Route::get('/{page}', [ ContentController::class, 'page' ])->name('content.page');

Route::post('ckeditor/image_upload', [ CKEditorController::class, 'upload' ])->name('upload');




