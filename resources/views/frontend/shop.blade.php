@extends('frontend.layouts.app')

@section('content')
     <!-- Start Bradcaump area -->
     <div class="ht__bradcaump__area"
     style="background: rgba(0, 0, 0, 0) url({{ asset('frontend/images/bg/2.jpg') }}) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">Shop Page</h2>
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="index.html">Home</a>
                                <span class="brd-separetor">/</span>
                                <span class="breadcrumb-item active">Shop Page</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
     <!-- End Bradcaump area -->
      <!-- Start Our Product Area -->
      <section class="htc__product__area shop__page ptb--130 bg__white">
        <div class="container">
            <div class="htc__product__container">
                <!-- End Product MEnu -->
                <div class="row">
                    <div class="col-md-3">
                        <div class="product-categories-all shop-page-cat">
                            <div class="product-categories-title">
                                <h3>Categories</h3>
                            </div>
                            <div class="product-categories-menu">
                                <ul>
                                    @foreach ($categories as $cat)
                                       <li class="{{ activeCategory($cat->slug) }}"><a href="{{ route('shop.index',['category' => $cat->slug]) }}">{{ $cat->name }}</a></li>
                                    @endforeach
                                    <li><a href="{{ route('shop.index',['category' => request()->category, 'sort' => 'high_low' ]) }}">High To Low</a></li>
                                    <li><a href="{{ route('shop.index',['category' => request()->category, 'sort' => 'low_high' ]) }}">Low To High</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h2>{{ $catgoryName }}</h2>
                        <div class="product__list another-product-style">
                            <!-- Start Single Product -->
                            @foreach ($products as $product)
                                <div class="col-md-4 single__pro col-lg-4 col-sm-4 col-xs-12 cat--2">
                                    <div class="product foo">
                                        <div class="product__inner">
                                            <div class="pro__thumb">
                                                <a href="#">
                                                    <img src="{{ asset('storage/'.$product->image) }}" alt="product images">
                                                </a>
                                            </div>
                                            <div class="product__hover__info">
                                                <ul class="product__action">
                                                    <li>
                                                        <a data-toggle="modal" data-target="#productModal"
                                                            title="Quick View" class="quick-view modal-view detail-link"
                                                            href="#"><span class="ti-plus"></span>
                                                        </a>
                                                    </li>
                                                    @if ($product->quantity > 0)
                                                        <form action="{{ route('cart.store', $product) }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" id="id" value="{{ $product->id }}">
                                                            <input type="hidden" id="title" value="{{ $product->title }}">
                                                            <input type="hidden" id="price" value="{{ $product->price }}">
                                                            <button type="submit"><span class="ti-shopping-cart"></span></button>
                                                        </form>
                                                    @endif
                                                    <li>
                                                        <a title="Wishlist" href="wishlist.html"><span class="ti-heart"></span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="product__details">
                                            <h2><a href="{{ route('shop.show',$product->slug) }}">{{ $product->title }}</a></h2>
                                            <ul class="product__price">
                                                <li class="new__price">TK-{{ $product->price }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- End Single Product -->
                        </div>
                    </div>
                </div>
                <!-- Start Load More BTn -->
                <div class="row mt--60">
                    <div class="col-md-12">
                        <div class="htc__loadmore__btn">
                            {{ $products->appends(request()->input())->links() }}
                        </div>
                    </div>
                </div>
                <!-- End Load More BTn -->
            </div>
        </div>
    </section>
    <!-- End Our Product Area -->
@endsection