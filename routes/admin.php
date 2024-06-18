<?php

use App\Http\Controllers\Admin\ManageFileController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CategoryController; 
use App\Http\Controllers\Admin\StatisticsController;

Route::middleware('active')->group(function () {
    Route::redirect('admin', '/admin/index')->name('admin');

    Route::prefix('admin')->group(function () {
        Route::middleware('auth')->middleware('admin')->group(function () {
            Route::get('users', [UsersController::class, 'index'])->name('admin.users.index');
            Route::post('users/approve/{id}', [RegisterController::class, 'approve'])->name('admin.users.approve');
            Route::delete('users/{id}', [UsersController::class, 'destroy'])->name('admin.users.destroy');

            Route::get('usercontrol', [ManageUserController::class, 'usercontrol'])->name('admin.users.usercontrol');
            Route::put('/user/{user}/toggle-teacher', [ManageUserController::class, 'toggleTeacher'])->name('users.toggle-teacher');
            Route::put('/user/{user}/toggle-active', [ManageUserController::class, 'toggleActive'])->name('users.toggle-active');

            // Route::get('filecontrol', [ManageFileController::class, 'filecontrol'])->name('admin.filecontrol');

            Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');
            Route::delete('categories/{category_id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
            
            Route::get('category', [CategoryController::class, 'create'])->name('admin.category.create');
            Route::post('category', [CategoryController::class, 'store'])->name('admin.category.store');
            Route::get('category/{category_id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
            Route::put('category/{category_id}', [CategoryController::class, 'update'])->name('admin.category.update');

            Route::get('/admin/statistics', [App\Http\Controllers\Admin\StatisticsController::class, 'index'])->name('admin.statistics');
            // Route::delete('/admin/statistics/questioncontrol/{id}', [App\Http\Controllers\Admin\StatisticsController::class, 'deleteQuestion'])->name('admin.questionscontrol.delete');
            // Route::delete('/admin/statistics/commentcontrol/{id}', [App\Http\Controllers\Admin\StatisticsController::class, 'deleteComment'])->name('admin.commentscontrol.delete');
            // Route::delete('/admin/statistics/filecontrol/{id}', [App\Http\Controllers\Admin\StatisticsController::class, 'deleteFile'])->name('admin.filescontrol.delete');
        });
    });
});
