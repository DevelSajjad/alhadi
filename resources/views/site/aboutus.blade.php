@extends('layouts.frontend_layout')

@section('stylesheet')
  <style>
    .page_title{
      font-size: 50px;
      font-weight: 500;
      font-family: fantasy;
      text-decoration: underline;
      color: #8B75B3;
    }
    .mt-40 {
      margin-top: 40px;
    }

  </style>
@endsection

@section('content')
  <div class="ps-section--features-product ps-section masonry-root pt-100 pb-100">
    <div class="ps-container">
      <div class="row">
        <div class="col-12 text-center mb-40">
          <span class="page_title">About Us</span>
        </div>
        <div class="col-md-12 mb-40">
          {{-- <h3>About Al - Hadi Express Ltd.</h3> --}}
          <p> {{ __('Al - Hadi Express is the largest one-stop shopping destination in Bangladesh. Launched in 2022, the online store offers the widest range of products in categories ranging from Electronics to household appliances, latest Smartphones, Camera, Computing & Accessories and Mobile Accessories and Networking Devices.

            Al - Hadi Express believes in “Delivering Happiness” with an excellent customer experience thus provides the most efficient delivery service through own logistics so that customers get a hassle-free product delivery at their doorstep. We help our local and international vendors as well as 200 brands serving thousands of consumers from all over Bangladesh. We also offer free returns and various payment methods including Cash on delivery, Online Payments, Card on delivery with all of our products.
            
            ') }} <a style="color: #8B75B3" href="{{route('home')}}"> Happy Online Shopping!</a> </p>
        </div>
        <div class="col-md-12 text-center mb-40">
          <span class="page_title"> {{ __('Our Mission')}} </span>
          <p class="mt-40"> {{ __('Our mission is to empower individuals and businesses by offering a curated selection of high-quality electronics that enhance and simplify everyday life. We believe in the transformative power of technology and strive to make it accessible to everyone..') }}</p>
        </div>

        <div class="col-md-12 text-center mb-40">
          <span class="page_title"> {{ __('Make the right choice')}} </span>
          <ul class="mt-40">
            <li>Ultimate one-stop shopping experience in Bangladesh</li>
            <li>Most trusted online shopping platform</li>
            <li>Wide selection of the best local and foreign brands</li>
            <li>Fastest Delivery service</li>
            <li>Genuine and authentic products</li>
          </ul>
        </div>

        <div class="col-md-12 text-center mb-40">
          <span class="page_title"> {{ __('Customer-Centric Approach')}} </span>
          <p class="mt-40"> {{ __('At Al - Hadi Express, customer satisfaction is at the core of everything we do. We are committed to delivering exceptional service, prompt support, and a seamless shopping experience. Your trust is our greatest reward.') }} </p>
        </div>
{{--        <div class="col-md-6 col-lg-6 col-xl-6 col-md-offset-3 col-lg-offset-3 col-xl-offset-3">--}}
{{--          <div class="row">--}}
{{--            <div class="col-md-6 col-lg-6 col-xl-6 text-center">--}}
{{--              <img src="{{ asset('assets/images/samrat_sarker.jpg') }}" alt="Managing Partner"><br>--}}
{{--              <p>Managing Partner</p>--}}
{{--            </div>--}}
{{--            <div class="col-md-6 col-lg-6 col-xl-6 text-center">--}}
{{--              <img src="{{ asset('assets/images/sankar_sarker.jpg') }}" alt="Partner"><br>--}}
{{--              <p>Partner</p>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--        </div>--}}
      </div>
{{--      <div class="row mt-20">--}}
{{--        <div class="col-12">--}}
{{--          <p>AL Hadi Enterprise</p>--}}
{{--          <p>We have our own factory where we produce Local musical Instruments; Like Harmonium, Tabla & Baya, Acoustic Guitar, etc. We are sole distributor of world renowned brands like Fernandes, Sterling by Musicman, Paiste, D'Addario, M-Audio, RME, Focusrite, MOTU, Casio, Rode, Neutrik, MusicMan, Erneiball, Sennheiser, Rode ,Stranger, JBL, Sound Craft, Crown, Lexicon, Dbx, Seer Audio, CVR Audio and many others.</p>--}}
{{--          <p>Through the experience accumulated, we are evolved dealing with traditional acoustic instruments to modern musical instruments. In a word you can say "A complete music solution". We are serving our music industry with a network of 4 show rooms in different places in the capital city "Dhaka" and appointed franchises around the other cities to serve whole country.</p>--}}
{{--          <p>Now we can proudly say "First to AL Hadi Enterprise".</p>--}}
{{--        </div>--}}
{{--      </div>--}}
    </div>
  </div>
@endsection

@section('script')

@endsection

