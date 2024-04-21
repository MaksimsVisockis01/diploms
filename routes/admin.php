<?php
use App\Http\Middleware\LogMiddleware;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Termwind\Question;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CategoryController;

Route::redirect('admin', '/admin/index')->name('admin');

Route::prefix('admin')->group(function () {
    Route::middleware('auth')->middleware('admin')->group(function () {
        Route::get('users', [UsersController::class, 'index'])->name('admin.users.index');
        Route::delete('users/{user_id}', [UsersController::class, 'destroy'])->name('admin.users.destroy');

        Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    });
 });