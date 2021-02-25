<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {   
        $productRow1 = Product::inRandomOrder()->take(6)->get();
        $productRow2 = Product::inRandomOrder()->take(3)->get();
        $featuredSlider = Product::inRandomOrder()->take(4)->get();
        return view('frontend.landing',[
            'productRow1' => $productRow1,
            'productRow2' => $productRow2,
            'featuredSlider' => $featuredSlider
        ]);
    }
}
