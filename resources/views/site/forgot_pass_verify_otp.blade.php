@extends('layouts.frontend_layout')

@section('stylesheet')
  <style>
    .page_title{
      font-size: 35px;
      font-weight: 500;
      font-family: fantasy;
    }
    .shadow{
      border: 1px solid;
      padding: 20px;
      border-color: burlywood;
      border-radius: 20px;
      box-shadow: 5px 10px #888888;
      background: white;
    }
    body{
      font-size: 13px;
    }
    .form-control{
      font-size: 13px;
      height: 40px;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      /* display: none; <- Crashes Chrome on hover */
      -webkit-appearance: none;
      margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
    }

    input[type=number] {
      -moz-appearance:textfield; /* Firefox */
    }
  </style>
@endsection

@section('content')
  <div class="ps-section--features-product ps-section masonry-root pt-100 pb-100">
    <div class="ps-container">
      <div class="row">
        <div class="col-md-6 col-lg-6 col-xl-6 col-md-offset-3 col-lg-offset-3 col-xl-offset-3">
          <div class="row shadow">
            <div class="col-12 text-center mb-40">
              <span class="page_title">Verify OTP</span>
            </div>
            @if(session()->has('status'))
              {!! session()->get('status') !!}
            @endif
            <div class="col-12">
              <form action="{{ route('verify.forgotPasswordOTP') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="">OTP</label><br>
                  <input type="number" name="otp" placeholder="Enter your otp" required value="{{ old('otp') }}" class="form-control @error('otp') is-invalid @enderror">
                  @error('otp')
                  <strong class="text-danger">{{ $errors->first('otp') }}</strong>
                  @enderror
                </div>
                <div class="form-group text-right">
                  {{--<button type="button" class="btn btn-success btn-lg">Resend</button>--}}
                  <button type="submit" class="btn btn-success btn-sm">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')

@endsection


{{--<form class="ps-product__review" action="_action" method="post">--}}
{{--<h4>ADD YOUR REVIEW</h4>--}}
{{--<div class="row">--}}
{{--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">--}}
{{--<div class="form-group">--}}
{{--<label>Name:<span>*</span></label>--}}
{{--<input class="form-control" type="text" placeholder="">--}}
{{--</div>--}}
{{--<div class="form-group">--}}
{{--<label>Email:<span>*</span></label>--}}
{{--<input class="form-control" type="email" placeholder="">--}}
{{--</div>--}}
{{--<div class="form-group">--}}
{{--<label>Your rating<span></span></label>--}}
{{--<div class="br-wrapper br-theme-fontawesome-stars"><select class="ps-rating" style="display: none;">--}}
{{--<option value="1">1</option>--}}
{{--<option value="1">2</option>--}}
{{--<option value="1">3</option>--}}
{{--<option value="1">4</option>--}}
{{--<option value="5">5</option>--}}
{{--</select><div class="br-widget"><a href="#" data-rating-value="1" data-rating-text="1" class="br-selected br-current"></a><a href="#" data-rating-value="1" data-rating-text="2" class="br-selected br-current"></a><a href="#" data-rating-value="1" data-rating-text="3" class="br-selected br-current"></a><a href="#" data-rating-value="1" data-rating-text="4" class="br-selected br-current"></a><a href="#" data-rating-value="5" data-rating-text="5"></a><div class="br-current-rating">1</div></div></div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 ">--}}
{{--<div class="form-group">--}}
{{--<label>Your Review:</label>--}}
{{--<textarea class="form-control" rows="6"></textarea>--}}
{{--</div>--}}
{{--<div class="form-group">--}}
{{--<button class="ps-btn ps-btn--sm">Submit<i class="ps-icon-next"></i></button>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</form>--}}

