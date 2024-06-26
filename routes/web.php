<?php
use App\Http\Controllers\BroadcastController;
use App\Http\Controllers\PublicCategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::view('/inactive', 'inactive')->name('inactive');
Route::middleware('active')->group(function () {
Route::get('/categories', [PublicCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [PublicCategoryController::class, 'show'])->name('category.show');
Route::get('/categories/file/{file}', [PublicCategoryController::class, 'downloadFile'])->name('categories.file');

// Route::get('test', TestController::class)->name('test');
// Route::resource('posts/{post}/comments', CommentController::class);
// Route::redirect('/home', '/')->name('home'); //переадресует с определенной адресной строки на другую(в данном случае с /home  на главную)
Route::middleware('guest')->group(function () {
     Route::redirect('/', 'register');
});

Route::middleware('guest')->group(function () { 
     Route::get('register', [RegisterController::class, 'index'])->name('register');
     Route::post('register', [RegisterController::class, 'store'])->name('register.store');
     Route::get('register/complete/{token}', [RegisterController::class, 'complete'])->name('register.complete');
     Route::post('register/finalize', [RegisterController::class, 'finalize'])->name('register.finalize');
 
     Route::get('login', [LoginController::class, 'index'])->name('login');
     Route::post('login', [LoginController::class, 'store'])->name('login.store');
});
});

Route::middleware('auth')->group(function () {
     Route::middleware('active')->group(function () {
     Route::get('/profile', [ProfileController::class, 'myProfile'])->name('profile.my');
     Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
     Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
     Route::post('/profile/{id}/update', [ProfileController::class, 'update'])->name('profile.update');
     Route::get('/broadcasting', [BroadcastController::class, 'index'])->name('broadcast.index');
     Route::get('/start-broadcast', [BroadcastController::class, 'start'])->middleware('can.start.broadcast')->name('broadcast.start');
     });
     Route::get('/logout', [LogoutController::class, 'index'])->name('logout');
 });

     // Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');




