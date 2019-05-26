<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        // On souhaite avec la variable category sur toutes les pages.
        View::share('categories',Category::where('id_parent','=',null)->get()); // identique à FetchAll()...
//        View::share('total_products_cart',\Cart::getContent()->count());
    }
}
