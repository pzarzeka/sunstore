<?php

use App\Http\Controllers\SearchController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/import', [ImportController::class, 'import'])
    ->name('import');
Route::post('/import-save', [ImportController::class, 'importSave'])
    ->withoutMiddleware(VerifyCsrfToken::class)
    ->name('import-save');

Route::get('/search', [SearchController::class, 'search'])
    ->name('search');
Route::get('/search-result', [SearchController::class, 'searchResult'])
    ->name('search-result');
