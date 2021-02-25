<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {   
        $productRow1 = Product::inRandomOrder()->take(6)->get();
        $featuredSlider = Product::inRandomOrder()->take(4)->get();
        return view('frontend.landing',[
            'productRow1' => $productRow1,
            'featuredSlider' => $featuredSlider,
        ]);
    }
}
