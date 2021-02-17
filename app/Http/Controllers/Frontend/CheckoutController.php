<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use Cartalyst\Stripe\Exception\CardErrorException;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('frontend.checkout')->with([
            'discount' => $this->getAmounts()->get('discount'),
            'newSubtotal' => $this->getAmounts()->get('newSubtotal'),
            'newTax' => $this->getAmounts()->get('newTax'),
            'newTotal' =>$this->getAmounts()->get('newTotal'),
        ]);
    }

    public function store(CheckoutRequest $request)
    {
        $contents = Cart::content()->map(function($item){
            return $item->model->slug.','.$item->qty;
        })->values()->toJson();
        try{
           $charge = Stripe::charges()->create([
                'amount' => $this->getAmounts()->get('newTotal'),
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count(),
                    'discount' => collect(session()->get('cupon'))->toJson(),
                ]
            ]);

            $this->addOrdersTable($request, null);
            
            Cart::instance('default')->destroy();
            session()->forget('cupon');
            return redirect()->route('confirmation.index')->with('success_message', 'Your payment has been accepted!');
        }catch(CardErrorException $e){
            $this->addOrdersTable($request, $e->getMessage());
            return back()->withErrors('Error!'.$e->getMessage()); 
        }
    }

    protected function addOrdersTable($request, $error)
    {
        //Insert order into database
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'billing_name' => $request->name,
            'billing_email' => $request->email,
            'billing_address' => $request->address,
            'billing_postalcode' => $request->postalcode,
            'billing_province' => $request->province,
            'billing_city' => $request->city,
            'billing_phone' => $request->phone,
            'billing_name_on_card' => $request->name_on_card,
            'billing_discount_code' => $request->cupon_code,
            'billing_discount' => $this->getAmounts()->get('discount'),
            'billing_subtotal' => $this->getAmounts()->get('newSubtotal'),
            'billing_tax' => $this->getAmounts()->get('newTax'),
            'billing_total' => $this->getAmounts()->get('newTotal'),
            'shipped' => $request->shipped,
            'error' => $error
        ]);

        //Insert order product table 
        foreach(Cart::content() as $item){
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty
            ]);
        }
    }

    private function getAmounts()
    {
        $tax = config('cart.tax') / 100;
        $discount = session()->get('cupon')['discount'] ?? 0;
        $newSubtotal = (Cart::subtotal() - $discount);
        $newTax = $newSubtotal * $tax;
        $newTotal = $newSubtotal * (1 + $tax); 

        return collect([
            'tax' => $tax,
            'discount' => $discount,
            'newSubtotal' => $newSubtotal,
            'newTax' => $newTax,
            'newTotal' => $newTotal, 
        ]);
    }
}
