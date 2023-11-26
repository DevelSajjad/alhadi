<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="facebook-domain-verification" content="ug3pzda6xnsvy6ea69zzhrde2m6vri" />    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon-32-x32.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon-32-x32.png') }}" type="image/x-icon">
    <link rel="canonical" href="{{ url()->current() }}"/>
    <meta name="author" content="AL Hadi Enterprise">
    {{-- <meta name="robots" content="AL Hadi Enterprise" /> --}}
    <meta name="robots" content="index, follow"/>
    @yield('meta')
    {{-- <meta name="keywords" content="AL Hadi Enterprise"> --}}
    <meta name="description" content="AL Hadi Enterprise">
    <title>AL Hadi Enterprise | @yield('page_title')</title>
    {{-- <title> @yield('title')</title> --}}

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts-->
    <link
        href="https://fonts.googleapis.com/css?family=Archivo+Narrow:300,400,700%7CMontserrat:300,400,500,600,700,800,900"
        rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/ps-icon/style.css') }}">

    <!-- CSS Library-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
          href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css') }}"/>
    {{-- <link rel="stylesheet" href="{{ asset("assets/frontend/plugins/owl-carousel/assets/owl.carousel.css") }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset("assets/frontend/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css") }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset("assets/frontend/plugins/slick/slick/slick.css") }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset("assets/frontend/plugins/bootstrap-select/dist/css/bootstrap-select.min.css") }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset("assets/frontend/plugins/Magnific-Popup/dist/magnific-popup.css") }}"> --}}
    {{-- <link rel="stylesheet" href="{{ asset("assets/frontend/plugins/jquery-ui/jquery-ui.min.css") }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/revolution/css/settings.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/revolution/css/layers.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/revolution/css/navigation.css') }}">
    {{-- <!-- Custom--> --}}
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/nfs.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/w3.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/MultilevelNFS/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/MultilevelNFS/css/component.css') }}">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.2/assets/owl.carousel.min.css"/>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.2/assets/owl.theme.default.min.css" /> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.2/assets/owl.theme.green.min.css" /> --}}
<!--HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--WARNING: Respond.js doesn't work if you view the page via file://-->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->

    {{-- <script type="text/javascript" src="{{ asset('plugins/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script> --}}
    {{-- <script type="text/javascript" src="{{ asset('plugins/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script> --}}
    @yield('stylesheet')


    <style type="text/css">
        .sticky {
            background-color: white;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 999999;
        }

        .sticky + .ps-main {
            padding-top: 200px;
        }

        .hot-number {
            color: blue !important;
        }

        .hot-number a {
            color: blue;
            font-weight: 600;
        }

        .scrollable {
            max-height: 350px;
            overflow-y: scroll;
        }

        @media (min-width: 768px) {
            .navbar-nav > li > a {
                padding-top: 8px;
                font-size: 12px;
                padding-bottom: 5px;
            }
        }

        @media screen and (min-width: 405px) {

            .w3-btn,
            .w3-button {
                padding: 5px 16px;
            }
        }
    </style>

    <!-- Facebook Pixel Code -->
{{--    <script>--}}
{{--        ! function(f, b, e, v, n, t, s) {--}}
{{--            if (f.fbq) return;--}}
{{--            n = f.fbq = function() {--}}
{{--                n.callMethod ?--}}
{{--                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)--}}
{{--            };--}}
{{--            if (!f._fbq) f._fbq = n;--}}
{{--            n.push = n;--}}
{{--            n.loaded = !0;--}}
{{--            n.version = '2.0';--}}
{{--            n.queue = [];--}}
{{--            t = b.createElement(e);--}}
{{--            t.async = !0;--}}
{{--            t.src = v;--}}
{{--            s = b.getElementsByTagName(e)[0];--}}
{{--            s.parentNode.insertBefore(t, s)--}}
{{--        }(window, document, 'script',--}}
{{--            'https://connect.facebook.net/en_US/fbevents.js');--}}
{{--        fbq('init', '822569511773801');--}}
{{--        fbq('track', 'PageView');--}}
{{--    </script>--}}
{{--    <noscript><img height="1" width="1" style="display:none"--}}
{{--            src="https://www.facebook.com/tr?id=822569511773801&ev=PageView&noscript=1" /></noscript>--}}
<!-- End Facebook Pixel Code -->


</head>

<!--[if IE 7]>
<body class="ie7 lt-ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 8]>
<body class="ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 9]>
<body class="ie9 lt-ie10"><![endif]-->

<body class="product-product-21215">
<!--class="ps-loading"-->

<style>
    @media (min-width: 966px) {
        .top > .container {
            padding: 15px;
        }
    }
</style>


<header id="head">
    <div class="top" style="background: #8b75b3;">
        <div class="container">
            <div class="ht-item logo" style="background: #8b75b3;">
                <div class="mbl-nav-top h-desk">
                    <div id="nav-toggler" class="">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                @php
                    $logo = $company_info->logo?? ''
                @endphp
                <a class="brand" href="{{ route('home') }}"><img src="{{ asset($logo)}}" style="border-radius: 4px"
                                                                 title="{{ $company_info->company_name?? ''}}" width="144"
                                                                 height="164"
                                                                 alt="{{ $company_info->company_name?? ''}}"></a>
                <div class="mbl-right h-desk">
                    <div class="ac search-toggler"><i class="fa fa-search"></i></div>
                    <div class="ac mc-toggler"><i class="fa fa-shopping-cart"></i><span class="counter"
                                                                                        data-count="0">0</span></div>
                </div>
            </div>
            <div class="ht-item search" id="search">
                <input type="text" id="home-search" name="search" placeholder="Search"
                       value="{{(isset($request->search) ? $request->search : "")}}">
                <div id="suggestion-box" class="dropdown-menu" style="display: none;">
                    <div class="search-details" style="margin: 0 auto;">


                        <!-- Nav tabs -->
                        <ul class="nav" role="tablist" style="margin: 0 auto;">
                            <li class="">
                                <a class=" active" data-toggle="tab" href="#SearchedProducts">Products</a>
                            </li>
                            <li class="">
                                <a class="" data-toggle="tab" href="#SearchedCategories">Sub Categories</a>
                            </li>
                            <li class="">
                                <a class="" data-toggle="tab" href="#SearchedBrands">Brands</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="SearchedProducts" class="tab-pane active search-item">
                                <h6>Products</h6>
                                <br>
                                <ul id="suggestion-product" class="scrollable">

                                </ul>
                            </div>
                            <div id="SearchedCategories" class="tab-pane fade search-item">
                                <h6>Categories</h6>
                                <br>
                                <ul id="suggestion-sub-category" class="scrollable">

                                </ul>
                            </div>
                            <div id="SearchedBrands" class="tab-pane fade search-item">
                                <h6>Brands</h6>
                                <br>
                                <ul id="suggestion-brand" class="scrollable">

                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                <button class="fa fa-search" style="margin: 4px;"></button>
            </div>
            <div class="ht-item q-actions">
                <a href="{{ route('product') }}" class="ac h-offer-icon">
                    <div class="ic"><i class="fa fa-cubes"></i></div>
                    <div class="ac-content">
                        <h5>Products</h5>
                    </div>
                </a>
                @if(auth()->user())
                    @if(auth()->user()->type == 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="ac h-offer-icon">
                        <div class="ic"><i class="fa fa-dashboard"></i></div>
                        <div class="ac-content">
                            <h5>Dashboard</h5>
                        </div>
                    </a>

                    <div class="ac">
                        <a class="ic" href="#"><i class="fa fa-external-link"></i></a>
                        <div class="ac-content">
                            <a href="{{ route('admin.logout') }}"><h5>Logout</h5></a>
                            <p></p>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('customer.dashboard') }}" class="ac h-offer-icon">
                        <div class="ic"><i class="fa fa-dashboard"></i></div>
                        <div class="ac-content">
                            <h5>Dashboard</h5>
                        </div>
                    </a>

                    <div class="ac">
                        <a class="ic" href="#"><i class="fa fa-external-link"></i></a>
                        <div class="ac-content">
                            <a href="{{ route('customer.logout') }}"><h5>Logout</h5></a>
                            <p></p>
                        </div>
                    </div>
                    @endif
                @else
                    <a href="{{ route('registration') }}" class="ac h-offer-icon">
                        <div class="ic"><i class="fa fa-user-plus blink"></i></div>
                        <div class="ac-content">
                            <h5>Registration</h5>
                        </div>
                    </a>

                    <div class="ac">
                        <a class="ic" href="#"><i class="fa fa-user"></i></a>
                        <div class="ac-content">
                            <a href="{{ route('login') }}"><h5>Login</h5></a>
                            <p></p>
                        </div>
                    </div>
                @endif
                                        <a href="{{ route('customer.orders') }}" class="ac h-desk build-pc">

                                            <div class="ic"><i class="fa fa-buysellads"></i></div>
                                            <div class="ac-content">
                                                <h5 class="text">Order</h5>
                                            </div>
                                        </a>
                                        <div class="ac cmpr-toggler h-desk">
                                            <a href="{{ route('compare') }}">
                                            <div class="ic"><i class="fa fa-handshake-o"></i></div>
                                            <div class="ac-content">
                                                <h5 class="text">Compare (0)</h5>
                                            </div>
                                            </a>
                                     </div>
{{--                                        <div class="ac build-pc m-hide">--}}
{{--                                            <a class="btn" href="{{ route('compare') }}">Compare</a>--}}
{{--                                        </div>--}}
            </div>
        </div>
    </div>
    <nav class="navbar" id="main-nav">
        <div class="container">
            <ul class="navbar-nav">
                @foreach($home_category as $h_category)
                    <li class="nav-item has-child c-1">
                        <a class="nav-link" href="">{{ $h_category->name }}</a>
                        <ul class="drop-down drop-menu-1">
                            @foreach($h_category->subcategories as $h_subCategory)
                                <li class="nav-item @if(($h_subCategory->brands->count())>0)has-child @endif">
                                    <a class="nav-link"
                                       href="{{ route('product') }}?search={{ $h_subCategory->slug }}&search_by=subcategory">{{ $h_subCategory->name }}</a>
                                    @if($h_subCategory->brands)
                                        <ul class="drop-down drop-menu-2">
                                            @foreach($h_subCategory->brands as $h_brand)
                                                <li class="nav-item"><a class="nav-link"
                                                                        href="{{ route('product') }}?search={{ $h_brand->slug }}&search_by=brand">{{ $h_brand->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>

                                {{--                                <li class="nav-item"><a class="nav-link" href="desktops/economy-pc">Budget PC</a>--}}
                                </li>
                            @endforeach

                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>
</header>

    <a href="{{ route('compare') }}">
<div class="f-btn cmpr-toggler" id="cmpr-btn">
        <i class="fa fa-handshake-o"></i>
        <div class="label">Compare</div>
        <span class="counter compare-count">{{ $compare_count }}</span>
</div>
    </a>

<div class="f-btn mc-toggler loaded" id="cart">
    <i class="fa fa-shopping-cart"></i>
    <div class="label">Cart</div>
    <span class="counter cart-count ">{{ \Cart::getTotalQuantity() }}</span>
</div>
<div class="drawer m-cart" id="m-cart">
    <div class="title">
        <p>YOUR CART</p>
        <span class="mc-toggler loaded"><i class="fa fa-close"></i></span>
    </div>
    <div class="content ps-cart__content">
        @forelse(\Cart::getContent() as $item)
            <div class="item">
                <div class="image"><img src="{{ asset($item->attributes->image) }}"
                                        alt="Xtrfy M42 RGB RETRO Ultra-Light Gaming Mouse" width="47" height="47">
                </div>
                <div class="info">
                    <div class="name">
                        {{ strlen($item->name) > 20 ? substr($item->name, 0, 25) . '...' : $item->name }}</div>
                    <span class="amount">{{ $item->price }}৳</span>
                    <i class="fa fa-times"></i>
                    <span>{{ $item->quantity }}</span>
                    <span class="eq">=</span>
                    <span class="total">{{ $item->quantity * $item->price }}৳</span>
                </div>
                <div class="remove" title="Remove"><a href="{{ route('cart.remove', $item->id) }}"><i
                            class="fa fa-trash"></i></a></div>
            </div>
        @empty
            <div class="empty-content">
                <p class="text-center">Your shopping cart is empty!</p>
            </div>
        @endforelse
    </div>

    <div class="card footer">
        <div class="total card-head">
            <div class="title">Sub-Total</div>
            <div class="amount ps-cart__total_amount">{{ \Cart::getTotal() }}৳</div>
        </div>
        {{-- <div class="total">
            <div class="title">Total</div>
            <div class="amount">0৳</div>
        </div> --}}
        <div class="checkout-btn card-body">
            <a href="{{ route('customer.checkout') }}" class="btn submit">Checkout</a>
        </div>
    </div>


</div>

{{--<div class="drawer cmpr-panel" id="cmpr-panel">--}}
{{--    <div class="title">--}}
{{--        <p>Compare Product</p>--}}
{{--        <span class="cmpr-toggler loaded"><i class="fa fa-close"></i></span>--}}
{{--    </div>--}}
{{--    <div class="content">--}}
{{--        <div class="empty-content">--}}
{{--            <p class="text-center">Your compare list is empty!</p>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="footer btn-wrap">--}}
{{--    </div>--}}
{{--</div>--}}

<main class="ps-main">
    @yield('content')

    <div class="ps-subscribe">
        <div class="ps-container">
            <div class="row">
                {{-- <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
<h3 style="margin-top: 10px"><i class="fa fa-envelope"></i>Subscribe to our Newsletter</h3>
</div> --}}
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <form class="ps-subscribe__form row">
                        <input type="hidden" name="sub_id"
                               value="{{ auth()->user() ? auth()->id() : '' }}">
                        <div class="form-group col-md-3">
                            <input class="form-control" name="sub_name" type="name" required
                                   placeholder="Enter Your Name">
                        </div>
                        <div class="form-group col-md-3">
                            <input class="form-control" name="sub_email" type="email" required
                                   placeholder="Enter a email">
                        </div>
                        <div class="form-group col-md-3">
                            <input class="form-control" name="sub_contact" type="email" required
                                   placeholder="Contact No">
                        </div>

                        <div class="form-group col-md-3">
                            <button type="button" class="subscribe">Subscribe</button>
                        </div>
                    </form>
                </div>
                {{-- <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 ">
<p>to get products notification first</p>
</div> --}}
            </div>
        </div>
    </div>
    <div class="ps-footer bg--cover"
         data-background="{{ asset('assets/frontend/images/background/parallax.jpg') }}">
        <div class="ps-footer__content" style="position: sticky">
{{--            <img src="{{ asset('assets/images/SSLCommerz2.png') }}">--}}
            <br>
            <br>
            <div class="ps-container">
{{--                <p style="text-align: center; margin-top: 40px; margin-bottom: 20px;">--}}
{{--                    <a href="{{ route('home') }}"><img style="width: 50%;"--}}
{{--                                                       src="{{ asset('assets/images/logo_long.png') }} " alt=""></a>--}}
{{--                </p>--}}
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                            <aside class="ps-widget--footer ps-widget--info">
                                <header>
                                    <h3 class="ps-widget__title">Registered Office</h3>
                                </header>
                                <footer>
                                    <p><strong><i class="fa fa-map-marker"></i>{{ $company_info->address_one?? ''}}</strong></p>
                                    <p><i class="fa fa-envelope"></i> <a
                                            href='mailto:{{ $company_info->email_one?? ''}}'>{{ $company_info->email_one?? ''}}</a>
                                    </p>
                                    <p><i class="fa fa-phone"></i> <a
                                            href="tel:{{ $company_info->phone_one?? ''}}">{{ $company_info->phone_one?? ''}}</a></p>
                                </footer>
                            </aside>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                        <aside class="ps-widget--footer ps-widget--info second">
                            <header>
                                <h3 class="ps-widget__title">CORPORATE OFFICE</h3>
                            </header>
                            <footer>
                                <p><strong> <i class="fa fa-map-marker"></i> {{ $company_info->address_two?? ''}}</strong></p>
                                <p><i class="fa fa-envelope"></i> <a
                                      href='mailto:{{ $company_info->email_two?? ''}}'>{{ $company_info->email_two?? ''}}</a>
                                </p>
                                <p><i class="fa fa-phone"></i> <a
                                      href="tel:{{ $company_info->phone_two?? ''}}">{{ $company_info->phone_two?? ''}}</a></p>
                            </footer>
                        </aside>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 ">
                        <aside class="ps-widget--footer ps-widget--link">
                            <header>
                                <h3 class="ps-widget__title">Find Our store</h3>
                            </header>
                            <footer>
                                <ul class="ps-list--link">
                                    <li><a href="#">Coupon Code</a></li>
                                    <li><a href="#">SignUp For Email</a></li>
                                    <li><a class="site_feedback" style="cursor: pointer">Site Feedback</a>
                                    </li>
                                </ul>
                            </footer>
                        </aside>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
                        <aside class="ps-widget--footer ps-widget--link">
                            <header>
                                <h3 class="ps-widget__title">Get Help</h3>
                            </header>
                            <footer>
                                <ul class="ps-list--line">
                                    <li><a href="{{ route('aboutus') }}"> {{ __('About Us') }} </a></li>
                                    <li><a href="{{ route('privacy.policy') }}"> {{ __('Privacy Policy') }} </a></li>
                                    <li><a href="{{ route('terms.and.conditions') }}"> {{ __('Terms & Condition') }} </a></li>
                                    <li><a href="{{ route('return.refund') }}"> {{ __('Return & Refund Policy') }} </a></li>
                                    <li><a href="{{ route('contactus') }}"> {{ __('Contact Us') }} </a></li>
                                </ul>
                            </footer>
                        </aside>
                    </div>
                    {{-- <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
  <aside class="ps-widget--footer ps-widget--link">
    <header>
      <h3 class="ps-widget__title">Products</h3>
    </header>
    <footer>
      <ul class="ps-list--line">
        <li><a href="{{ route('product') }}">Guitar</a></li>
        <li><a href="{{ route('product') }}">Keyboard</a></li>
        <li><a href="{{ route('product') }}">Speaker</a></li>
        <li><a href="{{ route('product') }}">Harmonium</a></li>
      </ul>
    </footer>
  </aside>
</div> --}}
                </div>
                {{-- <div class="row">
<div class="col-12 text-center" style="background: white">
  <img src="{{ asset('assets/images/payment.png') }}" alt="payment">
</div>
</div> --}}
            </div>
        </div>
        <div class="ps-footer__copyright">
            <div class="ps-container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                        <img width="1000px" src="{{asset('assets/frontend/ssl_banner.png')}}" alt="">
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                        <p>&copy; <a href="#">{{ $company_info->company_name?? ''}}</a>. All rights Reserved. Developed by <a
                                href="https://touchandsolve.com/"> Touch & Solve</a></p>
                    </div>

                    {{-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                        <ul class="ps-social">
                            @foreach(\App\Models\Socials::where('status', "active")->get() as $social)
                                <li><a href="{{$social->url}}" target="_blank"><i
                                        class="{{$social->icon_code}}"></i></a></li>
                            @endforeach
                        </ul>
                    </div> --}}
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                        <p>Trade License: {{$company_info->trade_license}} </p>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12 text-center">
            <img src="{{asset('assets/frontend/ssl_banner_1.png')}}" alt="">
        </div> --}}

        <div class="modal fade" id="feedback_modal" tabindex="-1" role="dialog"
             aria-labelledby="feedback_modal" style="z-index: 30000000">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" style="color: red;font-weight: bold;"
                                data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">x</span></button>
                        <h4 class="modal-title mr-20">New message</h4>
                    </div>
                    <form action="" id="feedback_form">
                        <div class="modal-body">
                            <style>
                                .input-size {
                                    height: 35px;
                                }

                                input::-webkit-outer-spin-button,
                                input::-webkit-inner-spin-button {
                                    /* display: none; <- Crashes Chrome on hover */
                                    -webkit-appearance: none;
                                    margin: 0;
                                    /* <-- Apparently some margin are still there even though it's hidden */
                                }

                                input[type=number] {
                                    -moz-appearance: textfield;
                                    /* Firefox */
                                }
                            </style>
                            <div class="form-group">
                                <label class="control-label">Name:</label>
                                <input type="text" id="feedback_send_name" name="name"
                                       value="{{ isset(auth()->user()->name) ? auth()->user()->name : null }}"
                                       required class="form-control input-size">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Email:</label>
                                <input type="email" id="feedback_send_email" name="email"
                                       value="{{ isset(auth()->user()->email) ? auth()->user()->email : null }}"
                                       required class="form-control input-size">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Mobile No:</label>
                                <input type="number" id="feedback_send_mobile_no" name="mobile_no"
                                       value="{{ isset(auth()->user()->mobile_no) ? auth()->user()->mobile_no : null }}"
                                       required class="form-control input-size">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Message:</label>
                                <textarea name="message" class="form-control" id="feedback_send_message"
                                          required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default"
                                    data-dismiss="modal">Close
                            </button>
                            <button type="submit" id="feedback_send_btn" class="btn btn-success">Send
                                message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </div>
</main>
<!-- JS Library-->
<script type="text/javascript" src="{{ asset('assets/frontend/plugins/jquery/dist/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/plugins/bootstrap/dist/js/bootstrap.min.js') }}">
</script>
<script type="text/javascript"
        src="{{ asset('assets/frontend/plugins/jquery-bar-rating/dist/jquery.barrating.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/plugins/gmap3.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/plugins/imagesloaded.pkgd.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/plugins/isotope.pkgd.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('assets/frontend/plugins/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/plugins/jquery.matchHeight-min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/plugins/slick/slick/slick.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/plugins/elevatezoom/jquery.elevatezoom.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('assets/frontend/plugins/Magnific-Popup/dist/jquery.magnific-popup.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAx39JFH5nhxze1ZydH-Kl8xXM3OK4fvcg&amp;region=GB"></script>
<script type="text/javascript"
        src="{{ asset('assets/frontend/plugins/revolution/js/jquery.themepunch.tools.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('assets/frontend/plugins/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('assets/frontend/plugins/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>
<script type="text/javascript"
        src="{{ asset('assets/frontend/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js') }}">
</script>
<script type="text/javascript"
        src="{{ asset('assets/frontend/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}">
</script>
<script type="text/javascript"
        src="{{ asset('assets/frontend/plugins/revolution/js/extensions/revolution.extension.navigation.min.js') }}">
</script>
<script type="text/javascript"
        src="{{ asset('assets/frontend/plugins/revolution/js/extensions/revolution.extension.parallax.min.js') }}">
</script>
<script type="text/javascript"
        src="{{ asset('assets/frontend/plugins/revolution/js/extensions/revolution.extension.actions.min.js') }}"></script>
<!-- Custom scripts-->
<script src="{{ asset('assets/frontend/js/sweetalert2.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/js/main.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/MultilevelNFS/js/modernizr.custom.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/MultilevelNFS/js/jquery.dlmenu.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/js/jquery.sticky.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.2/owl.carousel.min.js"></script> --}}

<style>
    .sweet-alert {
        z-index: 200000;
        font-size: 40px;
    }

    .search_image {
        width: 48px;
        float: left;
        margin-right: 12px;
    }

</style>
<script>
    $(document).ready(function () {


        $("#home-banner").owlCarousel({
            items: 1,
            loop: true,
            center: true,
            autoplay: true,
            autoplayTimeout: 6000,
            lazyLoad: true,
            lazyLoadEager: 1,
        });

        $(document).on('click', '.add-to-cart', function () {
            var pid = $(this).data('id');
            // console.log(pid)
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var photoPath = "{{ asset('') }}"

            $.ajax({
                url: "{{ route('cart.add') }}",
                method: "post",
                dataType: "html",
                data: {
                    product_id: pid,
                    quantity: 1
                },
                success: function (data) {
                    data = JSON.parse(data)
                    // console.log(data)
                    if (data.status === "success") {
                        let output = '';
                        $.each(data.content, function (i, e) {

                            output += '<div class="item ps-cart-item">'
                            output +=
                                '<div class="image ps-cart-item__thumbnail"><img src="' +
                                photoPath + e.attributes.image +
                                '"  width="47" height="47"></div>'
                            output += '<div class="info">'
                            output += '<div class="name">' + ((e.name.length > 20) ?
                                (e.name.substring(0, 20) + "...") : e.name) +
                                '</div>'
                            output += '<span class="amount">' + e.price + '৳</span>'
                            output += '<i class="fa fa-times"></i>'
                            output += '<span>' + e.quantity + '</span>'
                            output += '<span class="eq">=</span>'
                            output += '<span class="total">' + (e.quantity * e
                                .price) + ' ৳</span>'
                            output += '</div>'
                            output +=
                                '<div class="remove"><a href="{{ URL::to('cart/remove') }}/' +
                                e.id +
                                '"><i class="fa fa-trash" aria-hidden="true"></i></a></div>'
                            output += '</div>'
                        })

                        $('.cart-count').html(data.totalItem)
                        // $('.ps-cart__total_item').html(data.totalItem)
                        $('.ps-cart__total_amount').html("TK " + data.total)
                        $('.ps-cart__content').html(output)

                        if (data.has_many === "yes") {
                            Swal.fire({
                                customClass: {
                                    container: 'sweet-alert'
                                },
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                onOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                },
                                icon: 'warning',
                                title: 'This product is added once'
                            })
                            setTimeout(function () {
                                Swal.fire({
                                    customClass: {
                                        container: 'sweet-alert'
                                    },
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    onOpen: (toast) => {
                                        toast.addEventListener(
                                            'mouseenter', Swal
                                                .stopTimer)
                                        toast.addEventListener(
                                            'mouseleave', Swal
                                                .resumeTimer)
                                    },
                                    icon: 'success',
                                    title: 'Product added success!'
                                })
                            }, 3000);
                        } else {
                            Swal.fire({
                                customClass: {
                                    container: 'sweet-alert'
                                },
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                onOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                },
                                icon: 'success',
                                title: 'Product added success!'
                            })
                        }
                    }
                    if (data.available === "no") {
                        Swal.fire({
                            customClass: {
                                container: 'sweet-alert'
                            },
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            onOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal
                                    .stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            },
                            icon: 'warning',
                            title: 'Stock out!'
                        })
                    }
                }
            });
        });
    })
</script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".nav-item").click(function (e) {
            // e.preventDefault();
            $(this).toggleClass("open");


        })
        $("#nav-toggler").click(function () {
            $(".product-product-21215").toggleClass("no-scroll");
            $(".navbar").toggleClass("open");
            $(this).toggleClass("close");
        });
        $(".search-toggler").click(function () {
            $(".ht-item ").toggleClass("open");
            $(this).toggleClass("close");
        });
        $(".mc-toggler").click(function () {
            $(".mc-toggler").toggleClass("close");
            $(".m-cart").toggleClass("open");
        });
        $(".cmpr-toggler").click(function () {
            $(".cmpr-toggler").toggleClass("close");
            $(".cmpr-panel").toggleClass("open");
        });


        var s = $(".product-product-21215");
        var pos = s.position();
        $(window).scroll(function () {
            var windowpos = $(window).scrollTop();
            if (windowpos >= pos.top & windowpos > 50) {
                s.addClass("on-scroll");
            } else {
                s.removeClass("on-scroll");
            }
        });

        $('.subscribe').click(function (e) {
            e.preventDefault()
            var email = $('input[name="sub_email"]').val()
            var id = $('input[name="sub_id"]').val()
            var name = $('input[name="sub_name"]').val()
            var contact_no = $('input[name="sub_contact"]').val()
            if (email !== null && email !== '') {
                $.ajax({
                    url: "{{ route('subscribe') }}",
                    method: "post",
                    dataType: "html",
                    data: {
                        email,
                        id,
                        name,
                        contact_no
                    },
                    success: function (data) {
                        if (data === "success") {
                            $('input[name="sub_name"]').val("")
                            $('input[name="sub_email"]').val("")
                            $('input[name="sub_contact"]').val("")
                            Swal.fire({
                                icon: 'success',
                                title: 'Congrats!',
                                text: 'You have subscribed successfully!!',
                            })
                        }

                        if (data === "duplicate") {
                            $('input[name="sub_name"]').val("")
                            $('input[name="sub_email"]').val("")
                            $('input[name="sub_contact"]').val("")
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'This Email Address is Already Used!',
                            })
                        }
                    }
                })
            }
        })


        $('#home-search').keyup(function (e) {
            $('#suggestion-box').css("display", 'block');
            $('#suggestion-product').empty();
            $('#suggestion-category').empty();
            $('#suggestion-brand').empty();
            if (e.keyCode === 13) {
                window.location = "{{ URL::to('products') }}?search=" + $(this).val()
            } else {
                var value = $(this).val()
                if (value !== "") {
                    $.ajax({
                        url: "{{ route('ajax.search.product.name') }}",
                        method: "post",
                        dataType: "html",
                        data: {
                            key: value
                        },
                        success: function (data) {
                            data = JSON.parse(data)
                            const assetPath = "{{ asset('') }}";

                            if (data.status === "success") {
                                let product = '';
                                $.each(data.products, function (i, e) {
                                    var price = ""
                                    if ((e.price != null) && (e.price > 0)) {
                                        price = " (<span style='color:maroon;'>" + e
                                            .price + "</span> TK) ";
                                    }
                                    product +=
                                        '<li class="sug-menu-item" data-name="' + e
                                            .name + '" data-slug="' + e.slug +
                                        '" data-type="product"><a href="/product/'+e.slug+'"><img class="search_image" src="' +
                                        assetPath + "" + e.image + '" alt="">' + e
                                            .name + " " + price + '</a></li>'
                                })
                                $('#suggestion-product').html(product)
                                let category = '';
                                $.each(data.sub_categories, function (i, e) {
                                    category +=
                                        '<li class="sug-menu-item" data-name="' + e
                                            .name + '" data-slug="' + e.slug +
                                        '" data-type="subcategory" >' + e.name +
                                        '</li>'
                                })
                                $('#suggestion-sub-category').html(category)
                                let brand = '';
                                $.each(data.brands, function (i, e) {
                                    brand +=
                                        '<li class="sug-menu-item" data-name="' + e
                                            .name + '" data-slug="' + e.slug +
                                        '" data-type="brand">' + e.name + '</li>'
                                })
                                $('#suggestion-brand').html(brand)
                                $('#suggestion-box').css('display', 'block')

                            }
                        }
                    });
                } else {
                    $('#suggestion-box').css('display', 'none')
                }
            }
        })

        $('.home-search-btn').click(function () {
            window.location = "{{ URL::to('products') }}?search=" + $('#home-search').val()
        })
        $(document).on('click', '.sug-menu-item', function () {
            var text = $(this).data('name')
            var slug = $(this).data('slug')
            var search_by = $(this).data('type')
            $('#home-search').val(text)
            $('#suggestion-list').empty()
            $('#suggestion-box').css('display', 'none')
            window.location = "{{ URL::to('products') }}?search=" + slug + "&search_by=" + search_by +
                ""
        })


        $('.site_feedback').click(function () {
            $('#feedback_modal').modal('show')
        })

        $('#feedback_form').submit(function (e) {
            e.preventDefault()
        })

        $('#feedback_send_btn').click(function () {
            var name = $('#feedback_send_name').val();
            var email = $('#feedback_send_email').val();
            var mobile_no = $('#feedback_send_mobile_no').val();
            var message = $('#feedback_send_message').val();
            $.ajax({
                url: "{{ route('send.feedback') }}",
                method: "post",
                dataType: "html",
                data: {
                    name,
                    email,
                    mobile_no,
                    message
                },
                success: function (data) {
                    if (data === "success") {
                        $('#feedback_modal').modal('hide')
                        Swal.fire({
                            customClass: {
                                container: 'sweet-alert'
                            },
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            onOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal
                                    .stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            },
                            icon: 'success',
                            title: 'Successfully message sent!'
                        })
                    }
                }
            });

        })

        $('#header_clearing_sell_btn').click(function () {
            var loc = "{{ route('home') }}"
            var href = window.location.origin + window.location.pathname
            if (loc + "/" !== href) {
                window.location = loc + "#Clearance_Sell"
            }
            $('html,body').animate({
                    scrollTop: $("#Clearance_Sell").offset().top
                },
                'slow');
        })
        $('#header_special_discount_btn').click(function () {
            var loc = "{{ route('home') }}"
            var href = window.location.origin + window.location.pathname
            if (loc + "/" !== href) {
                window.location = loc + "#special_discount"
            }
            $('html,body').animate({
                    scrollTop: $("#special_discount").offset().top
                },
                'slow');
        })

    })
</script>


<script type="text/javascript">
    $(function () {
        //caches a jQuery object containing the header element
        var header = $(".open");
        $(window).scroll(function () {
            var scroll = $(window).scrollTop();

            if (scroll >= 300) {
                header.removeClass('open').addClass("close");
            } else {
                header.removeClass("close").addClass('open');
            }
        });
    });
</script>
<script type="text/javascript">
    $('ul.nav li.dropdown').hover(function () {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
    }, function () {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
    });
</script>
<!-- JS to open and close sidebar with overlay effect -->
<script>
    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("myOverlay").style.display = "block";
    }

    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("myOverlay").style.display = "none";
    }
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#accordian a").click(function () {
            var link = $(this);
            var closest_ul = link.closest("ul");
            var parallel_active_links = closest_ul.find(".active")
            var closest_li = link.closest("li");
            var link_status = closest_li.hasClass("active");
            var count = 0;

            closest_ul.find("ul").slideUp(function () {
                if (++count == closest_ul.find("ul").length)
                    parallel_active_links.removeClass("active");
            });

            if (!link_status) {
                closest_li.children("ul").slideDown();
                closest_li.addClass("active");
            }
        })
    })
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-180220778-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'UA-180220778-1');
</script>

@yield('script')

<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function () {
        FB.init({
            xfbml: true,
            version: 'v7.0'
        });
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<!-- Your Chat Plugin code -->
<div class="fb-customerchat" attribution=setup_tool page_id="460239717333228"
     logged_in_greeting="Hi! How can we help you?" logged_out_greeting="Hi! How can we help you?">
</div>

{{-- <script type="text/javascript">
$(window).on('scroll', function(e){
var scroll = $(window).scrollTop();
if(scroll > 200){
$(".dropdown").removeClass("open");
}
});
</script> --}}

<script>
    $(document).ready(function () {

    });
    //   function w3_open1() {
    //   document.getElementsByClassName("touch-solve").style.display = "block";
    // }
</script>
</body>

</html>
