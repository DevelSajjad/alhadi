@extends('layouts.admin_layout')

@section('stylesheet')
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">Add Socials</h1>
    </div>
    <div class="col-12">
      <div class="ms-panel">
        {{--<div class="ms-panel-header">--}}
          {{--<h6>Basic Form Elements</h6>--}}
        {{--</div>--}}
        <div class="ms-panel-body">
          <div class="form-group text-right">
            <a href="{{ route('admin.socials.view') }}" class="btn btn-outline-success btn-sm mb-2">View All</a>
          </div>
          @if(session()->has('status'))
            {!! session()->get('status') !!}
          @endif
          <form action="{{ route('admin.socials.add') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="socials_icon">Icon Code </label>
              <input type="text" id="socials_icon" placeholder="Enter Icon Code" value="{{old('icon_code')}}" required name="icon_code" class="form-control @error('icon_code') is-invalid @enderror">
              @error('icon_code')
                <strong class="text-danger">{{ $errors->first('icon_code') }}</strong>
              @enderror
            </div>
            <div class="form-group">
              <label for="socials_url">URL </label>
                <textarea id="socials_url" placeholder="Enter URL" required name="url" class="form-control @error('url') is-invalid @enderror">{{old('url')}}</textarea>
              @error('url')
                <strong class="text-danger">{{ $errors->first('url') }}</strong>
              @enderror
            </div>
              <div class="form-group">
                  <span>Status: </span>
                  <label for="active" class="mr-3"><input id="active" type="radio" value="active" class="ml-3 mr-2" name="status">Active</label>
                  <label for="inactive" class="mr-3"><input id="inactive" type="radio" value="inactive" class="ml-3 mr-2" name="status" checked>Inactive</label>
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
  <script src="{{ asset('assets/admin/js/jquery-3.3.1.min.js') }}"></script>

@endsection
