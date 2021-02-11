<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopPageController extends Controller
{
    public function index()
    {
        $catgories = Category::all();
        if(request()->category){
            $products = Product::with('categories')->whereHas('categories', function($query){
                $query->where('slug', request()->category);
            });
            $catgoryName = optional($catgories->where('slug', request()->category)->first())->name;
        }else{
            $products = Product::where('featured', true)->inRandomOrder();
            $catgoryName = 'Featured items';
        }

        if(request()->sort == 'low_high'){
            $products = $products->orderBy('price')->paginate(9);
        }elseif(request()->sort == 'high_low'){
            $products = $products->orderBy('price','desc')->paginate(9);
        }else{
            $products = $products->paginate(9);
        }
        return view('frontend.shop',[
            'products' => $products,
            'categories' => $catgories,
            'catgoryName' => $catgoryName
        ]);
    }
    public function show($slug)
    {

        $product = Product::where('slug',$slug)->firstOrFail();
        return view('frontend.product')->with('product', $product);
    }
}
