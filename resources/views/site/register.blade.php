@extends('layouts.frontend_layout')

@section('stylesheet')
  <style>
    .page_title{
      font-size: 35px;
      font-weight: 500;
      font-family: fantasy;
    }
    .shadow{
      /*border: 1px solid;*/
      padding: 20px;
      /*border-color: burlywood;*/
      border-radius: 10px;
      /*box-shadow: 5px 10px #888888;*/
      background: white;
    }
    body{
      font-size: 13px;
    }
    .form-control{
      font-size: 13px;
      height: 40px;
        background-color: #ffffff!important;
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
    input {
        border-radius:10px !important ;
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
              <span class="page_title">Registration</span>
            </div>

            @if(session()->has('status'))
              {!! session()->get('status') !!}
            @endif
            <div class="col-12">
              <form action="{{ route('registration') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="">Full Name <span class="h4" style="color: #ff0500;">*</span></label>
                  <input type="text" name="name" placeholder="Enter your full name" required value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror">
                  @error('name')
                  <strong class="text-danger">{{ $errors->first('name') }}</strong>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="">Email</label>
                  <input type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                  @error('email')
                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="">Mobile No <span class="h4" style="color: #ff0500;">*</span></label>
                  <input type="number" name="mobile_no" placeholder="Enter your mobile no" required value="{{ old('mobile_no') }}" class="form-control @error('mobile_no') is-invalid @enderror">
                  @error('mobile_no')
                  <strong class="text-danger">{{ $errors->first('mobile_no') }}</strong>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="">Password <span class="h4" style="color: #ff0500;">*</span></label>
                  <input type="password" name="password" placeholder="Enter your password" required value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror">
                  @error('password')
                  <strong class="text-danger">{{ $errors->first('password') }}</strong>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="">Confirm Password<span class="h4" style="color: #ff0500;">*</span></label>
                  <input type="password" name="confirm_password" placeholder="Enter your confirm password" required value="{{ old('confirm_password') }}" class="form-control @error('confirm_password') is-invalid @enderror">
                  @error('confirm_password')
                  <strong class="text-danger">{{ $errors->first('confirm_password') }}</strong>
                  @enderror
                </div>
                <div class="form-group text-right">
                  <span class="h6 mr-10">Already have an account? <a href="{{ route('login') }}">Login</a></span>
                  <button style="background-color: #8b75b3; color: white;" type="submit" class="btn btn-sm">Register</button>
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

