<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;

class ProductController extends Controller
{
    public function categoryShow(Request $request, $slug)
    {
    	$category = Category::where('slug', $slug)->first();

    	$products = Product::where('category_id', $category->id)->get();

    	return view('products.category', compact('category', 'products'));
    }

    public function productShow(Request $request, $category, $slug)
    {
    	$category = Category::where('slug', $category)->first();

    	$product = Product::where('slug', $slug)->first();

    	$interests = Product::where('category_id', $product->category_id)->take(4)->get();

    	return view('products.show', compact('category', 'product', 'interests'));
    }
}
