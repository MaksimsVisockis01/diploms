<?php
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::prefix('user')->middleware(['active'])->group(function () {//prefix дает возможность сделать приписку к адресной строке

    Route::redirect('/', '/user/posts')->name('user');
         
    //CRUD функции (Create, Read, Update, Delete)

    //Route::resource('photos', PhotoController::class); // заменяет все crud методы
    // Route::resource('photos', PhotoController::class)-> only([ //можно использовать except, чтобы исключить все не нужные функции
    //     'index', 'create',
    // ]);//можно выбрать определенные, упращает работу

    Route::get('posts', [PostController::class, 'index'])->name('user.posts'); //страница для создания
    Route::get('posts/create', [PostController::class, 'create'])->name('user.posts.create'); //запрос создания поста

    Route::post('posts', [PostController::class, 'store'])->name('user.posts.store'); // (создаем)если правильно понял, что для храниения отправленной формы
    Route::get('posts/{post}', [PostController::class, 'show'])->name('user.posts.show'); //отображение поста({}принимает динамический параметр, тоесть может быть разный результат)

    Route::get('posts/{post}/edit', [PostController::class, 'edit'])->name('user.posts.edit'); //страница изменения поста

    Route::put('posts/{post}', [PostController::class, 'update'])->name('user.posts.update'); //запрос обновление поста
    Route::delete('posts/{post}', [PostController::class, 'delete'])->name('user.posts.delete'); //запрос удаление поста


    Route::put('posts/{post}/like', [PostController::class, 'like'])->name('user.posts.like');
     
 
 });