<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DefaultController;
use App\Http\Controllers\Admin\AdminContentController;

Route::get('/admin', [ DefaultController::class, 'index' ])->name('admin.index');

Route::resource('admin/content', AdminContentController::class)->parameters(['id' => 'id']);;
