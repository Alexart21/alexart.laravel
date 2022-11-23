<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DefaultController;
use App\Http\Controllers\Admin\AdminContentController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminCallController;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified', 'can:manager', 'adminPanel']], function () {
    // шлюзы 'admin' и 'manager' описан в app/Providers/AuthServiceProvider.php
    // у админа обязательно есть role 'manager'
    Route::controller(AdminContentController::class)->middleware('can:admin')->group(function () {
        Route::get('/content/trash', 'trash')->name('content.trash');
        Route::put('/content/{id}/restore', 'restore')->whereNumber(['id'])->name('content.restore');
        Route::delete('/content/{id}/destroy', 'destroyForewer')->whereNumber(['id'])->name('content.remove');
        Route::resource('/content', AdminContentController::class)->parameters(['id' => 'id']);
    });

    // большая группа роутов
    Route::group(['middleware' => 'can:manager'], function () {
        Route::controller(DefaultController::class)->group(function () {
            Route::get('/', 'index')->name('admin.index');
            Route::post('/cache', 'cache')->name('admin.cache');
            Route::post('/last', 'last')->name('admin.last');
        });

        Route::controller(AdminPostController::class)->group(function () {
            Route::get('/post/trash', 'trash')->name('post.trash');
            Route::put('/post/{id}/restore', 'restore')->whereNumber(['id'])->name('post.restore');
            Route::delete('/post/{id}/destroy', 'destroyForewer')->whereNumber(['id'])->name('post.remove');
            Route::delete('/post/clearTrash', 'clearTrash')->name('post.clear');
            Route::delete('/post/destroyAll', 'destroyAll')->name('post.destroyAll');
            Route::delete('/post/deleteAll', 'deleteAll')->name('post.deleteAll');
        });

        Route::controller(AdminCallController::class)->group(function () {
            Route::get('/call/trash', 'trash')->name('call.trash');
            Route::put('/call/{id}/restore', 'restore')->whereNumber(['id'])->name('call.restore');
            Route::delete('/call/{id}/destroy', 'destroyForewer')->whereNumber(['id'])->name('call.remove');
            Route::delete('/call/clearTrash', 'clearTrash')->name('call.clear');
            Route::delete('/call/destroyAll', 'destroyAll')->name('call.destroyAll');
            Route::delete('/call/deleteAll', 'deleteAll')->name('call.deleteAll');
        });

        Route::resource('/call', AdminCallController::class)->parameters(['id' => 'id']);
        Route::resource('/post', AdminPostController::class)->parameters(['id' => 'id']);
    });
});
