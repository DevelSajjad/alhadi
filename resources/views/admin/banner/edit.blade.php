@extends('layouts.admin_layout')

@section('stylesheet')
  <link href="{{ asset('assets/admin/node_modules/select2/select2.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">Edit Banner</h1>
    </div>
    <div class="col-12">
      <div class="ms-panel">
        {{--<div class="ms-panel-header">--}}
        {{--<h6>Basic Form Elements</h6>--}}
        {{--</div>--}}
        <div class="ms-panel-body">
          <div class="form-group text-right">
            <a href="{{ route('admin.banner.view') }}" class="btn btn-outline-success btn-sm mb-2">View All</a>
          </div>
          @if(session()->has('status'))
            {!! session()->get('status') !!}
          @endif
          <form action="{{ route('admin.banner.edit', $banner->id ) }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
              <div class="row">
                <div class="col-12">
                  <label for="product_id">Select a product</label>
                  <select name="product_id" id="product_id" required class="form-control @error('product_id') is-invalid @enderror">
                    <option value="">Choose a Product</option>
                    @foreach($products as $product)
                      <option value="{{ $product->id }}" @if($banner->product_id == $product->id) selected @endif>{{ $product->name }}</option>
                    @endforeach
                  </select>
                  @error('product_id')
                  <strong class="text-danger">{{ $errors->first('product_id') }}</strong>
                  @enderror
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-12">
                  <img src="{{ asset($banner->image) }}" id="banner_image_view" style="max-height: 300px;" alt="">
                </div>
                <div class="col-12">
                  <label for="banner_image">Image <span class="text-danger">(Image must be in 1MB, support only jpeg,png,jpg & webp formate)</span></label>
                  <input type="file" id="banner_image" cols="30" rows="5" value="{{old('banner_image')}}" placeholder="Enter product banner_image" name="banner_image" class="form-control @error('banner_image') is-invalid @enderror" >
                  @error('banner_image')
                  <strong class="text-danger">{{ $errors->first('banner_image') }}</strong>
                  @enderror
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
  <script src="{{ asset('assets/admin/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('assets/admin/node_modules/select2/select2.min.js') }}"></script>
  <script>
    $(document).ready(function () {
      var readURL = function(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            $('#banner_image_view').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        }
      }
      $("#banner_image").change(function () {
        readURL(this);
      });

      $('#product_id').select2();
    })
  </script>
@endsection