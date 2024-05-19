<?php
use App\Http\Controllers\Files\FilesController;
use App\Http\Middleware\LogMiddleware;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Termwind\Question;

Route::redirect('files', '/files/index')->name('files');

Route::prefix('files')->group(function () {
     Route::middleware('auth')->group(function () {
          Route::post('index', [FilesController::class, 'store'])->name('index.store');


     });

     Route::get('index', [FilesController::class, 'index'])->name('index');
     Route::get('dashboard', [FilesController::class, 'dashboard'])->name('dashboard');

});