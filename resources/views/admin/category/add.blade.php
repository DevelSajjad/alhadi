@extends('layouts.admin_layout')

@section('stylesheet')

@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">Add Category</h1>
    </div>
    <div class="col-12">
      <div class="ms-panel">
        {{--<div class="ms-panel-header">--}}
          {{--<h6>Basic Form Elements</h6>--}}
        {{--</div>--}}
        <div class="ms-panel-body">
          <div class="form-group text-right">
            <a href="{{ route('admin.category.view') }}" class="btn btn-outline-success btn-sm mb-2">View All</a>
          </div>
          @if(session()->has('status'))
            {!! session()->get('status') !!}
          @endif
          <form action="{{ route('admin.category.add') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="category_name">Name</label>
              <input type="text" id="category_name" placeholder="Enter a category name" value="{{old('name')}}" required name="name" class="form-control @error('name') is-invalid @enderror">
              @error('name')
                <strong class="text-danger">{{ $errors->first('name') }}</strong>
              @enderror
            </div>
            <div class="form-group">
              <label for="category_image">Category Image<span class="text-danger">(Image must be in 50KB, support only jpeg,png,jpg & webp formate)</span></label>
              <input type="file" id="category_image" placeholder="Choose a brand Image" required name="category_image" class="form-control @error('category_image') is-invalid @enderror">
              @error('category_image')
              <strong class="text-danger">{{ $errors->first('category_image') }}</strong>
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