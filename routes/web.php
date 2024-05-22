<?php
use App\Http\Controllers\PublicCategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;




Route::get('/categories', [PublicCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [PublicCategoryController::class, 'show'])->name('category.show');
// Route::get('/', function () {
//     return view('welcome');
// });


Route::view('/', 'home.index')->name('/');

// Route::get('test', TestController::class)->name('test');
// Route::resource('posts/{post}/comments', CommentController::class);
Route::redirect('/home', '/')->name('home'); //переадресует с определенной адресной строки на другую(в данном случае с /home  на главную)

Route::middleware('guest')->group(function () { //RedirectIfAuthenticated (переадресует пользователя если он уже залогинился)
     Route::get('register', [RegisterController::class, 'index'])->name('register');
     Route::post('register', [RegisterController::class, 'store'])->name('register.store');

     Route::get('login', [LoginController::class, 'index'])->name('login');
     Route::post('login', [LoginController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
     Route::get('/profile', [ProfileController::class, 'myProfile'])->name('profile.my');
     Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
     Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
     Route::post('/profile/{id}/update', [ProfileController::class, 'update'])->name('profile.update');
     Route::get('/logout', [LogoutController::class, 'index'])->name('logout');
 });

     // Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');




