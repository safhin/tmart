<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('frontend.cart');
    }

    public function store(Product $product)
    {
        
        Cart::add($product->id,$product->title,1,$product->price)->associate('App\Models\Product');
        return redirect()->route('cart.index')->with('success_message', 'Item added successfully');
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(),[
            'quantity' => 'required|numeric|between:1,5'
        ]);
        if($validate->fails()){
            session()->flash('errors', collect(['Quantity must be between 1 and 5']));
            return response()->json(['success' => false]);
        }
        Cart::update($id, $request->quantity);
        session()->flash('success_message', 'Quantity was successfully updated!');
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Cart::remove($id);
        return back()->with('success_message', 'Item has been removed!');
    }
}
