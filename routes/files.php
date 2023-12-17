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

// Route::redirect('forum', '/forum/dashboard')->name('forum');

// Route::prefix('forum')->group(function () {

     
//      Route::middleware('auth')->group(function () { //позволяет зайти, если пользователь уже зареган
//           Route::get('question', [QuestionController::class, 'index'])->name('question');
//           Route::post('question', [QuestionController::class, 'store'])->name('question.store');

//           Route::get('question/{question_id}/edit', [QuestionController::class, 'edit'])->name('question.edit');
//           Route::put('question/{question_id}', [QuestionController::class, 'update'])->name('question.update');
//           Route::delete('question/{question_id}', [QuestionController::class, 'destroy'])->name('question.destroy');

//           Route::get('question/{question_id}/comments/{comment_id}/edit', [CommentController::class, 'edit'])->name('comment.edit');
//           Route::put('question/{question_id}/comments/{comment_id}', [CommentController::class, 'update'])->name('comment.update');
//           Route::delete('question/{question_id}/comments/{comment_id}', [CommentController::class, 'destroy'])->name('comment.destroy');
//      });

//      Route::get('dashboard', [DashboardController::class, 'index'])->name('forum');

//      Route::get('question/{question_id}', [QuestionController::class, 'show'])->name('question.show');

//      Route::post('question/{question_id}/comments', [CommentController::class, 'store'])->name('question.comment.store');
// });