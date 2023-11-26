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
  </style>
@endsection

@section('content')
  <div class="ps-section--features-product ps-section masonry-root pt-100 pb-100">
    <div class="ps-container">
      <div class="row">
        <div class="col-md-6 col-lg-6 col-xl-6 col-md-offset-3 col-lg-offset-3 col-xl-offset-3">
          <div class="row shadow">
            <div class="col-12 text-center mb-40">
              <span class="page_title">Reset Password</span>
            </div>
            @if(session()->has('status'))
              {!! session()->get('status') !!}
            @endif
            <div class="col-12">
              <form action="{{ route('resetPassword') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="">New Password</label><br>
                  <input type="password" name="password" placeholder="Enter your new password" required value="{{ old('password') }}" class="form-control @error('password') is-invalid @enderror">
                  @error('password')
                  <strong class="text-danger">{{ $errors->first('password') }}</strong>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="">Confirm Password</label><br>
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
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')

@endsection
