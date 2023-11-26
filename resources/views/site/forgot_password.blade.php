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
              <span class="page_title">Forgot Password</span>
            </div>
            @if(session()->has('status'))
              {!! session()->get('status') !!}
            @endif
            <div class="col-12">
              <form action="{{ route('forgotPassword') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="">Mobile No</label><br>
                  <input type="number" name="mobile_no" placeholder="Enter your mobile no" required value="{{ old('mobile_no') }}" class="form-control @error('mobile_no') is-invalid @enderror">
                  @error('mobile_no')
                    <strong class="text-danger">{{ $errors->first('mobile_no') }}</strong>
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


