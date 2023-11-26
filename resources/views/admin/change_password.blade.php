@extends('layouts.admin_layout')

@section('stylesheet')

@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">Change Password</h1>
    </div>
    <div class="col-12">
      <div class="ms-panel">
        <div class="ms-panel-body">
          @if(session()->has('status'))
            {!! session()->get('status') !!}
          @endif
          <form action="{{ route('admin.changePassword') }}" method="post">
            @csrf
            <div class="form-group">
              <label for="old_password">Old Password</label>
              <input type="password" id="old_password" required value="{{old('old_password')}}" placeholder="Enter your old password" name="old_password" class="form-control @error('old_password') is-invalid @enderror">
              @error('old_password')
              <strong class="text-danger">{{ $errors->first('old_password') }}</strong>
              @enderror
            </div>
            <div class="form-group">
              <label for="new_password">New Password</label>
              <input type="password" id="new_password" required value="{{old('new_password')}}" placeholder="Enter new password" name="new_password" class="form-control @error('new_password') is-invalid @enderror">
              @error('new_password')
              <strong class="text-danger">{{ $errors->first('new_password') }}</strong>
              @enderror
            </div>
            <div class="form-group">
              <label for="confirm_password">Confirm Password</label>
              <input type="password" id="confirm_password" required value="{{old('confirm_password')}}" placeholder="Enter confirm password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror">
              @error('confirm_password')
              <strong class="text-danger">{{ $errors->first('confirm_password') }}</strong>
              @enderror
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