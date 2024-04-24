<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

Route::get('/search-pages', [SearchController::class, 'searchPages'])->name('search.pages');