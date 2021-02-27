@extends('frontend.layouts.app')

@section('content')
    <!-- Start Feature Product -->
    <section class="categories-slider-area bg__white">
        <div class="container">
            <div class="row">
                <!-- Start Left Feature -->
                <x-frontend.featured-slider :featuredSlider="$featuredSlider"/>
                <!-- End Left Feature -->
            </div>
        </div>
    </section>
    <!-- Start Our Product Area -->
    <section class="htc__product__area bg__white">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <h2 class="featured_title">Featured Product</h2>
                    </div>
                    @foreach ($productRow1 as $product)
                        <div class="col-md-4 single__pro col-lg-4 cat--1 col-sm-4 col-xs-12">
                            <div class="product">
                                <div class="product__inner">
                                    <div class="pro__thumb">
                                        <a href="#">
                                            <img src="{{ productImage($product->image) }}" alt="product images">
                                        </a>
                                    </div>
                                    <div class="product__hover__info">
                                        <ul class="product__action">
                                            <li><a data-toggle="modal" data-target="#productModal" title="Quick View" class="quick-view modal-view detail-link" href="#"><span class="ti-plus"></span></a></li>
                                            @if ($product->quantity > 0)
                                                <li>
                                                    <form action="{{ route('cart.store',$product) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" id="id" value="{{ $product->id }}">
                                                        <input type="hidden" id="title" value="{{ $product->title }}">
                                                        <input type="hidden" id="price" value="{{ $product->price }}">
                                                        <button class="add_to_cart" type="submit"><span class="ti-shopping-cart"></span></button>
                                                    </form>
                                                </li>
                                            @endif
                                            <li><a title="Wishlist" href="wishlist.html"><span class="ti-heart"></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product__details">
                                    <h2><a href="{{ route('shop.show',$product->slug) }}">{{ $product->title }}</a></h2>
                                    <ul class="product__price">
                                        <li class="old__price">TK-{{ $product->price }}</li>
                                        <li class="new__price">TK-{{ $product->price }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End Our Product Area -->
    <div class="only-banner ptb--100 bg__white">
        <div class="container">
            <div class="only-banner-img">
                <a href="shop-sidebar.html"><img src="{{ asset('frontend/images/new-product/6.jpg') }}" alt="new product"></a>
            </div>
        </div>
    </div>
    <!-- Start Blog Area -->
    <blog-posts></blog-posts>
    <!-- End Blog Area -->
@endsection