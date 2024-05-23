<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {

        $products = Product::get();

        return view('front.product.index', compact('products'));
    }

    public function show(string $slug): View
    {

        $product = Product::where('slug', $slug)->first();

        return view('front.product.product-details', compact('product'));
    }

}
