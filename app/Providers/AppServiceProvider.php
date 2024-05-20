<?php

namespace App\Providers;

use App\View\Components\card;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $popularCategories = Category::withCount(['questions', 'files'])
                ->get()
                ->sortByDesc(function ($category) {
                    return $category->questions_count + $category->files_count;
                })
                ->take(3);

            $view->with('popularCategories', $popularCategories);
        });
    }
}
