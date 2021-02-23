<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Tmart-Minimalist eCommerce HTML5 Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/images/favicon.ico') }}">
    <link rel="apple-touch-icon" href="apple-touch-icon.png') }}') }}">
    

    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <!-- Owl Carousel main css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="{{ asset('frontend/css/core.css') }}">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="{{ asset('frontend/css/shortcode/shortcodes.css') }}">
    <!-- Theme main style -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">

    <!-- Modernizr JS -->
    <script src="{{ asset('frontend/js/vendor/modernizr-2.8.3.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/algoliasearch@4/dist/algoliasearch.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    
    @yield('extra-css')
</head>

<body>
    <div id="app">
        <!-- Body main wrapper start -->
        <div class="wrapper fixed__footer">
            <!-- Start Header Style -->
            <header id="header" class="htc-header header--3 bg__white">
                <!-- Start Mainmenu Area -->
                <div id="sticky-header-with-topbar" class="mainmenu__area sticky__header">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="logo">
                                    <a href="{{ route('landingPage') }}">
                                        <img src="{{ asset('frontend/images/logo/logo.png') }}" alt="logo">
                                    </a>
                                    {{ menu('main','frontend.partials.menus.main') }}
                                    <div class="aa-input-container" id="aa-input-container">
                                        <input type="search" id="search-input" class="aa-input-search aa-input" placeholder="Search with alogila..." name="search" autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                            <!-- End MAinmenu Ares -->
                            <div class="col-md-2">  
                                <ul class="menu-extra">
                                    <li class="search search__open hidden-xs"><span class="ti-search"></span></li>
                                    @guest
                                        
                                        <li><a href="{{ route('register') }}">Register</a></li>
                                        <li><a href="{{ route('login') }}">Login</a></li>
                                    @else
                                        <li>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                        <li class="cart__menu"><span class="ti-shopping-cart"></span></li>
                                    @endguest
                                </ul>
                            </div>
                        </div>
                        <div class="mobile-menu-area"></div>
                    </div>
                </div>
                <!-- End Mainmenu Area -->
            </header>
            <!-- End Header Style -->
            <div class="body__overlay"></div>
            <!-- Start Offset Wrapper -->
            <div class="offset__wrapper">
                <!-- Start Search Popap -->
                <div class="search__area">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="search__inner">
                                    <form action="{{ route('search') }}" method="get">
                                        <input placeholder="Search here... " type="text" name="query" id="query">
                                        <button type="submit"></button>
                                    </form>
                                    <div class="search__close__btn">
                                        <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Search Popap -->
                @yield('content')
            </div>
            <!-- End Offset Wrapper -->
            <!-- Start Footer Area -->
            @include('frontend.partials.footer')
            <!-- End Footer Area -->
        </div>
        <!-- Body main wrapper end -->
    </div>





    <!-- Placed js at the end of the document so the pages load faster -->

    @yield('extra-js')
    <script src="./js/app.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>
    <!-- jquery latest version -->
    <script src="{{ asset('frontend/js/vendor/jquery-1.12.0.min.js') }}"></script>
    <!-- Bootstrap framework js -->
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <!-- All js plugins included in this file. -->
    <script src="{{ asset('frontend/js/plugins.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <!-- Waypoints.min.js. -->
    <script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>
</body>

</html>