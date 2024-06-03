<?php

namespace App\Providers;

use App\Models\category;
use Illuminate\Support\Facades\View;
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
        //category links used the home pageheader
        View::composer('*',function($view){
            $categorylinks = category::all();
            $view->with('categorylinks', $categorylinks);


        });
    }
}
