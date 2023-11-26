@extends('layouts.customer_layout')

@section('customer.stylesheet')
  <style>
    .page_title{
      font-size: 35px;
      font-weight: 500;
      font-family: fantasy;
    }
    .card{
      background-color: white;
      padding: 10px;
      border-radius: 5px;
      box-shadow: 0 4px 4px 4px #cbb5b6;
      min-height: 50px;
        display: block !important;
    }
    label{
      color: #005caf;
    }
    body{
      font-size: 13px;
    }
    .form-control{
      font-size: 13px;
      height: 40px;
    }
  </style>
@endsection

@section('customer.content')
  <div class="row">
    <div class="col-12 text-center mb-40">
      <span class="page_title">Update Profile</span>
    </div>
    <div class="col-12 card" style="margin: 10px; padding: 20px">
      <div class="row">
        <div class="col-12">
          @if(session()->has('status'))
            {!! session()->get('status') !!}
          @endif
        </div>
      </div>
      <form action="{{ route('customer.changePassword') }}" method="post">
        @csrf
        <div class="form-group">
          <label for="">Old Password <span class="h4" style="color: #ff0500;">*</span></label><br>
          <input type="password" name="old_password" placeholder="Enter your old password" required value="{{ old('old_password') }}" class="form-control @error('old_password') is-invalid @enderror">
          @error('old_password')
          <strong class="text-danger">{{ $errors->first('old_password') }}</strong>
          @enderror
        </div>
        <div class="form-group">
          <label for="">New Password <span class="h4" style="color: #ff0500;">*</span></label><br>
          <input type="password" name="new_password" placeholder="Enter your new password" required value="{{ old('new_password') }}" class="form-control @error('new_password') is-invalid @enderror">
          @error('new_password')
          <strong class="text-danger">{{ $errors->first('new_password') }}</strong>
          @enderror
        </div>
        <div class="form-group">
          <label for="">Confirm Password <span class="h4" style="color: #ff0500;">*</span></label><br>
          <input type="password" name="confirm_password" placeholder="Enter your confirm password" required value="{{ old('confirm_password') }}" class="form-control @error('confirm_password') is-invalid @enderror">
          @error('confirm_password')
          <strong class="text-danger">{{ $errors->first('confirm_password') }}</strong>
          @enderror
        </div>
        <div class="form-group text-right">
          {{--<button type="button" class="btn btn-success btn-lg">Resend</button>--}}
          <button style="background-color: #005caf; color: white;" type="submit" class="btn btn-sm">Submit</button>
        </div>
      </form>
    </div>
  </div>
@endsection

@section('customer.script')

@endsection
