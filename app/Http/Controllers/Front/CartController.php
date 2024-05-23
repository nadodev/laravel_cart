<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddToCartRequest;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(AddToCartRequest $request)
    {

        $product = Product::where('slug', $request->slug)->first();
        Cart::add($product->id, $product->title, 1, $product->price, ['slug' => $product->slug]);

        return response()->json(['succes' => 1, 'message' => 'Product has been added to cart']);
    }
}
