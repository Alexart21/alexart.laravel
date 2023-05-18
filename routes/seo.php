<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeoController;

Route::prefix('seo')->controller(SeoController::class)->group(function (){
    Route::get('/', 'index')->name('seo.index');
    Route::get('/speed', 'speed')->name('seo.speed');
    Route::get('/tech', 'tech')->name('seo.tech');
    Route::get('/semantic', 'semantic')->name('seo.semantic');
});
