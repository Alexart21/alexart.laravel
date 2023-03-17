<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

Route::prefix('test')->controller(TestController::class)->group(function (){
    Route::middleware('auth')->post('/store', [ TestController::class, 'store' ])->name('test.store');
    Route::middleware('auth')->delete('/remove/{id}', [ TestController::class, 'remove' ])->name('test.remove');
    Route::middleware('auth')->get('/', 'index')->name('test.index');
    Route::get('/dadata', 'dadata')->name('test.dadata');
    Route::get('/address', 'address')->name('test.address');
    Route::post('/info', 'info')->name('test.info');
    Route::post('/save', 'save')->name('test.save');
    Route::get('/confirm', 'confirm')->name('test.confirm');
    Route::post('/confirm', 'confirmStore')->name('test.confirmStore');;
    Route::get('/form', 'form')->name('test.form');
    Route::get('/download', 'download')->name('test.download');
    Route::get('/video', 'video')->name('test.video');
    Route::get('/videopage', 'videopage')->name('test.videopage');
});
