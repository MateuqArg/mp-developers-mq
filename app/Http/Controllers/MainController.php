<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Slider;
use App\Unique;

class MainController extends Controller
{
    public function index()
    {
    	$most_visited = Product::all()->sortByDesc('visits')->take(4);

    	// $sliders = Slider::all();

    	// $unique = Unique::find(1);

    	// $numeros = [4,4,5,5];

    	// $media = array_sum($numeros)/count($numeros);

    	return view('home', compact('most_visited'));
    }

    public function displayImage($filename)
    {

    $path = storage_path('app/public/' . $filename);

    if (!\File::exists($path)) {
        abort(404);

    }

    $file = \File::get($path);

    $type = \File::mimeType($path);

    $response = \Response::make($file, 200);

    $response->header("Content-Type", $type); 

    return $response;
    }
}
