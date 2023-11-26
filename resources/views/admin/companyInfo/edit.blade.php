@extends('layouts.admin_layout')

@section('stylesheet')
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">

@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">Update Company Info</h1>
    </div>
    <div class="col-12">
      <div class="ms-panel">
        @include('flash_messages')
      </div>
      <div class="ms-panel">
        <div class="ms-panel-body">
          <form action="{{ route('admin.companyInfo.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $data->id }}">
            <div class="form-group">
              <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="company_name">Company Name</label>
                  <input type="text" id="company_name"  value="{{old('company_name', $data->company_name)}}" placeholder="Enter a Company name" name="company_name" class="form-control @error('company_name') is-invalid @enderror">
                  @error('company_name')
                    <strong class="text-danger">{{ $errors->first('company_name') }}</strong>
                  @enderror
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="address_one">Address </label>
                  <input type="text" id="address_one"  value="{{old('address_one', $data->address_one)}}" placeholder="Enter address" name="address_one" class="form-control @error('address_one') is-invalid @enderror">
                  @error('address_one')
                    <strong class="text-danger">{{ $errors->first('address_one') }}</strong>
                  @enderror
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="address_two">Address [2nd]</label>
                  <input type="text" id="address_two" value="{{old('address_two', $data->address_two)}}" placeholder="Enter second address" name="address_two" class="form-control @error('address_two') is-invalid @enderror" >
                  @error('address_two')
                  <strong class="text-danger">{{ $errors->first('address_two') }}</strong>
                  @enderror
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="email_one">Email</label>
                  <input type="email" id="email_one" value="{{old('email_one', $data->email_one)}}" placeholder="Enter email" name="email_one" class="form-control @error('email_one') is-invalid @enderror" >
                  @error('email_one')
                  <strong class="text-danger">{{ $errors->first('email_one') }}</strong>
                  @enderror
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="email_two">Email [2nd]</label>
                  <input type="email" id="email_two" value="{{old('email_two', $data->email_two)}}" placeholder="Enter second email" name="email_two" class="form-control @error('email_two') is-invalid @enderror" >
                  @error('email_two')
                  <strong class="text-danger">{{ $errors->first('email_two') }}</strong>
                  @enderror
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="phone_one">Phone</label>
                  <input type="text" id="phone_one" value="{{old('phone_one', $data->phone_one)}}" placeholder="Enter phone number" name="phone_one" class="form-control @error('phone_one') is-invalid @enderror" >
                  @error('phone_one')
                  <strong class="text-danger">{{ $errors->first('phone_one') }}</strong>
                  @enderror
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12 col-lg-3 col-xl-3">
                  <label for="phone_one">Phone [2nd]</label>
                  <input type="text" id="phone_two" value="{{old('phone_two', $data->phone_two)}}" placeholder="Enter second phone number" name="phone_two" class="form-control @error('phone_two') is-invalid @enderror" >
                  @error('phone_two')
                  <strong class="text-danger">{{ $errors->first('phone_two') }}</strong>
                  @enderror
                </div>

                <div class="col-md-12 col-lg-6 col-xl-6">
                  <label for="phone_one">Trade License</label>
                  <input type="text" id="trade_license" value="{{old('trade_license', $data->trade_license)}}" placeholder="Enter trade license" name="trade_license" class="form-control @error('trade_license') is-invalid @enderror" >
                  @error('trade_license')
                  <strong class="text-danger">{{ $errors->first('trade_license') }}</strong>
                  @enderror
                </div>

                <div class="col-md-12 col-lg-3 col-xl-3">
                  <label for="logo">Logo <span class="text-danger">(Support only jpeg,png,jpg & webp format)</span></label>
                  <input type="file" id="logo" cols="30" rows="5" value="{{old('logo')}}" placeholder="Enter company's logo" name="logo" class="form-control @error('logo') is-invalid @enderror" >
                  @error('logo')
                  <strong class="text-danger">{{ $errors->first('logo') }}</strong>
                  @enderror
                  <div class="form-group">
                    <img @if($data->logo != "dummy.jpg") src="{{ asset($data->logo) }}" @endif style="max-height: 150px; max-width: 150px;">
                  </div>
                </div>
              </div>
            </div>

              <div class="form-group text-right">
                  <button class="btn btn-outline-info btn-sm mt-2" type="submit">Save</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('script')

@endsection
