<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Log;

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
        // if (config('app.debug')) {
        //     DB::listen(function ($query) {
        //         Log::info('Query Time: ' . $query->time . 'ms [' . $query->sql . ']');
        //     });
        // }
        Blade::component('comment-container', \App\View\Components\comment_container::class);
        Blade::component('edit-forms-heading', \App\View\Components\edit_forms_heading::class);
        Blade::component('form-75-container', \App\View\Components\form_75_container::class);
        Blade::component('form-wrapper', \App\View\Components\form_wrapper::class);
        Blade::component('forms-header', \App\View\Components\forms_header::class);
        Blade::component('forms-heading', \App\View\Components\forms_heading::class);
        Blade::component('mini-forms-header', \App\View\Components\mini_forms_header::class);
        Blade::component('search-container', \App\View\Components\search_container::class);
    }
}
