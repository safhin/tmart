<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 float-left-style">
    <!-- Start Slider Area -->
        <div class="slider__container">
            <div class="slider__activation__wrap owl-carousel owl-theme">
                <!-- Start Single Slide -->
                @foreach ($featuredSlider as $product)
                <div class="slide slider__full--screen slider-height-inherit slider-text-right">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-7 col-lg-7 col-sm-7 col-xs-7">
                                <div class="slider_thumb">
                                    <img src="{{ asset('storage/'.$product->image) }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-5 col-lg-5 col-sm-5 col-xs-5 text-left">
                                <div class="slider__inner">
                                    <h1>{{ $product->title }}</h1>
                                    <div class="slider__btn">
                                        @if ($product->quantity > 0)
                                            <form action="{{ route('cart.store', $product) }}" method="POST">
                                                @csrf
                                                <input type="hidden" id="id" value="{{ $product->id }}">
                                                <input type="hidden" id="title" value="{{ $product->title }}">
                                                <input type="hidden" id="price" value="{{ $product->price }}">
                                                <button class="htc__btn" type="submit">shop now</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- End Single Slide -->
            </div>
        </div>
    <!-- Start Slider Area -->
</div>