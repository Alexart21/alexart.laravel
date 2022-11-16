<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DefaultController;
use App\Http\Controllers\Admin\AdminContentController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminCallController;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified', 'can:manager', 'adminPanel']], function () {
    // шлюзы 'admin' и 'manager' описан в app/Providers/AuthServiceProvider.php
    Route::group(['middleware' => 'can:admin'], function (){
        Route::get('/content/trash', [ AdminContentController::class, 'trash' ])->name('content.trash');
        Route::put('/content/{id}/restore', [ AdminContentController::class, 'restore' ])->whereNumber(['id'])->name('content.restore');
        Route::delete('/content/{id}/destroy', [ AdminContentController::class, 'destroyForewer' ])->whereNumber(['id'])->name('content.remove');

        Route::resource('/content', AdminContentController::class)->parameters(['id' => 'id']);
        });

    Route::group(['middleware' => 'can:manager'], function (){
        Route::get('/', [ DefaultController::class, 'index' ])->name('admin.index');
        Route::post('/cache', [ DefaultController::class, 'cache' ])->name('admin.cache');
        Route::post('/last', [ DefaultController::class, 'last' ])->name('admin.last');

        Route::get('/post/trash', [ AdminPostController::class, 'trash' ])->name('post.trash');
        Route::put('/post/{id}/restore', [ AdminPostController::class, 'restore' ])->whereNumber(['id'])->name('post.restore');
        Route::delete('/post/{id}/destroy', [ AdminPostController::class, 'destroyForewer' ])->whereNumber(['id'])->name('post.remove');
        Route::delete('/post/clearTrash', [ AdminPostController::class, 'clearTrash' ])->name('post.clear');
        Route::delete('/post/destroyAll', [  AdminPostController::class, 'destroyAll' ])->name('post.destroyAll');
        Route::delete('/post/deleteAll', [  AdminPostController::class, 'deleteAll' ])->name('post.deleteAll');

        Route::get('/call/trash', [ AdminCallController::class, 'trash' ])->name('call.trash');
        Route::put('/call/{id}/restore', [ AdminCallController::class, 'restore' ])->whereNumber(['id'])->name('call.restore');
        Route::delete('/call/{id}/destroy', [ AdminCallController::class, 'destroyForewer' ])->whereNumber(['id'])->name('call.remove');
        Route::delete('/call/clearTrash', [  AdminCallController::class, 'clearTrash' ])->name('call.clear');
        Route::delete('/call/destroyAll', [  AdminCallController::class, 'destroyAll' ])->name('call.destroyAll');
        Route::delete('/call/deleteAll', [  AdminCallController::class, 'deleteAll' ])->name('call.deleteAll');

        Route::resource('/post', AdminPostController::class)->parameters(['id' => 'id']);
        Route::resource('/call', AdminCallController::class)->parameters(['id' => 'id']);
    });

});
