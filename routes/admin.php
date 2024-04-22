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
        Route::delete('categories/{category_id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
        
        Route::get('category', [CategoryController::class, 'create'])->name('admin.category.create');
        Route::post('category', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::get('category/{category_id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::put('category/{category_id}', [CategoryController::class, 'update'])->name('admin.category.update');
    });
 });