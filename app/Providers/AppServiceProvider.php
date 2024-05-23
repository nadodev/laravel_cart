<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use Gloudemans\Shoppingcart\Facades\Cart as FacadesCart;
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

        View::composer('*', function($view){
            $main_categories = Category::orderBy('id', 'DESC')->take(10)->get();


            $cartItems = FacadesCart::instance('default')->count();
            $cartSubTotal = number_format((int) FacadesCart::subtotal() , 2, ',',',');

            $view->with('main_categories', $main_categories);
            $view->with('cartItems', $cartItems);
            $view->with('totalPrice', $cartSubTotal);
        });
    }
}
