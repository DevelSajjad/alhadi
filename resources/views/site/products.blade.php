@extends('layouts.frontend_layout')

@section('stylesheet')

  <link rel="stylesheet" href="{{ asset("assets/frontend/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css") }}">
  <link rel="stylesheet" href="{{ asset("assets/frontend/plugins/slick/slick/slick.css") }}">
  <link rel="stylesheet" href="{{ asset("assets/frontend/plugins/bootstrap-select/dist/css/bootstrap-select.min.css") }}">
  <link rel="stylesheet" href="{{ asset("assets/frontend/plugins/Magnific-Popup/dist/magnific-popup.css") }}">
  <link rel="stylesheet" href="{{ asset("assets/frontend/plugins/jquery-ui/jquery-ui.min.css") }}">
<link rel="stylesheet" href="{{ asset("assets/frontend/plugins/owl-carousel/assets/owl.carousel.css") }}">
@endsection
<style type="text/css">
  @media (max-width: 767px)
  {
   .owl-carousel .owl-item img{
    height:50px;
    width: 50px;
   }
   .owl-item{
    width: auto !important;
   }
   .ps-shoe__thumbnail img{
    display: block;
    margin-left: auto;
    margin-right: auto;
   }
  }
  .owl-carousel .owl-item img{
    height:50px;
    width: auto !important;
   }
  @media (max-width: 767px)
  {
    .ps-shoe__variants
    {
      visibility: visible !important;
      opacity: 1 !important;
      transform: translateY(0) !important;
    }


    .ps-shoe__content
    {
      padding-top: 100px !important;
      bottom: -100px !important; /*-90px*/
      max-height: none !important;
    }
    .ps-shoe__favorite
    {
      transform: scale(1, 1) !important;
    }
  }
    /* Price Range */
    .slidecontainer {
        width: 100%;
    }

    .slider {
        -webkit-appearance: none;
        width: 100%;
        height: 15px;
        background: #d3d3d3;

    }

    .slider:hover {
        opacity: 1;
    }

    .slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 25px;
        height: 15px;
        background: #8b75b3;
        cursor: pointer;
    }

    .slider::-moz-range-thumb {
        width: 25px;
        height: 15px;
        background: #8b75b3;
        cursor: pointer;
    }

    /* style product card responsive */
    @media(min-width:350px) and (max-width: 650px){
        .content{
            margin-left: 55px;
        }
        .product-info-container{
            margin-left: 118px;
            border-top: 1px solid lightgray;
        }
    }
</style>
@section('content')
    <div class="container">
        <form action="" method="get" >
            <div class="row">
                <div class="col-md-3">
                    <select name="category" id="category">
                        <option value="">Choose</option>
                        @foreach(\App\Category::select('name','slug')->get() as $value)
                        <option value="{{ $value->slug }}" @selected(request('category') == $value->slug)>{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="subCategory" id="subCategory">
                        <option value="">Choose sub-category</option>
                        @foreach(\App\SubCategory::select('name','slug')->get() as $value)
                            <option value="{{ $value->slug }}" @selected(request('subCategory') == $value->slug)>{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="brand" id="brand-select">
                        <option value="">Choose brand</option>
                        @foreach(\App\Brand::select('name','slug')->get() as $value)
                            <option value="{{ $value->slug }}" @selected(request('brand') == $value->slug)>{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button class="btn" type="submit" >Filter</button>

                </div>
            </div>
        </form>
    </div>
   @if (count($products) > 0)
    <div class="container">
        <div class="section-header">
            <h1>
                <span  style="background: #8b75b3; border-radius: 3px;color: #fff; margin: 5px;">
                @if(isset($request->category))
                        <?php
                        $cat = \App\Category::where('slug', $request->category)->first();
                        ?>
                    @if(isset($cat))
                        {{ $cat->name }}
                    @endif
                @endif
</span><span  style="background: #8b75b3; border-radius: 3px;color: #fff; margin: 5px;">
                @if(isset($request->sub_category))
                        <?php
                        $subCat = \App\SubCategory::where('slug', $request->sub_category)->first();
                        ?>
                    @if(isset($subCat))
                        {{$subCat->name }}
                    @endif
                @endif
</span><span  style="background: #8b75b3; border-radius: 3px;color: #fff; margin: 5px;">
                @if(isset($request->brand))
                        <?php
                        $mBrand = \App\Brand::where('slug', $request->brand)->first();
                        ?>
                    @if(isset($mBrand))
                        {{$mBrand->name }}
                    @endif
                @endif
                @if(isset($request->search))
                    {{--            @if(isset($mBrand))--}}
                    {{ $request->search }}
                    {{--@endif--}}
                @endif
                </span>
            </h1>

        </div>
        <div class="row">
            <div class="col-md-3 row">
                <div class="col-md-12" >
                    <div class="card" style="background: #fff;">
                            <h1 style="font-size: 14px;">Price range</h1>
                        <div class="slidecontainer">
                            <input type="range" min="0" max="100000" value="0" class="slider" id="myRange">
                            <p style="float: left;">Min: 0</p>
                            <p style="float: right;">Max: <span id="demo"></span></p>
                        </div>

                    </div>
                </div>
                <div class="col-md-12" >
                    <div class="card" style="background: #fff;">
                        <div class="slidecontainer">
                        <h1 style="font-size: 16px; text-align: center">Category</h1>
                            @foreach(\App\Category::select('name','slug')->get() as $value)
                            <input type="radio" name="category" @selected(request('brand') == $value->slug) value="{{ $value->name }}"> {{ $value->name }}<br>
                            @endforeach
                        </div>

                    </div>                </div>
                <div class="col-md-12" >
                    <div class="card" style="background: #fff;">
                        <div class="slidecontainer">
                            <h1 style="font-size: 16px; text-align: center">Brand</h1>
                            @foreach(\App\Brand::select('name','slug')->get() as $value)
                            <input type="radio" name="brand" value="{{ $value->slug }}" @selected(request('brand') == $value->slug)"> {{ $value->name }} <br>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>


            <div class="col-md-9 row">

                @foreach ($products as $value)
                    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 col-6 " style="margin-bottom: 10px; height: 370px!important;">
                        <div class="product-card" style="height: 100%;width: 110%; margin: auto;">
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
                                    <div class="d-flex justify-align-center">
                                        <img style="height: 150px!important; max-width: 150px!important;" class="content-image mx-auto"
                                         src="{{ asset($value->thumbnail_image) }}" alt="{{ $value->name }}">
                                    </div>
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
                            <div style="float: left; text-align:center" class="product-info-container">
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
                    </div>        @endforeach
            </div>
        </div>

      <div class="shop_toolbar t_bottom">
            <div class="pagination">
              <ul>
                {!! $products->links() !!}
              </ul>
            </div>
          </div>
    </div>

  @endif
@endsection

@section('script')

  <script type="text/javascript" src="{{ asset("assets/frontend/plugins/gmap3.min.js") }}"></script>
  <script type="text/javascript" src="{{ asset("assets/frontend/plugins/imagesloaded.pkgd.js") }}"></script>
  <script type="text/javascript" src="{{ asset("assets/frontend/plugins/isotope.pkgd.min.js") }}"></script>
  <script type="text/javascript" src="{{ asset("assets/frontend/plugins/bootstrap-select/dist/js/bootstrap-select.min.js") }}"></script>
  <script type="text/javascript" src="{{ asset("assets/frontend/plugins/jquery.matchHeight-min.js") }}"></script>
  <script type="text/javascript" src="{{ asset("assets/frontend/plugins/slick/slick/slick.min.js") }}"></script>
  <script type="text/javascript" src="{{ asset("assets/frontend/plugins/elevatezoom/jquery.elevatezoom.js") }}"></script>
  <script type="text/javascript" src="{{ asset("assets/frontend/plugins/Magnific-Popup/dist/jquery.magnific-popup.min.js") }}"></script>
  <script type="text/javascript" src="{{ asset("assets/frontend/plugins/jquery-ui/jquery-ui.min.js") }}"></script>
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAx39JFH5nhxze1ZydH-Kl8xXM3OK4fvcg&amp;region=GB"></script><script type="text/javascript" src="{{ asset("assets/frontend/plugins/revolution/js/jquery.themepunch.tools.min.js") }}"></script>
  <script type="text/javascript" src="{{ asset("assets/frontend/plugins/revolution/js/jquery.themepunch.revolution.min.js") }}"></script>
  <script type="text/javascript" src="{{ asset("assets/frontend/plugins/revolution/js/extensions/revolution.extension.video.min.js") }}"></script>
  <script type="text/javascript" src="{{ asset("assets/frontend/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js") }}"></script>
  <script type="text/javascript" src="{{ asset("assets/frontend/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js") }}"></script>
  <script type="text/javascript" src="{{ asset("assets/frontend/plugins/revolution/js/extensions/revolution.extension.navigation.min.js") }}"></script>
  <script type="text/javascript" src="{{ asset("assets/frontend/plugins/revolution/js/extensions/revolution.extension.parallax.min.js") }}"></script>
  <script type="text/javascript" src="{{ asset("assets/frontend/plugins/revolution/js/extensions/revolution.extension.actions.min.js") }}"></script>

  <script type="text/javascript">
    //test for touch events support and if not supported, attach .no-touch class to the HTML tag.

if (!("ontouchstart" in document.documentElement)) {
document.documentElement.className += " no-touch";
}
  </script>
<script type="text/javascript">
 var xx = document.getElementsByClassName("grid-item");
$( "xx" ).last().offset({ top: "100px", left: "30px" });



 $('#category').change(function () {
    const $this = $('select[name="subCategory"]')
     var catslug = this.value;
     $this.html('');
     $.ajax({
         url: "{{url('subcat-api')}}/" + catslug,
         type: "GET",
         dataType: 'json',
         success: function (result) {
             $this.html('<option value="">-- Select District --</option>');
             $.each(result.subcategory, function (key, value) {
                 $this.append('<option value="' + value
                     .slug + '">' + value.name + '</option>');
             });
             $("#brand-select").html('');
             $('#brand-select').html('<option value="">-- Select Brand --</option>');
         }
     });
 });


 $('#subCategory').change(function () {
     var brandslug = this.value;
     console.log(brandslug)
     $("#brand-select").html('');
     $.ajax({
         url: "{{url('brand-api')}}/" + brandslug,
         type: "GET",
         dataType: 'json',
         success: function (res) {
             console.log(res)
             $('#brand-select').html('<option value="">-- Select Brand --</option>');
             $.each(res.brand, function (key, value) {
                 console.log(value)
                 $("#brand-select").append('<option value="' + value
                     .slug + '">' + value.name + '</option>');
             });
         }
     });
 });

      //Price range

      var slider = document.getElementById("myRange");
      var output = document.getElementById("demo");
      output.innerHTML = slider.value;

      slider.oninput = function() {
          output.innerHTML = this.value;
      }
  </script>
@endsection


