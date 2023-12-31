<?php

use App\Http\Controllers\Forum\DashboardController;
use App\Http\Controllers\Forum\QuestionController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Posts\CommentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\LogMiddleware;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Termwind\Question;




// Route::get('/', function () {
//     return view('welcome');
// });


Route::view('/', 'home.index')->name('/');

Route::get('test', TestController::class)->name('test');
Route::resource('posts/{post}/comments', CommentController::class);
Route::redirect('/home', '/')->name('home'); //переадресует с определенной адресной строки на другую(в данном случае с /home  на главную)

Route::middleware('guest')->group(function () { //RedirectIfAuthenticated (переадресует пользователя если он уже залогинился)
     Route::get('register', [RegisterController::class, 'index'])->name('register');
     Route::post('register', [RegisterController::class, 'store'])->name('register.store');

     Route::get('login', [LoginController::class, 'index'])->name('login');
     Route::post('login', [LoginController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {//позволяет зайти, если пользователь уже зареган
     Route::get('logout', [LogoutController::class, 'index'])->name('logout');
});




