@extends('layouts.customer_layout')

@section('customer.stylesheet')
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
    </style>
@endsection

@section('customer.content')
  <div class="row">
    <div class="col-12 text-center text-sm">
      <span class="page_title">Update Profile/Address</span>
    </div>
    <div class="col-12 card" style="margin: 10px; padding: 20px">
      <div class="row">
        <div class="col-12">
          @if(session()->has('status'))
            {!! session()->get('status') !!}
          @endif
        </div>
      </div>
      <form action="{{ route('customer.updateProfile') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="" style="margin-left: 10px;">


          <div class="col-md-6 col-lg-6 col-xl-6">
            <div class="form-group">
              <label for="">Name <span class="h4" style="color: #ff0500;">*</span></label><br>
              <input type="text" name="name" placeholder="Enter your name" required value="{{ auth()->user()->name }}" class="form-control @error('name') is-invalid @enderror">
              @error('name')
              <strong class="text-danger">{{ $errors->first('name') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-6">
            <div class="form-group">
              <label for="">Mobile No <span class="h4" style="color: #ff0500;">*</span></label><br>
              <input type="number" name="mobile_no" placeholder="Enter your mobile no" required readonly value="{{ auth()->user()->mobile_no }}" class="form-control @error('mobile_no') is-invalid @enderror">
              @error('mobile_no')
              <strong class="text-danger">{{ $errors->first('mobile_no') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="form-group">
              <label for="">Address</label><br>
              {{--<input type="email" name="email" placeholder="Enter your email" value="{{ auth()->user()->email }}" class="form-control @error('email') is-invalid @enderror">--}}
              <textarea name="address" id="" cols="30" rows="3" class="form-control">{{ auth()->user()->address }}</textarea>
              @error('address')
              <strong class="text-danger">{{ $errors->first('address') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-6">
          {{--<div class="col-md-12 col-lg-12 col-xl-12">--}}
            <div class="form-group">
              <label for="">Email</label><br>
              <input type="email" name="email" placeholder="Enter your email" value="{{ auth()->user()->email }}" class="form-control @error('email') is-invalid @enderror">
              @error('email')
              <strong class="text-danger">{{ $errors->first('email') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-6">
            <img src="{{ asset(auth()->user()->image) }}" alt="" style="max-height: 250px; min-height: 250px">
          </div>
          <div class="col-md-6 col-lg-6 col-xl-6">
            <div class="form-group">
              <label for="">Image</label><br>
              <input type="file" name="image" placeholder="Enter your Image" class="form-control @error('image') is-invalid @enderror">
              @error('image')
              <strong class="text-danger">{{ $errors->first('image') }}</strong>
              @enderror
            </div>
          </div>
          <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="form-group text-right">
              {{--<button type="button" class="btn btn-success btn-lg">Resend</button>--}}
              <button type="submit" class="btn btn-success btn-">Submit</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('customer.script')

@endsection
