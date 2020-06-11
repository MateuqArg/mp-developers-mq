<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Category;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        
        view()->composer('*', function ($view) 
        {
            if (session('cart')) {
                $cart = session('cart')->fresh();
            } else {
                $cart = null;
            }

            if ($cart) {
                $count_cart = count($cart->products);
            } else {
                $count_cart = 0;
            }

            $view->with('count_cart', $count_cart );  
        });  

        // $categories = Category::all();

        // view()->share('categories', $categories);
    }
}
