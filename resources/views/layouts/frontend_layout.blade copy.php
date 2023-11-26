<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7"><![endif]-->
<!--[if IE 8]>
<html class="ie ie8"><![endif]-->
<!--[if IE 9]>
<html class="ie ie9"><![endif]-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <link rel="shortcut icon" href="{{ asset('assets/images/fav.png') }}" type="image/x-icon">
  <link rel="icon" href="{{ asset('assets/images/fav.png') }}" type="image/x-icon">
  <link rel="canonical" href="{{ url()->current() }}"/>
  <meta name="author" content="Touch & Solve">
  {{--<meta name="robots" content="AL Hadi Enterprise" />--}}
  <meta name="robots" content="index, follow"/>
  @yield('meta')
{{--  <meta name="keywords" content="AL Hadi Enterprise, alhadienterprise, music store in bd">--}}
  <meta name="description" content="Touch & Solve">
  <title>Touch & Solve |  @yield('page_title')</title>
{{--    <title> @yield('title')</title>--}}

<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Fonts-->
<link
  href="https://fonts.googleapis.com/css?family=Archivo+Narrow:300,400,700%7CMontserrat:300,400,500,600,700,800,900"
  rel="stylesheet">


<link rel="stylesheet" href="{{ asset("assets/frontend/plugins/font-awesome/css/font-awesome.min.css") }}">
<link rel="stylesheet" href="{{ asset("assets/frontend/plugins/ps-icon/style.css") }}">

<!-- CSS Library-->
<link rel="stylesheet" href="{{ asset("assets/frontend/plugins/bootstrap/dist/css/bootstrap.min.css") }}">
<link rel="stylesheet" href="{{ asset("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css") }}"/>
{{-- <link rel="stylesheet" href="{{ asset("assets/frontend/plugins/owl-carousel/assets/owl.carousel.css") }}"> --}}
{{--<link rel="stylesheet" href="{{ asset("assets/frontend/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css") }}">--}}
{{--<link rel="stylesheet" href="{{ asset("assets/frontend/plugins/slick/slick/slick.css") }}">--}}
{{--<link rel="stylesheet" href="{{ asset("assets/frontend/plugins/bootstrap-select/dist/css/bootstrap-select.min.css") }}">--}}
{{--<link rel="stylesheet" href="{{ asset("assets/frontend/plugins/Magnific-Popup/dist/magnific-popup.css") }}">--}}
{{--<link rel="stylesheet" href="{{ asset("assets/frontend/plugins/jquery-ui/jquery-ui.min.css") }}">--}}
<link rel="stylesheet" href="{{ asset("assets/frontend/plugins/revolution/css/settings.css") }}">
<link rel="stylesheet" href="{{ asset("assets/frontend/plugins/revolution/css/layers.css") }}">
<link rel="stylesheet" href="{{ asset("assets/frontend/plugins/revolution/css/navigation.css") }}">
{{--<!-- Custom-->--}}
<link rel="stylesheet" href="{{ asset("assets/frontend/css/style.css") }}">
<link rel="stylesheet" href="{{ asset("assets/frontend/css/nfs.css") }}">
<link rel="stylesheet" href="{{ asset("assets/frontend/css/w3.css") }}">
<link rel="stylesheet" href="{{ asset("assets/frontend/MultilevelNFS/css/default.css") }}">
<link rel="stylesheet" href="{{ asset("assets/frontend/MultilevelNFS/css/component.css") }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.2/assets/owl.carousel.min.css"/>
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.2/assets/owl.theme.default.min.css" /> --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.2/assets/owl.theme.green.min.css" /> --}}
<!--HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
<!--WARNING: Respond.js doesn't work if you view the page via file://-->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->

{{--    <script type="text/javascript" src="{{ asset('plugins/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('plugins/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>--}}
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
  @media screen and (min-width: 405px){
  .w3-btn, .w3-button {
    padding: 5px 16px;
    }
  }
</style>

<!-- Facebook Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '822569511773801');
  fbq('track', 'PageView');
  </script>
  <noscript><img height="1" width="1" style="display:none"
  src="https://www.facebook.com/tr?id=822569511773801&ev=PageView&noscript=1"
  /></noscript>
  <!-- End Facebook Pixel Code -->


</head>
<!--[if IE 7]>
<body class="ie7 lt-ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 8]>
<body class="ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 9]>
<body class="ie9 lt-ie10"><![endif]-->
<body class="">  <!--class="ps-loading"-->
<div class="header--sidebar"></div>


<!--SIDEBAR only For MOBILE or SMALL DEVICES-->
<div class="w3-sidebar w3-bar-block w3-animate-left" style="display:none;z-index:9999;background: white;"
   id="mySidebar">

<div style=" margin-top: 30px; margin-bottom: 60px;">
  {{-- <span class="w3-bar-item w3-large " style="color: black;">Categories</span> --}}
  <img style="margin-right: 15px; width: 180px; z-index: 9998;" src="{{ asset('assets/images/logo_long.png') }}"
       alt="">
  <span class="w3-close" onclick="w3_close()">X</span>
</div>
<div id="accordian">
  <ul>
    @foreach($home_category as $h_category)
      <li>
        <h3><a href="{{ /*route('product', ['category'=> $h_category['slug']])*/ '#' }}"><img
              src="{{ asset($h_category['image']) }}" width="20px" height="20px" class="mr-10 ml-10"
              alt="">{{ $h_category['name'] }}</a></h3>
        <ul>
          @foreach($h_category['sub_category'] as $h_subCategory)
            <li>
              <a href="#">{{ $h_subCategory['name'] }}</a>
              <ul>
                @foreach($h_subCategory['brand'] as $h_brand)
                  <li><a
                      href="{{ route('product', ['category'=>$h_category['slug'], 'sub_category'=> $h_subCategory['slug'], 'brand'=>$h_brand['slug']]) }}">{{ $h_brand['name'] }}</a>
                  </li>
                @endforeach
              </ul>
            </li>
          @endforeach
        </ul>
      </li>
    @endforeach
  </ul>
</div>
</div>


<div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>


<header class="header" style="">
<div class="header__top" style="background-color: #e4e4e4">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6 col-md-8 col-sm-6 col-xs-12 ">
        <p class="hot-number"><i class="fa fa-phone"></i> Hotline: <a href="tel:+8801900000000">+8801900000000</a>,
          <a href="tel:+8801700000000">+8801700000000</a></p>
      </div>
      <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12 ">
        <div class="btn-group ps-dropdown HambButton" style="float: left;">
          <div class="noShow">
            <button class="w3-button w3-white w3-xxlarge" onclick="w3_open()" style="padding: 0px;">&#9776;</button>
          </div>
        </div>
        <div class="header__actions" style="float: right;">

          <div class="btn-group ps-dropdown hidesmall">
            <a href="{{ route('notice') }}"><b>Notice</b></a>
          </div>
          <div class="btn-group ps-dropdown hidesmall">
            <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><b>Tracking</b>
              <i class="fa fa-angle-down"></i>
            </a>
            @if(isset($last_order))
              <ul class="dropdown-menu">
                <li><a
                    href="{{ route('customer.orderDetails', $last_order->id) }}">{{ $last_order->status.'  ('.date('F d, Y H:i:s A', strtotime($last_order->created_at)).')' }}</a>
                </li>
              </ul>
            @endif
          </div>
          <div class="btn-group ps-dropdown">
            <div class="noShow" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                 aria-expanded="false" href="#"><img src="{{ asset('assets/frontend/images/tracker.png') }}"
                                                     style="width: 35px; height: auto;">
            </div>
            @if(isset($last_order))
              <ul class="dropdown-menu" style="z-index: 99999; left: -80px; min-width: 400px">
                <li><a
                    href="{{ route('customer.orderDetails', $last_order->id) }}">{{ $last_order->status.'  ('.date('F d, Y H:i:s A', strtotime($last_order->created_at)).')' }}</a>
                </li>
              </ul>
            @endif
          </div>
          <div class="btn-group ps-dropdown hidesmall">
            <a data-toggle="tooltip" title="About" data-placement="bottom" href="{{ route('aboutus') }}"><b>About</b></a>
          </div>
          <div class="btn-group ps-dropdown hidesmall">
            <a data-toggle="tooltip" title="Contact" data-placement="bottom" href="{{ route('contactus') }}"><b>Contact</b></a>
          </div>
          @if(auth()->user())
            <div class="btn-group ps-dropdown">
              <a class="dropdown-toggle" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @if(isset(auth()->user()->image))
                  <img src="{{ asset(auth()->user()->image) }}" alt="" style="max-height: 30px">
                @else
                  <i style="color: #005caf;" class="fa fa-user"></i>
                @endif
                <i class="fa fa-angle-down"></i>
              </a>
              <ul style="z-index: 99999" class="dropdown-menu">
                <li><a>{{ auth()->user()->name }}</a></li>
                @if(auth()->user()->type == 'admin' || auth()->user()->type == 'moderator' )
                  <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                  <li><a href="{{ route('admin.logout') }}">Logout</a></li>
                @else
                  <li><a href="{{ route('customer.dashboard') }}">Dashboard</a></li>
                  <li><a href="{{ route('customer.logout') }}">Logout</a></li>
                @endif
              </ul>
            </div>
          @else
            <div class="btn-group ps-dropdown">
              <a data-toggle="tooltip" title="Login" data-placement="bottom" href="{{ route('login') }}"><i
                  style="color: #800; " class="fa fa-user"></i></a>
            </div>
            <div class="btn-group ps-dropdown">
              <a data-toggle="tooltip" title="Register" data-placement="bottom" href="{{ route('registration') }}"><i
                  style="color: #000;" class="fa fa-user-plus"></i></a>
            </div>
          @endif
          <div class="btn-group ps-dropdown ps-cart" style="margin-right: 10px">
            <a class="ps-cart__toggle" href="{{ route('compare') }}"><span style="background-color: #005caf;"><i
                  class="ps-cart__count compare-count">{{ $compare_count }}</i></span><i class="fa fa-tasks"></i></a>
          </div>
          <div class="btn-group ps-dropdown ps-cart"><a class="ps-cart__toggle" href="#"><span
                style="background-color: #005caf;"><i
                  class="ps-cart__count cart-count">{{ \Cart::getTotalQuantity() }}</i></span><i
                class="ps-icon-shopping-cart"></i></a>
            <div class="ps-cart__listing">
              <div class="ps-cart__content" style="padding-top: 0px; padding-bottom: 0px; overflow-y: scroll">
                @foreach(\Cart::getContent() as $item)
                  <div class="ps-cart-item"><a class="ps-cart-item__close"
                                               href="{{ route('cart.remove', $item->id) }}"></a>
                    <div class="ps-cart-item__thumbnail"><a href=""></a><img
                        src="{{ asset($item->attributes->image) }}" alt=""></div>
                    <div class="ps-cart-item__content"><a class="ps-cart-item__title"
                                                          href="">{{ (strlen($item->name) > 20) ? substr($item->name, 0, 25)."..." : $item->name }}</a>
                      <p style="font-size: 10px"><span style="color: white">Qty: {{ $item->quantity }}
                          X Tk{{ $item->price }} = {{ ($item->quantity * $item->price) }} Tk</span></p>
                    </div>
                  </div>
                @endforeach
              </div>
              <div class="ps-cart__total">
                {{--<p>Number of items:<span class="ps-cart__total_item">0</span></p>--}}
                <p>Total:<span class="ps-cart__total_amount">TK {{ \Cart::getTotal() }}</span></p>
              </div>
              <div class="ps-cart__footer"><a class="ps-btn" href="{{ route('customer.checkout') }}">Checkout<i
                    class="ps-icon-arrow-left"></i></a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<nav class="navigation" id="navbar">
  <div class="" style="background-color: white;">
    <div class="navigation__column left" style="display: inline-flex">
      <div class="header__logo"><a class="ps-logo" href="{{ route('home') }}"><img
            style="z-index: 999; position: relative; margin-left: 10px; width: 100%!important;"
            src="{{ asset('assets/images/logo_long.png') }}" alt=""></a></div>
    </div>
    <div class="row" style="padding-top: 10px;  padding-left: 0%; padding-right: 0%;">
      <div class="text-center col-md-8 col-md-8 col-lg-8 col-xl-8" style="position: relative;">
        <input id="home-search" class="form-control"
               type="text" placeholder="Search by Product, Category or Brand"
               value="{{(isset($request->search) ? $request->search : "")}}">
        <button class="home-search-btn"><i class="ps-icon-search"></i></button>
      </div>
      <div id="suggestion-box" class="pl-20 col-md-12 col-lg-12 col-xl-12"
           style="position: relative; display: none;margin-top: 5px;">
        <div class="row sug-sub-menu col-lg-8 search-row" style="display: inline-table;">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#SearchedProducts">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#SearchedCategories">Categories</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#SearchedBrands">Brands</a>
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
    </div>
    @if(isset($home_notice))
      <div class="row" style="color: black">
        <marquee><strong><a href="{{ route('notice') }}">{!! $home_notice->title !!}</a></strong></marquee>
      </div>
    @endif
    <div>
      <p class="hot-number hot-number-mobile" style="text-align: center;">
        <i class="fa fa-phone"></i> Hotline: <a href="tel:+8801900000000">+8801900000000</a>, <a
          href="tel:+8801700000000">+8801700000000</a>
      </p>
    </div>

    <div class="fixed-top navbar navbar-static-top navbar-expand-md"
         style="min-height: 35px;background-color: white; display: flex; border-bottom: 1px solid #d3d3d3; border-top: 1px solid #d3d3d3;">
      <!-- <button type="button" class="navbar-toggler" data-toggle="collapse" data-target=".navbar-collapse">☰</button> -->

      <div class="noShowNope">
        <button class="w3-button w3-white w3-large" onclick="w3_open()">&#9776;</button>
      </div>

      <div class="navbar-collapse">
        <ul class="nav navbar-nav makeSmall" style="display: -webkit-box;">
          <li class="dropdown menu-large nav-item"><a href="#" class="dropdown-toggle nav-link hot-number"
                                                      data-toggle="dropdown">Brands</a>
            <ul class="dropdown-menu megamenu" style="z-index: 9999">
              <div class="row megamenu_ul_row">
                <li class="col-12 dropdown-item">
                  <ul>
                    {{--<li class="dropdown-header">Top Brands</li>--}}
                    @foreach($home_brands as $b_item)
                      <li class="tBThumb brands_li" data-toggle="tooltip" data-placement="top"
                          title="{{ $b_item['name'] }}">
                        <a href="{{ route('product', ['brand'=> $b_item['slug']] ) }}"
                           style="padding: 0px; margin: 0px">
                          <img class="tBThumbImg" style="" src="{{ asset($b_item['image']) }}">
                        </a>
                      </li>
                    @endforeach
                  </ul>
                </li>
              </div>
            </ul>
          </li>


          <li class="dropdown menu-large nav-item">
            <a href="#" class="dropdown-toggle nav-link hot-number" data-toggle="dropdown">Departments</a>
            <ul class="dropdown-menu megamenu" style="z-index: 9999">
              <div class="row megamenu_ul_row">
                @foreach($home_category as $item)
                  <li class="col-md-2 col-xl-2 col-lg-2 dropdown-item">
                    <ul>
                      {{--<li class="dropdown-header"><a href="{{ route('product', ['category'=> $item['slug']]) }}">{{ $item['name'] }}</a></li>--}}
                      <li class="dropdown-header">{{ $item['name'] }}</li>
                      @foreach($item['sub_category'] as $item2)
                        <li><a
                            href="{{ route('product', ['category'=> $item['slug'], 'sub_category' => $item2['slug'] ]) }}">{{ $item2['name'] }}</a>
                        </li>
                      @endforeach
                      {{--<li class="divider"></li>--}}
                    </ul>
                  </li>
                @endforeach
              </div>
            </ul>
          </li>

          <li class="dropdown menu-large nav-item">
            <a href="{{ route('product.new_arrivals') }}" class="dropdown-toggle nav-link hot-number">New Arrivals</a>
          </li>


          <li class="dropdown menu-large nav-item">
            {{--<a href="#Clearance_Sell" id="header_clearing_sell_btn" class="dropdown-toggle nav-link">Clearance Sale</a>--}}
            <a href="{{ route('product.clearance_sale') }}" class="dropdown-toggle nav-link hot-number">Clearance
              Sale</a>
          </li>

          <li class="dropdown menu-large nav-item">
            {{--<a href="#special_discount" id="header_special_discount_btn" class="dropdown-toggle nav-link">Special Discount</a>--}}
            <a href="{{ route('product.special_discount') }}" class="dropdown-toggle nav-link hot-number">Special
              Discount</a>

          </li>

          <li class="dropdown menu-large nav-item">
            {{--<a href="#special_discount" id="header_special_discount_btn" class="dropdown-toggle nav-link">Special Discount</a>--}}
            <a href="{{ route('gallery.index') }}" class="dropdown-toggle nav-link hot-number">Gallery</a>
          </li>
        </ul>
      </div>
    </div>

  </div>
</nav>
</header>


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
          <input type="hidden" name="sub_id" value="{{ (auth()->user()) ? auth()->id() : '' }}">
          <div class="form-group col-md-3">
            <input class="form-control" name="sub_name" type="name" required placeholder="Enter Your Name">
          </div>
          <div class="form-group col-md-3">
            <input class="form-control" name="sub_email" type="email" required placeholder="Enter a email">
          </div>
          <div class="form-group col-md-3">
            <input class="form-control" name="sub_contact" type="email" required placeholder="Contact No">
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
<div class="ps-footer bg--cover" data-background="{{ asset('assets/frontend/images/background/parallax.jpg') }}">
  <div class="ps-footer__content" style="position: sticky">
    <img src="{{asset('assets/images/SSLCommerz2.png')}}">
    <div class="ps-container">
      <p style="text-align: center; margin-top: 40px; margin-bottom: 20px;">
        <a href="{{ route('home') }}"><img style="width: 50%;" src="{{ asset('assets/images/logo_long.png') }} "
                                           alt=""></a>
      </p>
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 ">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <aside class="ps-widget--footer ps-widget--info">
              <header>
                <h3 class="ps-widget__title">Registered Office</h3>
              </header>
              <footer>
                <p><strong><i class="fa fa-map-marker"></i>H-202, 3rd Floor, Road- 3/A, Block-B, Shagufta Housing Society, Mirpur DOHS Road</strong></p>
                <p><i class="fa fa-envelope"></i> <a href='mailto:support@alhadienterprise.com'>support@alhadienterprise.com</a>
                </p>
                <p><i class="fa fa-phone"></i> <a href="tel:+8801900000000">+8801900000000</a></p>
                <p><i class="fa fa-phone"></i> <a href="tel:+8801700000000">+8801700000000</a></p>
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
              <p><strong> <i class="fa fa-map-marker"></i>  House-90, Rod-17/A, Block-E, Banani, 1213</strong></p>
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
                <li><a class="site_feedback" style="cursor: pointer">Site Feedback</a></li>
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
                <li><a href="{{ route('privacy.policy') }}">Privacy Policy</a></li>
                <li><a href="{{ route('terms.and.conditions') }}">Terms And Conditions</a></li>
                <li><a href="{{ route('aboutus') }}">About Us</a></li>
                <li><a href="{{ route('contactus') }}">Contact Us</a></li>
              </ul>
            </footer>
          </aside>
        </div>
        {{--<div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
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
        </div>--}}
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
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
          <p>&copy; <a href="#">Touch & Solve</a>. All rights Resevered. Developed by <a
              href="https://touchandsolve.com/"> Touch & Solve</a></p>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
          <ul class="ps-social">
            <li><a href="https://www.facebook.com/touchandsolve" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="https://www.linkedin.com/company/touchandsolve"><i class="fa fa-linkedin"></i></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="feedback_modal" tabindex="-1" role="dialog" aria-labelledby="feedback_modal"
       style="z-index: 30000000">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" style="color: red;font-weight: bold;" data-dismiss="modal"
                  aria-label="Close"><span aria-hidden="true">x</span></button>
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
                margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
              }

              input[type=number] {
                -moz-appearance: textfield; /* Firefox */
              }
            </style>
            <div class="form-group">
              <label class="control-label">Name:</label>
              <input type="text" id="feedback_send_name" name="name"
                     value="{{ (isset(auth()->user()->name)) ? auth()->user()->name : null }}" required
                     class="form-control input-size">
            </div>
            <div class="form-group">
              <label class="control-label">Email:</label>
              <input type="email" id="feedback_send_email" name="email"
                     value="{{ (isset(auth()->user()->email)) ? auth()->user()->email : null }}" required
                     class="form-control input-size">
            </div>
            <div class="form-group">
              <label class="control-label">Mobile No:</label>
              <input type="number" id="feedback_send_mobile_no" name="mobile_no"
                     value="{{ (isset(auth()->user()->mobile_no)) ? auth()->user()->mobile_no : null }}" required
                     class="form-control input-size">
            </div>
            <div class="form-group">
              <label class="control-label">Message:</label>
              <textarea name="message" class="form-control" id="feedback_send_message" required></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" id="feedback_send_btn" class="btn btn-success">Send message</button>
          </div>
        </form>
      </div>
    </div>
  </div>


</div>
</main>
<!-- JS Library-->
<script type="text/javascript" src="{{ asset("assets/frontend/plugins/jquery/dist/jquery.min.js") }}"></script>
<script type="text/javascript" src="{{ asset("assets/frontend/plugins/bootstrap/dist/js/bootstrap.min.js") }}"></script>
<script type="text/javascript"
      src="{{ asset("assets/frontend/plugins/jquery-bar-rating/dist/jquery.barrating.min.js") }}"></script>
<script type="text/javascript" src="{{ asset("assets/frontend/plugins/owl-carousel/owl.carousel.min.js") }}"></script>
<script type="text/javascript" src="{{ asset("assets/frontend/plugins/jquery-ui/jquery-ui.min.js") }}"></script>
<script type="text/javascript" src="{{ asset("assets/frontend/plugins/gmap3.min.js") }}"></script>
<script type="text/javascript" src="{{ asset("assets/frontend/plugins/imagesloaded.pkgd.js") }}"></script>
<script type="text/javascript" src="{{ asset("assets/frontend/plugins/isotope.pkgd.min.js") }}"></script>
<script type="text/javascript"
      src="{{ asset("assets/frontend/plugins/bootstrap-select/dist/js/bootstrap-select.min.js") }}"></script>
<script type="text/javascript" src="{{ asset("assets/frontend/plugins/jquery.matchHeight-min.js") }}"></script>
<script type="text/javascript" src="{{ asset("assets/frontend/plugins/slick/slick/slick.min.js") }}"></script>
<script type="text/javascript" src="{{ asset("assets/frontend/plugins/elevatezoom/jquery.elevatezoom.js") }}"></script>
<script type="text/javascript"
      src="{{ asset("assets/frontend/plugins/Magnific-Popup/dist/jquery.magnific-popup.min.js") }}"></script>
<script type="text/javascript" src="{{ asset("assets/frontend/plugins/jquery-ui/jquery-ui.min.js") }}"></script>
<script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAx39JFH5nhxze1ZydH-Kl8xXM3OK4fvcg&amp;region=GB"></script>
<script type="text/javascript"
      src="{{ asset("assets/frontend/plugins/revolution/js/jquery.themepunch.tools.min.js") }}"></script>
<script type="text/javascript"
      src="{{ asset("assets/frontend/plugins/revolution/js/jquery.themepunch.revolution.min.js") }}"></script>
<script type="text/javascript"
      src="{{ asset("assets/frontend/plugins/revolution/js/extensions/revolution.extension.video.min.js") }}"></script>
<script type="text/javascript"
      src="{{ asset("assets/frontend/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js") }}"></script>
<script type="text/javascript"
      src="{{ asset("assets/frontend/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js") }}"></script>
<script type="text/javascript"
      src="{{ asset("assets/frontend/plugins/revolution/js/extensions/revolution.extension.navigation.min.js") }}"></script>
<script type="text/javascript"
      src="{{ asset("assets/frontend/plugins/revolution/js/extensions/revolution.extension.parallax.min.js") }}"></script>
<script type="text/javascript"
      src="{{ asset("assets/frontend/plugins/revolution/js/extensions/revolution.extension.actions.min.js") }}"></script>
<!-- Custom scripts-->
<script src="{{ asset('assets/frontend/js/sweetalert2.js') }}"></script>
<script type="text/javascript" src="{{ asset("assets/frontend/js/main.js") }}"></script>
<script type="text/javascript" src="{{ asset("assets/frontend/MultilevelNFS/js/modernizr.custom.js") }}"></script>
<script type="text/javascript" src="{{ asset("assets/frontend/MultilevelNFS/js/jquery.dlmenu.js") }}"></script>
<script type="text/javascript" src="{{ asset("assets/frontend/js/jquery.sticky.js") }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.2/owl.carousel.min.js"></script> --}}

<style>
.sweet-alert {
  z-index: 200000;
  font-size: 40px;
}
</style>
<script>
$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
        data: {email, id, name, contact_no},
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
      window.location = "{{  URL::to('products') }}?search=" + $(this).val()
    } else {
      var value = $(this).val()
      if (value !== "") {
        $.ajax({
          url: "{{ route('ajax.search.product.name') }}",
          method: "post",
          dataType: "html",
          data: {key: value},
          success: function (data) {
            data = JSON.parse(data)
            const assetPath = "{{ asset("") }}";

            if (data.status === "success") {
              let product = '';
              $.each(data.products, function (i, e) {
                var price = ""
                if ((e.price != null) && (e.price > 0)) {
                  price = " (<span style='color:maroon;'>" + e.price + "</span> TK) ";
                }
                product += '<li class="sug-menu-item" data-name="' + e.name + '" data-slug="' + e.slug + '" data-type="product"><img class="search_image" src="' + assetPath + "" + e.image + '" alt="">' + e.name + " " + price + '</li>'
              })
              $('#suggestion-product').html(product)
              let category = '';
              $.each(data.sub_categories, function (i, e) {
                category += '<li class="sug-menu-item" data-name="' + e.name + '" data-slug="' + e.slug + '" data-type="subcategory" >' + e.name + '</li>'
              })
              $('#suggestion-sub-category').html(category)
              let brand = '';
              $.each(data.brands, function (i, e) {
                brand += '<li class="sug-menu-item" data-name="' + e.name + '" data-slug="' + e.slug + '" data-type="brand">' + e.name + '</li>'
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
    window.location = "{{  URL::to('products') }}?search=" + $('#home-search').val()
  })
  $(document).on('click', '.sug-menu-item', function () {
    var text = $(this).data('name')
    var slug = $(this).data('slug')
    var search_by = $(this).data('type')
    $('#home-search').val(text)
    $('#suggestion-list').empty()
    $('#suggestion-box').css('display', 'none')
    window.location = "{{  URL::to('products') }}?search=" + slug + "&search_by=" + search_by + ""
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
      data: {name, email, mobile_no, message},
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
              toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
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
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your Chat Plugin code -->
<div class="fb-customerchat"
   attribution=setup_tool
   page_id="460239717333228"
   logged_in_greeting="Hi! How can we help you?"
   logged_out_greeting="Hi! How can we help you?">
</div>

{{-- <script type="text/javascript">
$(window).on('scroll', function(e){
var scroll = $(window).scrollTop();
if(scroll > 200){
$(".dropdown").removeClass("open");
}
});
</script> --}}
</body>
</html>
