<?php

use App\Http\Controllers\Forum\DashboardController;
use App\Http\Controllers\Forum\QuestionController;
use App\Http\Controllers\Posts\CommentController;
use App\Http\Middleware\LogMiddleware;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Termwind\Question;

Route::prefix('forum')->group(function () {
     
     Route::middleware('auth')->group(function () { //позволяет зайти, если пользователь уже зареган
          Route::get('question', [QuestionController::class, 'index'])->name('question');
          Route::post('question', [QuestionController::class, 'store'])->name('question.store');
     });

     Route::get('dashboard', [DashboardController::class, 'index'])->name('forum');
});