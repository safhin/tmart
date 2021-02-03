@extends('frontend.layouts.app')

@section('content')
    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url({{ asset('frontend/images/bg/2.jpg') }}) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">Cart</h2>
                            <nav class="bradcaump-inner">
                              <a class="breadcrumb-item" href="index.html">Home</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb-item active">Cart</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- cart-main-area start -->
    <div class="cart-main-area ptb--120 bg__white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    @if (session()->has('success_message'))
                        <div class="alert alert-success">
                            <h2>{{ session()->get('success_message') }}</h2>
                        </div>
                    @endif

                    @if(count($errors) > 0)
                        <div class="danger alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{-- <form action="#"> --}}
                        @if (count(Cart::content()) > 0)
                        <h2>{{ count(Cart::content()) }}Item(s) in cart)</h2>     
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Image</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                        <th class="product-remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (Cart::content() as $item)
                                        <tr>
                                            <td class="product-thumbnail"><a href="#"><img src="{{ asset('frontend/images/products/shop/'.$item->model->slug.'.jpg') }}" alt="product img" /></a></td>
                                            <td class="product-name"><a href="#">{{ $item->model->title }}</a></td>
                                            <td class="product-price"><span class="amount">TK-{{ $item->model->price }}</span></td>
                                            <td class="product-quantity">
                                                <div class="input group">
                                                     <select class="quantity" data-id="{{ $item->rowId }}">
                                                        @for($i = 1; $i <= 5;$i++)
                                                            <option {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="product-subtotal">{{ Cart::subtotal() }}</td>
                                            <td class="product-remove">
                                                <form action="{{ route('cart.destroy',$item->rowId ) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn" type="submit"><i class="fa fa-times">X</i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <h4>No item in cart</h4>
                        @endif
                        <div class="row">
                            <div class="col-md-8 col-sm-7 col-xs-12">
                                <div class="buttons-cart">
                                    <input type="submit" value="Update Cart" />
                                    <a href="#">Continue Shopping</a>
                                </div>
                                <div class="coupon">
                                    <h3>Coupon</h3>
                                    <p>Enter your coupon code if you have one.</p>
                                    <input type="text" placeholder="Coupon code" />
                                    <input type="submit" value="Apply Coupon" />
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <div class="cart_totals">
                                    <h2>Cart Totals</h2>
                                    <table>
                                        <tbody>
                                            <tr class="cart-subtotal">
                                                <th>Subtotal</th>
                                                <td><span class="amount">TK-{{ perentMoney(Cart::subtotal()) }}</span></td>
                                            </tr>
                                            <tr class="shipping">
                                                <th>Tax</th>
                                                <td>
                                                    <ul id="shipping_method">
                                                        <li>
                                                            <input type="radio" /> 
                                                            <label>
                                                                10% Tax: <span class="amount">TK-{{ Cart::tax() }}</span>
                                                            </label>
                                                        </li>
                                                        <li>
                                                            <input type="radio" /> 
                                                            <label>
                                                                Tax Free
                                                            </label>
                                                        </li>
                                                        <li></li>
                                                    </ul>
                                                    <p><a class="shipping-calculator-button" href="#">Calculate Shipping</a></p>
                                                </td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Total</th>
                                                <td>
                                                    <strong><span class="amount">TK-{{ $item->subtotal() }}</span></strong>
                                                </td>
                                            </tr>                                           
                                        </tbody>
                                    </table>
                                    <div class="wc-proceed-to-checkout">
                                        <a href="{{ route('checkout.index') }}">Proceed to Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{-- </form>  --}}
                </div>
            </div>
        </div>
    </div>
    <!-- cart-main-area end -->
@endsection

@section('extra-js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        (function(){
            const classname = document.querySelectorAll('.quantity')
            Array.from(classname).forEach(function(element){
                element.addEventListener('change',function(){
                    const id = element.getAttribute('data-id')
                    axios.patch(`/cart/${id}`, {
                        'quantity': this.value
                    })
                    .then(function (response) {
                        window.location.href = '{{ route('cart.index') }}'
                    })
                    .catch(function (error) {
                        window.location.href = '{{ route('cart.index') }}'
                    });
                })
            });
        })();
    </script>
@endsection