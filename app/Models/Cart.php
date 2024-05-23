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
        FacadesCart::instance($request->card_type)->add($product->id, $product->title, 1, $product->price, ['slug' => $product->slug])->associate(Product::class);

        if($request->card_type == 'whitelist') {
            return response()->json(['succes' => 1, 'message' => 'whitelist has been added to cart']);
        }else{

            return response()->json(['succes' => 1, 'message' => 'Product has been added to cart']);
        }
    }
}


