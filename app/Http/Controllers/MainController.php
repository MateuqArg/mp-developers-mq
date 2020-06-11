<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ignacio\MercadoPago\MP;
use App\Category;
use App\Product;
use App\Slider;
use App\Unique;

class MainController extends Controller
{
    public function index()
    {
    	$most_visited = Product::all()->sortByDesc('visits')->take(4);

    	$sliders = Slider::all();

    	$unique = Unique::find(1);

    	$numeros = [4,4,5,5];

    	$media = array_sum($numeros)/count($numeros);

    	return view('home', compact('most_visited', 'sliders', 'unique'));
    }
}
