<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Posts\CommentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\LogMiddleware;
use Illuminate\Support\Facades\Route;



// Route::get('/', function () {
//     return view('welcome');
// });


Route::view('/', 'home.index');

Route::get('test', TestController::class)->name('test');






Route::resource('posts/{post}/comments', CommentController::class);



Route::redirect('/home', '/'); //переадресует с определенной адресной строки на другую(в данном случае с /home  на главную)

Route::middleware('guest')->group(function () {

     Route::get('register', [RegisterController::class, 'index'])->name('register');
     Route::post('register', [RegisterController::class, 'store'])->name('register.store');

     Route::get('login', [LoginController::class, 'index'])->name('login');
     Route::post('login', [LoginController::class, 'store'])->name('login.store');
});


