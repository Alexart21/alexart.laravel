<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContentController;

Route::get('/', [ ContentController::class, 'index' ])->name('content.index');
// все остальные страницы кроме главной
Route::get('/{page}', [ ContentController::class, 'page' ])->name('content.page')->whereIn('page', ['sozdanie', 'prodvijenie', 'portfolio', 'parsing']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
