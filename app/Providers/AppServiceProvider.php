<?php

namespace App\Providers;

use App\Models\Categories;
use Illuminate\Support\ServiceProvider;

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
    public function boot(): void
    {
        view()->composer('frontend.components._partials._header',function($view){

            $view->with('categorys',Categories::where('status', 1)
                ->orderBy('name', 'asc')
                ->get());


        });

    }
}
