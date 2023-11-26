@extends('layouts.admin_layout')

@section('stylesheet')

@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">Edit Moderator</h1>
    </div>
    <div class="col-12">
      <div class="ms-panel">
        <div class="ms-panel-body">
          <div class="form-group text-right">
            <a href="{{ route('admin.moderator.view') }}" class="btn btn-outline-success btn-sm mb-2">View All</a>
          </div>
          @if(session()->has('status'))
            {!! session()->get('status') !!}
          @endif
          <form action="{{ route('admin.moderator.edit', $moderator->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="brand_name">Name</label>
                  <input type="text" id="brand_name" placeholder="Enter a moderator name" value="{{ $moderator->name }}" required name="name" class="form-control @error('name') is-invalid @enderror">
                  @error('name')
                  <strong class="text-danger">{{ $errors->first('name') }}</strong>
                  @enderror
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="mobile_NO">Mobile No</label>
                  <input type="number" id="mobile_NO" placeholder="Enter a Mobile No" value="{{  $moderator->mobile_no }}" required name="mobile_no" class="form-control @error('mobile_no') is-invalid @enderror">
                  @error('mobile_no')
                  <strong class="text-danger">{{ $errors->first('mobile_no') }}</strong>
                  @enderror
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="email_id">Email</label>
                  <input type="email" id="email_id" placeholder="Enter a Email" value="{{  $moderator->email }}" required name="email" class="form-control @error('email') is-invalid @enderror">
                  @error('email')
                  <strong class="text-danger">{{ $errors->first('email') }}</strong>
                  @enderror
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="password">Password</label>
                  <input type="password" id="password" placeholder="Enter a password" {{--value="{{  $moderator->password }}"--}} name="password" class="form-control @error('password') is-invalid @enderror">
                  @error('password')
                  <strong class="text-danger">{{ $errors->first('password') }}</strong>
                  @enderror
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="">Profile Image</label>
              <div class="row">
                <div class="col-md-4 col-lg-4 col-xl-4 text-center">
                  <img src="{{ asset($moderator->image) }}" alt="" class="border-dark">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="user_image">Profile Image<span class="text-danger">(Image must be in 100KB, support only jpeg,png,jpg & webp formate)</span></label>
              <input type="file" id="user_image" placeholder="Choose a Profile Image" name="image" class="form-control @error('image') is-invalid @enderror">
              @error('image')
              <strong class="text-danger">{{ $errors->first('image') }}</strong>
              @enderror
            </div>

            <div class="form-group">
              <span class="mr-3">Status: </span>
              <label for="active" class="mr-2"><input type="radio" name="status" value="active" id="active" @if(strtolower($moderator->status) == 'active' ) checked @endif> Active</label>
              <label for="inactive"><input type="radio" name="status" value="inactive" id="inactive" @if(strtolower($moderator->status) == 'inactive' ) checked @endif> Inactive</label>
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