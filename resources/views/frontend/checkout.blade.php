@extends('frontend.layouts.app')

@section('extra-css')
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
@endsection

@section('content')
    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url({{ asset('frontend/images/bg/2.jpg') }}) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">Checkout</h2>
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="{{ route('landingPage') }}">Home</a>
                                <span class="brd-separetor">/</span>
                                <span class="breadcrumb-item active">Checkout</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- Start Checkout Area -->
    <section class="our-checkout-area ptb--120 bg__white">
        <div class="container">
            @if (session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}    
                </div>    
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-md-5 col-lg-5">
                    <form action="{{ route('checkout.store') }}" method="POST" id="payment-form">
                        @csrf
                        <div class="form-group">
                            <input class="form-control" type="text" id="name" name="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" id="email" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" id="phone" name="phone" placeholder="Phone">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="state" id="city" name="city" placeholder="City">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" id="address" name="address" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" id="province" name="province" placeholder="Province">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="text" id="postalcode" name="postalcode" placeholder="Postalcode">
                        </div>
                        <div class="form-group">
                            <div class="payment-form">
                                <h2 class="section-title-3">payment details</h2>
                            </div>
                            <label for="name_on_card">Name on Card</label>
                            <input type="text" class="form-control" id="name_on_card" name="name_on_card" value="">
                        </div>
                        <div class="form-group">
                            <label for="card-element">
                                Credit or debit card
                              </label>
                              <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                              </div>
                              <!-- Used to display Element errors. -->
                              <div id="card-errors" role="alert"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-success">Proceed</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-7 col-lg-7">
                    <div class="checkout-right-sidebar">
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
                                            <td class="product-quantity"><input type="number" value="1" /></td>
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
                        <div class="puick-contact-area mt--60">
                            <h2 class="section-title-3">Quick Contract</h2>
                            <a href="phone:+8801722889963">+012 345 678 102 </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Checkout Area -->    
@endsection

@section('extra-js')
    <script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>

    <script>
    (function() {
        // Create a Stripe client
        var stripe = Stripe('pk_test_51IG1XaLOQKQFJA7ZTUILvcwA7g4zxu2XsXKAvdCRDfyxJUzST0EWOlmTvxvR7NuzLYGYKLXDoZL19BfDeGTbUjLy00HQbUyur9');
        // Create an instance of Elements
        var elements = stripe.elements();
        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
            color: '#32325d',
            lineHeight: '18px',
            fontFamily: '"Roboto", Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
            },
            invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
            }
        };
        // Create an instance of the card Element
        var card = elements.create('card', {
            style: style,
            hidePostalCode: true
        });
        // Add an instance of the card Element into the `card-element` <div>
        card.mount('#card-element');
        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
            displayError.textContent = event.error.message;
            } else {
            displayError.textContent = '';
            }
        });

        // Create a token or display an error when the form is submitted.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
        event.preventDefault();
            var options = {
                name: document.getElementById('name_on_card').value,
                address_line1: document.getElementById('address').value,
                address_city: document.getElementById('city').value,
                address_state: document.getElementById('province').value,
                address_zip: document.getElementById('postalcode').value
              }
            stripe.createToken(card,options).then(function(result) {
                if (result.error) {
                // Inform the customer that there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
                }
            });
        });

        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            // Submit the form
            form.submit();
        }
    })();
    </script>
@endsection