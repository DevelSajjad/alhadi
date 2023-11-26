@extends('layouts.frontend_layout')

{{--@section('meta')--}}
{{--<meta name="keywords" content="AL Hadi Enterprise">--}}
{{--@endsection--}}

@section('page_title','Home')

@section('stylesheet')
<link rel="stylesheet"
  href="{{ asset("assets/frontend/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css") }}">
<link rel="stylesheet" href="{{ asset("assets/frontend/plugins/slick/slick/slick.css") }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css"
  integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ asset("assets/frontend/plugins/bootstrap-select/dist/css/bootstrap-select.min.css") }}">
<link rel="stylesheet" href="{{ asset("assets/frontend/plugins/Magnific-Popup/dist/magnific-popup.css") }}">
<link rel="stylesheet" href="{{ asset("assets/frontend/plugins/jquery-ui/jquery-ui.min.css") }}">

@endsection

@section('content')

<style>
</style>

<div class="hidesmall" style="display: none !important">
  <div class="btn-group open btn-success" id="header">
    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
      Categories
      <span class="caret"></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu">
{{--      @foreach($home_category as $category)--}}
{{--      <li class="dropdown-submenu dropdown-menu-right">--}}
{{--        <a tabindex="-1" href="{{ route('product', ['category'=> $category['slug']]) }}"><img--}}
{{--            src="{{ asset($category['image']) }}" height="20px" width="20px" alt=""--}}
{{--            class="mr-10">{{ $category['name'] }}</a>--}}
{{--        @if(count($category['sub_category']) > 0)--}}
{{--        <ul class="dropdown-menu" style="background-color: #F3F3F3">--}}
{{--          @foreach($category['sub_category'] as $subkey => $subcategory)--}}
{{--          <li class="dropdown-submenu">--}}
{{--            <a--}}
{{--              href="{{ route('product', ['category'=> $category['slug'], 'sub_category' => $subcategory['slug'] ]) }}">{{ $subcategory['name'] }}</a>--}}
{{--            @if(count($subcategory['brand'] ) > 0)--}}
{{--            <ul class="dropdown-menu" style="background-color: #E7E7E7">--}}
{{--              @foreach($subcategory['brand'] as $brand)--}}
{{--              <li><a--}}
{{--                  href="{{ route('product', ['category'=> $category['slug'], 'sub_category' => $subcategory['slug'], 'brand' => $brand['slug'] ]) }}">{{ $brand['name'] }}</a>--}}
{{--              </li>--}}
{{--              @endforeach--}}
{{--            </ul>--}}
{{--            @endif--}}
{{--          </li>--}}
{{--          @endforeach--}}
{{--        </ul>--}}
{{--        @endif--}}
{{--      </li>--}}
{{--      @endforeach--}}
    </ul>
  </div>
</div>

<!-- Header Slider -->
<div class="row slider-container">
  <div class="col-md-8">
    <div class="ps-banner text-center">
      <div class="row">
        <div id="myCarousel" class="carousel slide" data-ride="carousel" style="
          width: 100%;
          display: inline-flex;">
          <ol class="carousel-indicators">
            @foreach($banners as $key => $banner)
            @if($key == 0)
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            @else
            <li data-target="#myCarousel" data-slide-to="{{$key}}"></li>
            @endif
            @endforeach

          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            @foreach($banners as $key => $banner)
            @if($key == 0)
            <div class="item active" style="width: 100%;">
              <a href="{{ route('product.details', $banner->slug) }}"><img class="banner-img"
                  src="{{ asset($banner->image) }}" alt=""></a>
            </div>
            @else
            <div class="item" style="width: 100%;">
              <a href="{{ route('product.details', $banner->slug) }}"><img class="banner-img"
                  src="{{ asset($banner->image) }}" alt=""></a>
            </div>
            @endif
            @endforeach
          </div>
          <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
  </div>

  <style>
    .image_container{
      height: 242px;
      width: 100%;
    }
    .image_container:nth-child(1){
      margin-bottom: 1.5rem;
    }
    /* .image_container:nth-child(2){
      margin-bottom: 2.5rem;
    } */
    .image_container img{
      height: 100%;
      width: 100%;
      object-fit: fit;
    }
  </style>
  <div class="col-md-4">
    <div class="row">
      @foreach ($sideBanner as $item)
      <div class="col-md-12 mb-2">
        <div class="promo-banner">
          <div class="image_container">
            <a href="{{ route('product.details', $item->slug) }}">
              <img src="{{ asset($item->banner_img) }}" width="100%" alt="{{ $item->banner_img }}"></a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>


@if (count($newproducts) > 0)
<div class="container">
  <div class="section-header">
    <h2>Products</h2>
  </div>
    @foreach ($newproducts as $value)
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6 " style="margin-bottom: 10px; height: 400px!important;">
            <div class="product-card" style="height: 100%;width: 90%; margin: auto;">
                <div class="product-container">
                    <div class="content">
                        <p style="float: right;margin-top: -15px;">
                            @if($value->quantity > 0)
                                <span class="ps-shoe__price"
                                      style="font-size: 10px;background: #8b75b3; padding: 2px; border-radius: 4px; color: #fff"><strong>Available</strong></span>
                            @else
                                <span class="ps-shoe__price"
                                      style="font-size: 10px;background: red; padding: 2px; border-radius: 4px; color: #fff;"><strong>Out of stock</strong></span>
                            @endif
                        </p>
                        <div class="content-overlay"></div>
                        <img style="height: 200px!important; max-width: 200px!important;" class="content-image"
                             src="{{ asset($value->thumbnail_image) }}" alt="{{ $value->name }}">
                        @if($value->quantity > 0 && $value->price > 0)
                            <div class="content-details fadeIn-top" style="margin-top: -50px;">
                                <a class="btn btn-success add-to-cart" data-id="{{ $value->id }}"><i class="fa fa-shopping-cart"></i> Add To Cart</a>
                            </div>
                        @endif
                        <div class="content-details fadeIn-bottom">
                            <a class="btn btn-success" href="{{ route('product.details', $value->slug) }}"><i class="fa fa-tasks"></i> See Details</a>
                        </div>
                    </div>
                </div>
                <div style="float: left;">
                <hr>
                    <p>
                        <a style="font-weight: bold; font-size: small; color: black;"
                           href="{{ route('product.details', $value->slug) }}">{{ $value->name }}</a>
                    </p>


                    @if($value->price > 0)
                        <h6 style="font-weight: bold; text-align: center; color: #005caf;">{{ $value->price }} Tk.</h6>
                    @else
                        <span style="font-weight: bold; color: #005caf;">Call for price</span>
                    @endif

                </div>
            </div>
        </div>
    @endforeach
{{--  <div class="owl-carousel">--}}
{{--   @include('components.product-card',  $products)--}}

{{--  </div>--}}
</div>
@endif

<br>
<br>


{{--<div class="container">--}}
{{--  <div class="section-header">--}}
{{--    <h2>Shop By Department</h2>--}}
{{--  </div>--}}
{{--  <div class="owl-carousel">--}}
{{--    @foreach($home_category as $h_category)--}}
{{--    <span style="    display: block; text-align: center;">--}}
{{--      <img src="{{ asset($h_category['image']) }}" style="width: 50px; height: 50px; margin: auto;" alt="">--}}
{{--      <a href="{{ route('product', ['category'=> $h_category['slug']]) }}">{{ $h_category['name'] }}</a>--}}
{{--    </span>--}}

{{--    --}}{{-- <a href="{{ /*route('product', ['category'=> $h_category['slug']])*/ '#' }}">{{ $h_category['name'] }}</a> --}}
{{--    @endforeach--}}

{{--  </div>--}}
{{--</div>--}}
{{--<br>--}}
{{--<br>--}}


{{--@if (count($bestsels) > 0)--}}
{{--<div class="container">--}}
{{--  <div class="section-header">--}}
{{--    <h2>Best Seller</h2>--}}
{{--  </div>--}}
{{--  <div class="owl-carousel">--}}
{{--      @include('components.product-card',  $bestsels)--}}


{{--  </div>--}}
{{--</div>--}}
{{--@endif--}}

{{--<br>--}}
{{--<br>--}}

{{--@if (count($newproducts) > 0)--}}
{{--<div class="container">--}}
{{--  <div class="section-header">--}}
{{--    <h2>New Arrivals</h2>--}}
{{--  </div>--}}
{{--  <div class="owl-carousel">--}}
{{--    @include('components.product-card',  $newproducts)--}}
{{--  </div>--}}
{{--</div>--}}
{{--@endif--}}

{{--<br>--}}
{{--<br>--}}

{{--<div class="container">--}}
{{--  <div class="section-header">--}}
{{--    <h2>Shop By Brands</h2>--}}
{{--  </div>--}}
{{--  <div class="owl-carousel">--}}
{{--    @foreach($home_brands as $h_brand)--}}
{{--    <span style="    display: block; text-align: center;">--}}
{{--      <img src="{{ asset($h_brand['image']) }}" style="width: 50px; height: 50px; margin: auto;" alt="">--}}
{{--      <a href="{{ route('product', ['brand'=> $h_brand['slug']]) }}">{{ $h_brand['name'] }}</a>--}}
{{--    </span>--}}
{{--    @endforeach--}}

{{--  </div>--}}
{{--</div>--}}

<br>
<br>


@if (count($special_discounts) > 0)
<div class="container" id="Clearance_Sell">
  <div class="section-header">
    <h2>Clearance Sale</h2>
  </div>
  <div class="owl-carousel">
    @include('components.product-card',  $special_discounts)

  </div>
</div>
@endif

{{--<br>--}}
{{--<br>--}}


{{--@if (count($special_discounts) > 0)--}}
{{--<div class="container" id="special_discount">--}}
{{--  <div class="section-header">--}}
{{--    <h2>Special Discount</h2>--}}
{{--  </div>--}}
{{--  <div class="owl-carousel">--}}
{{--    @foreach ($special_discounts as $value)--}}
{{--    <div>--}}
{{--      <div style="max-width: 200px; max-height: 200px; margin: auto;">--}}
{{--        <div class="product-container">--}}
{{--          <div class="content">--}}
{{--            <div class="content-overlay"></div>--}}
{{--            <img style="height: 200px!important; max-width: 200px!important;" class="content-image"--}}
{{--              src="{{ asset($value->thumbnail_image) }}">--}}
{{--            @if($value->quantity > 0 && $value->price > 0)--}}
{{--            <div class="content-details fadeIn-top" style="margin-top: -50px;">--}}
{{--              <a class="btn btn-success add-to-cart" data-id="{{ $value->id }}"><i class="fa fa-shopping-cart"></i> Add--}}
{{--                To Cart</a>--}}
{{--            </div>--}}
{{--            @endif--}}
{{--            <div class="content-details fadeIn-bottom">--}}
{{--              <a class="btn btn-success" href="{{ route('product.details', $value->slug) }}"><i class="fa fa-tasks"></i>--}}
{{--                See Details</a>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--        <div style="float: left;">--}}
{{--          <p class="product-name">--}}
{{--            <a style="font-weight: bold; font-size: larger; color: black;"--}}
{{--              href="{{ route('product.details', $value->slug) }}">{{ (strlen($value->name) > 20 ) ? substr($value->name, 0, 20).'...' : $value->name }}</a>--}}
{{--          </p>--}}
{{--          <p style="margin: 0px;margin-top: -10px;">--}}
{{--            @if($value->quantity > 0)--}}
{{--            <span class="ps-shoe__price" style="font-size: 10px; color: #005caf"><strong>Available</strong></span>--}}
{{--            @else--}}
{{--            <span class="ps-shoe__price" style="font-size: 10px; color: red;"><strong>Out of stock</strong></span>--}}
{{--            @endif--}}
{{--          </p>--}}
{{--          @if($value->price > 0)--}}
{{--          <span style="font-weight: bold; color: #005caf;">Call for price</span>--}}
{{--          @else--}}
{{--          <span style="font-weight: bold; color: #005caf;">Call for price</span>--}}
{{--          @endif--}}

{{--        </div>--}}
{{--      </div>--}}
{{--    </div>--}}
{{--    @endforeach--}}

{{--  </div>--}}
{{--</div>--}}
{{--@endif--}}


{{--<br>--}}


{{--<br><br>--}}
{{--@if (count($clients)>0)--}}
{{--<div class="container">--}}
{{--  <div class="section-header">--}}
{{--    <h2>Top Clients</h2>--}}
{{--  </div>--}}
{{--  <div class="client_carousel">--}}

{{--    @foreach($clients as $client)--}}
{{--      <span style="display: block; text-align: center;">--}}
{{--        <img src="{{ asset($client->logo) }}" style="width: 50%; height: 50%; margin: auto;" alt="">--}}
{{--        <a href="{{ $client->url }}">{{ $client->name }}</a>--}}
{{--      </span>--}}
{{--    --}}{{-- <a href="{{ /*route('product', ['category'=> $h_category['slug']])*/ '#' }}">{{ $h_category['name'] }}</a> --}}
{{--    @endforeach--}}

{{--  </div>--}}
{{--</div>--}}
{{--@endif--}}







@endsection

@section('script')

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
  src="{{ asset("assets/frontend/plugins/revolution/js/jquery.themepunch.tools.min.js") }}"></script>
<script type="text/javascript"
  src="{{ asset("assets/frontend/plugins/revolution/js/jquery.themepunch.revolution.min.js") }}"></script>
<script type="text/javascript"
  src="{{ asset("assets/frontend/plugins/revolution/js/extensions/revolution.extension.video.min.js") }}"></script>
<script type="text/javascript"
  src="{{ asset("assets/frontend/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js") }}"></script>
<script type="text/javascript"
  src="{{ asset("assets/frontend/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js") }}">
</script>
<script type="text/javascript"
  src="{{ asset("assets/frontend/plugins/revolution/js/extensions/revolution.extension.navigation.min.js") }}"></script>
<script type="text/javascript"
  src="{{ asset("assets/frontend/plugins/revolution/js/extensions/revolution.extension.parallax.min.js") }}"></script>
<script type="text/javascript"
  src="{{ asset("assets/frontend/plugins/revolution/js/extensions/revolution.extension.actions.min.js") }}"></script>

<script src="{{ asset('assets/frontend/js/sweetalert2.js') }}"></script>




<script>
  $(function () {
      $('#dl-menu').dlmenu({
        animationClasses: {classin: 'dl-animate-in-3', classout: 'dl-animate-out-3'}
      });
    });
</script>

<script>
  $(window).load(function () {
      $("#header").sticky({topSpacing: 0});
    });
</script>

<script>
  $('.owl-carousel').owlCarousel({
        rtl:false,
        loop:false,
        dots:false,
        margin:10,
        nav:true,
        navText: ["<i class='fa fa-arrow-left' aria-hidden='true'></i> Prev", "Next <i class='fa fa-arrow-right' aria-hidden='true'></i>"],
        // navContainer: ".section-header",
        responsive:{
            0:{
                items:2
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
      }
    });
  $('.client_carousel').owlCarousel({
        rtl:false,
        loop:true,
        dots:false,
        margin:10,
        autoplay:true,
        autoplayTimeout:1000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:2
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
      }
    });



    $(document).ready(function(){
      $('#clients-carousel').owlCarousel({
        autoplay: true,
        autoplayTimeout: 6000,
        loop:true,
        dots:true,
        margin:10,
        nav:false,
        // navText: ["<i class='fa fa-arrow-left' aria-hidden='true'></i> Prev", "Next <i class='fa fa-arrow-right' aria-hidden='true'></i>"],
        // navContainer: ".section-header",
        responsive:{
            0:{
                items:2
            },
            600:{
                items:3
            },
            1000:{
                items:5
            }
      }
    });
    });



    // var carouselEl = $('.owl-carousel');



    // $(".my-next-button").click(function() {
    //     carouselEl.trigger('next.owl.carousel');
    // });

    // $(".my-previous-button").click(function() {
    //     carouselEl.trigger('prev.owl.carousel');
    // });



</script>

@endsection
