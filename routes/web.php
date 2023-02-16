<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\OAuth\OauthController;
use App\Http\Controllers\Admin\CKEditorController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CallsController;
use App\Http\Controllers\DesignerController;
use App\Http\Controllers\ChatController;

Route::get('/', [ ContentController::class, 'index' ])->name('content.index');

// Всякие эксперименты
require __DIR__ . '/test.php';

// конструктор чехлов
Route::get('/designer', [ DesignerController::class, 'index' ])->name('designer.index');
Route::post('/constructor', [ DesignerController::class, 'store' ])->name('designer.store');

// ограничения описаны в app/Providers/AppServiceProvider.php
Route::middleware(['throttle:formsLimit'])->group(function () {
    Route::post('/mail', [ PostsController::class, 'store' ])->name('mail.store');
    Route::post('/zvonok', [ CallsController::class, 'store' ])->name('zvonok.store');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Oauth2 аутентификация
Route::get('auth/{service}', [OauthController::class, 'redirectToService'])->whereIn('service', ['google', 'github', 'mailru', 'odnoklassniki', 'vkontakte', 'yandex']);
Route::get('auth/{service}/callback', [OauthController::class, 'handleCallback'])->whereIn('service', ['google', 'github', 'mailru', 'odnoklassniki', 'vkontakte', 'yandex']);

require __DIR__.'/ws.php';

require __DIR__.'/admin.php';

require __DIR__.'/auth.php';

// чат где вебсокет сервер на Laravel
Route::get('/chat', [ ContentController::class, 'chat' ])->name('content.chat');
// чат где вебсокет сервер на поднимается отдельно на Node js
Route::get('/nodechat', [ ContentController::class, 'nodechat' ])->name('content.nodechat');
// чат на setTimeout VUE3 MYSQL
Route::get('/vchat', [ ChatController::class, 'index' ])->name('content.chat');
Route::get('/vchat/all', [ ChatController::class, 'all' ]);
Route::get('/vchat/update', [ ChatController::class, 'update' ]);
Route::post('/vchat/store', [ ChatController::class, 'store' ]);
Route::get('/csrf', [ ChatController::class, 'csrf' ]);

// все остальные страницы кроме главной
//Route::get('/{page}', [ ContentController::class, 'page' ])->name('content.page')->whereIn('page', ['sozdanie', 'prodvijenie', 'portfolio', 'parsing', 'bla']);
Route::get('/{page}', [ ContentController::class, 'page' ])->name('content.page');

Route::post('ckeditor/image_upload', [ CKEditorController::class, 'upload' ])->name('upload');




