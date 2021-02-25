@extends('frontend.layouts.app')

@section('content')
    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url({{ asset('frontend/images/bg/2.jpg') }}) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">Product Details</h2>
                            <nav class="bradcaump-inner">
                              <a class="breadcrumb-item" href="index.html">Home</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb-item active">Product Details</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- Start Product Details -->
    <section class="htc__product__details pt--120 pb--100 bg__white">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <div class="product__details__container">
                        <!-- Start Small images -->
                        <ul class="product__small__images">
                            <li class="pot-small-img selected">
                                <img src="{{ productImage($product->image) }}" alt="small-image">
                            </li>
                            @if ($product->images)
                                @foreach (json_decode($product->images, true) as $image)
                                    <li class="pot-small-img selected">
                                        <img src="{{ asset('storage/'.$image) }}" alt="small-image">
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        <!-- End Small images -->
                        <div class="product__big__images">
                            <div class="portfolio-full-image">
                                <div class="product-section-image">
                                    <img id="currentImage" class="active" src="{{ productImage($product->image) }}" alt="full-image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 smt-30 xmt-30">
                    <div class="htc__product__details__inner">
                        <div class="pro__detl__title">
                            <h2>{{ $product->title }}</h2>
                        </div>
                        <div class="pro__dtl__rating">
                            <ul class="pro__rating">
                                <li><span class="ti-star"></span></li>
                                <li><span class="ti-star"></span></li>
                                <li><span class="ti-star"></span></li>
                                <li><span class="ti-star"></span></li>
                                <li><span class="ti-star"></span></li>
                            </ul>
                            <span class="rat__qun">(Based on 0 Ratings)</span>
                        </div>
                        <div class="pro__details">
                            <p>{!! $product->details !!}</p>
                        </div>
                        <ul class="pro__dtl__prize">
                            <li class="old__prize">$10.00</li>
                            <li>TK-{{ $product->price }}</li>
                        </ul>
                        <div class="pro__dtl__color">
                            <h2 class="title__5">Choose Colour</h2>
                            <ul class="pro__choose__color">
                                <li class="red"><a href="#"><i class="zmdi zmdi-circle"></i></a></li>
                                <li class="blue"><a href="#"><i class="zmdi zmdi-circle"></i></a></li>
                                <li class="perpal"><a href="#"><i class="zmdi zmdi-circle"></i></a></li>
                                <li class="yellow"><a href="#"><i class="zmdi zmdi-circle"></i></a></li>
                            </ul>
                        </div>
                        <div class="pro__dtl__size">
                            <h2 class="title__5">Size</h2>
                            <ul class="pro__choose__size">
                                <li><a href="#">xl</a></li>
                                <li><a href="#">m</a></li>
                                <li><a href="#">ml</a></li>
                                <li><a href="#">lm</a></li>
                                <li><a href="#">xxl</a></li>
                            </ul>
                        </div>
                        <div class="product-action-wrap">
                            <div class="prodict-statas"><span>Quantity :</span></div>
                            <div class="product-quantity">
                                <div class="product-quantity">
                                    <span>{!! $stockLevel !!}</span>
                                </div>
                            </div>
                        </div>
                        <ul class="pro__dtl__btn">
                            @if ($product->quantity > 0)
                                <form action="{{ route('cart.store',$product) }}" method="POST">
                                    @csrf
                                    <input type="hidden" id="id" value="{{ $product->id }}">
                                    <input type="hidden" id="title" value="{{ $product->title }}">
                                    <input type="hidden" id="price" value="{{ $product->price }}">
                                    <button class="btn buy__now__btn btn-lg" type="submit">buy now</button>
                                </form>
                            @endif
                            {{-- <li class="buy__now__btn"><a href="#">buy now</a></li> --}}
                            <li><a href="#"><span class="ti-heart"></span></a></li>
                            <li><a href="#"><span class="ti-email"></span></a></li>
                        </ul>
                        <div class="pro__social__share">
                            <h2>Share :</h2>
                            <ul class="pro__soaial__link">
                                <li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-instagram"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Product Details -->
    <!-- Start Product tab -->
    <section class="htc__product__details__tab bg__white pb--120">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <ul class="product__deatils__tab mb--60" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#description" role="tab" data-toggle="tab">Description</a>
                        </li>
                        <li role="presentation">
                            <a href="#sheet" role="tab" data-toggle="tab">Data sheet</a>
                        </li>
                        <li role="presentation">
                            <a href="#reviews" role="tab" data-toggle="tab">Reviews</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="product__details__tab__content">
                        <!-- Start Single Content -->
                        <div role="tabpanel" id="description" class="product__tab__content fade in active">
                            <div class="product__description__wrap">
                                <div class="product__desc">
                                    <h2 class="title__6">Details</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis noexercit ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id.</p>
                                </div>
                                <div class="pro__feature">
                                    <h2 class="title__6">Features</h2>
                                    <ul class="feature__list">
                                        <li><a href="#"><i class="zmdi zmdi-play-circle"></i>Duis aute irure dolor in reprehenderit in voluptate velit esse</a></li>
                                        <li><a href="#"><i class="zmdi zmdi-play-circle"></i>Irure dolor in reprehenderit in voluptate velit esse</a></li>
                                        <li><a href="#"><i class="zmdi zmdi-play-circle"></i>Sed do eiusmod tempor incididunt ut labore et </a></li>
                                        <li><a href="#"><i class="zmdi zmdi-play-circle"></i>Nisi ut aliquip ex ea commodo consequat.</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End Single Content -->
                        <!-- Start Single Content -->
                        <div role="tabpanel" id="sheet" class="product__tab__content fade">
                            <div class="pro__feature">
                                    <h2 class="title__6">Data sheet</h2>
                                    <ul class="feature__list">
                                        <li><a href="#"><i class="zmdi zmdi-play-circle"></i>Duis aute irure dolor in reprehenderit in voluptate velit esse</a></li>
                                        <li><a href="#"><i class="zmdi zmdi-play-circle"></i>Irure dolor in reprehenderit in voluptate velit esse</a></li>
                                        <li><a href="#"><i class="zmdi zmdi-play-circle"></i>Irure dolor in reprehenderit in voluptate velit esse</a></li>
                                        <li><a href="#"><i class="zmdi zmdi-play-circle"></i>Sed do eiusmod tempor incididunt ut labore et </a></li>
                                        <li><a href="#"><i class="zmdi zmdi-play-circle"></i>Sed do eiusmod tempor incididunt ut labore et </a></li>
                                        <li><a href="#"><i class="zmdi zmdi-play-circle"></i>Nisi ut aliquip ex ea commodo consequat.</a></li>
                                        <li><a href="#"><i class="zmdi zmdi-play-circle"></i>Nisi ut aliquip ex ea commodo consequat.</a></li>
                                    </ul>
                                </div>
                        </div>
                        <!-- End Single Content -->
                        <!-- Start Single Content -->
                        <div role="tabpanel" id="reviews" class="product__tab__content fade">
                            <div class="review__address__inner">
                                <!-- Start Single Review -->
                                <div class="pro__review">
                                    <div class="review__thumb">
                                        <img src="{{ asset('frontend/images/review/1.jpg') }}" alt="review images">
                                    </div>
                                    <div class="review__details">
                                        <div class="review__info">
                                            <h4><a href="#">Gerald Barnes</a></h4>
                                            <ul class="rating">
                                                <li><i class="zmdi zmdi-star"></i></li>
                                                <li><i class="zmdi zmdi-star"></i></li>
                                                <li><i class="zmdi zmdi-star"></i></li>
                                                <li><i class="zmdi zmdi-star-half"></i></li>
                                                <li><i class="zmdi zmdi-star-half"></i></li>
                                            </ul>
                                            <div class="rating__send">
                                                <a href="#"><i class="zmdi zmdi-mail-reply"></i></a>
                                                <a href="#"><i class="zmdi zmdi-close"></i></a>
                                            </div>
                                        </div>
                                        <div class="review__date">
                                            <span>27 Jun, 2016 at 2:30pm</span>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at estei to bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>
                                    </div>
                                </div>
                                <!-- End Single Review -->
                                <!-- Start Single Review -->
                                <div class="pro__review ans">
                                    <div class="review__thumb">
                                        <img src="{{ asset('frontend/images/review/2.jpg') }}" alt="review images">
                                    </div>
                                    <div class="review__details">
                                        <div class="review__info">
                                            <h4><a href="#">Gerald Barnes</a></h4>
                                            <ul class="rating">
                                                <li><i class="zmdi zmdi-star"></i></li>
                                                <li><i class="zmdi zmdi-star"></i></li>
                                                <li><i class="zmdi zmdi-star"></i></li>
                                                <li><i class="zmdi zmdi-star-half"></i></li>
                                                <li><i class="zmdi zmdi-star-half"></i></li>
                                            </ul>
                                            <div class="rating__send">
                                                <a href="#"><i class="zmdi zmdi-mail-reply"></i></a>
                                                <a href="#"><i class="zmdi zmdi-close"></i></a>
                                            </div>
                                        </div>
                                        <div class="review__date">
                                            <span>27 Jun, 2016 at 2:30pm</span>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at estei to bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>
                                    </div>
                                </div>
                                <!-- End Single Review -->
                            </div>
                            <!-- Start RAting Area -->
                            <div class="rating__wrap">
                                <h2 class="rating-title">Write  A review</h2>
                                <h4 class="rating-title-2">Your Rating</h4>
                                <div class="rating__list">
                                    <!-- Start Single List -->
                                    <ul class="rating">
                                        <li><i class="zmdi zmdi-star-half"></i></li>
                                    </ul>
                                    <!-- End Single List -->
                                    <!-- Start Single List -->
                                    <ul class="rating">
                                        <li><i class="zmdi zmdi-star-half"></i></li>
                                        <li><i class="zmdi zmdi-star-half"></i></li>
                                    </ul>
                                    <!-- End Single List -->
                                    <!-- Start Single List -->
                                    <ul class="rating">
                                        <li><i class="zmdi zmdi-star-half"></i></li>
                                        <li><i class="zmdi zmdi-star-half"></i></li>
                                        <li><i class="zmdi zmdi-star-half"></i></li>
                                    </ul>
                                    <!-- End Single List -->
                                    <!-- Start Single List -->
                                    <ul class="rating">
                                        <li><i class="zmdi zmdi-star-half"></i></li>
                                        <li><i class="zmdi zmdi-star-half"></i></li>
                                        <li><i class="zmdi zmdi-star-half"></i></li>
                                        <li><i class="zmdi zmdi-star-half"></i></li>
                                    </ul>
                                    <!-- End Single List -->
                                    <!-- Start Single List -->
                                    <ul class="rating">
                                        <li><i class="zmdi zmdi-star-half"></i></li>
                                        <li><i class="zmdi zmdi-star-half"></i></li>
                                        <li><i class="zmdi zmdi-star-half"></i></li>
                                        <li><i class="zmdi zmdi-star-half"></i></li>
                                        <li><i class="zmdi zmdi-star-half"></i></li>
                                    </ul>
                                    <!-- End Single List -->
                                </div>
                            </div>
                            <!-- End RAting Area -->
                            <div class="review__box">
                                <form id="review-form">
                                    <div class="single-review-form">
                                        <div class="review-box name">
                                            <input type="text" placeholder="Type your name">
                                            <input type="email" placeholder="Type your email">
                                        </div>
                                    </div>
                                    <div class="single-review-form">
                                        <div class="review-box message">
                                            <textarea placeholder="Write your review"></textarea>
                                        </div>
                                    </div>
                                    <div class="review-btn">
                                        <a class="fv-btn" href="#">submit review</a>
                                    </div>
                                </form>                                
                            </div>
                        </div>
                        <!-- End Single Content -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Product tab -->
@endsection


@section('extra-js')
    <script>
        (function(){
            const currentImage = document.querySelector('#currentImage');
            const images = document.querySelectorAll('.pot-small-img');

            images.forEach((element) => element.addEventListener('click', thumbnailClick));

            function thumbnailClick(e){
                // currentImage.src = this.querySelector('img').src;

                currentImage.classList.remove('active');

                currentImage.addEventListener('transitionend', () => {
                    currentImage.src = this.querySelector('img').src;
                    currentImage.classList.add('active');
                });
            }
        })();
    </script>
@endsection