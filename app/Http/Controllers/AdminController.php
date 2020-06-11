<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Slider;
use App\Unique;
use Storage;

class AdminController extends Controller
{
    public function index()
    {
    	$most_visited = Product::all()->sortByDesc('visits')->take(4);

    	$sliders = Slider::all();

    	$unique = Unique::find(1);

    	$numeros = [4,4,5,5];

    	$media = array_sum($numeros)/count($numeros);

    	return view('admin.index', compact('most_visited', 'sliders', 'unique'));
    }

    public function storeSlider(Request $request)
    {
    	$imageName = time().'.'.request()->image->getClientOriginalExtension();

        request()->image->move(public_path('images'), $imageName);

        $slider = new Slider;
        $slider->number = $request->number;
        $slider->img = $imageName;
        $slider->save();

    	return redirect()->back()->with('success', 'Imagen subida al slider');
    }
}
