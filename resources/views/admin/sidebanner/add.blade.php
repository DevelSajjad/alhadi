@extends('layouts.admin_layout')

@section('stylesheet')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <h1 class="db-header-title">Side Banner</h1>
  </div>
  <div class="col-12">
    <div class="ms-panel">
      <div class="ms-panel-body">
        <div class="form-group text-right">
          <a href="{{ route('admin.sidebanner.view') }}" class="btn btn-outline-success btn-sm mb-2">View All</a>
        </div>
        @if(session()->has('status'))
        {!! session()->get('status') !!}
        @endif
        <form action="{{ route('admin.sidebanner.add') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="form-group col-md-6">
              <label for="name">Promotion Title</label>
              <input type="text" placeholder="Enter name of the Client" value="{{old('title')}}" required name="title"
                class="form-control @error('title') is-invalid @enderror">
              @error('title')
              <strong class="text-danger">{{ $errors->first('title') }}</strong>
              @enderror
            </div>

            <div class="form-group col-md-6">
              <label for="product_id">Product</label>
              <select name="product_id" id="products" class="form-control">
                <option value="">Choose Product</option>
                @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="banner_img">Banner Image</label>
              <input type="file" id="banner_img" placeholder="Choose a brand Image" required name="banner_img"
                class="form-control @error('banner_img') is-invalid @enderror">
              @error('banner_img')
              <strong class="text-danger">{{ $errors->first('banner_img') }}</strong>
              @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="product_id">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="inactive" selected>Inactive</option>
                    <option value="active">Active</option>
                </select>
            </div>
          </div>

          <div class="form-group text-right">
            <button class="btn btn-info btn-sm mt-2" type="submit">Save</button>
          </div>


        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  $(document).ready(function() {
      $('#products').select2();
  });
</script>
@endsection
