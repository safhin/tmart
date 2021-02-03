<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Cartalyst\Stripe\Exception\CardErrorException;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('frontend.checkout');
    }

    public function store(Request $request)
    {
        $contents = Cart::content()->map(function($item){
            return $item->model->slug.','.$item->qty;
        })->values()->toJson();
        try{
           $charge = Stripe::charges()->create([
                'amount' => Cart::total(),
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count(),
                ]
            ]);
            Cart::instance('default')->destroy();
            return redirect()->route('confirmation.index')->with('success_message', 'Your payment has been accepted!');
        }catch(CardErrorException $e){
            return back()->withErrors('Error!'.$e->getMessage()); 
        }
    }
}
