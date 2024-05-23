<?php

namespace App\Models;

use Gloudemans\Shoppingcart\Facades\Cart as FacadesCart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Cart extends Model
{
    use HasFactory;


    public static function add(Request $request)
    {
        $product = Product::where('slug', $request->slug)->first();
        FacadesCart::add($product->id, $product->title, 1, $product->price, ['slug' => $product->slug]);

        return response()->json(['succes' => 1, 'message' => 'Product has been added to cart']);
    }
}
