@extends('layouts.admin_layout')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('assets/admin/node_modules/select2/select2.min.css') }}">
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">Edit Category</h1>
    </div>
    <div class="col-12">
      <div class="ms-panel">
        {{--<div class="ms-panel-header">--}}
        {{--<h6>Basic Form Elements</h6>--}}
        {{--</div>--}}
        <div class="ms-panel-body">
          <div class="form-group text-right">
            <a href="{{ route('admin.sub-category.view') }}" class="btn btn-outline-success btn-sm mb-2">View All</a>
          </div>
          @if(session()->has('status'))
            {!! session()->get('status') !!}
          @endif
          <form action="{{ route('admin.sub-category.edit', $sub_category->slug ) }}" method="post">
            @csrf
            <div class="form-group">
              <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="category">Select a Category</label>
                  <select name="category_id" id="category" required class="form-control @error('category_id') is-invalid @enderror">
                    <option value="">Choose a Category</option>
                    @foreach($categories as $value)
                      <option value="{{ $value->id }}" @if( $sub_category->category_id == $value->id) selected @endif>{{ $value->name }}</option>
                    @endforeach
                  </select>
                  @error('category_id')
                  <strong class="text-danger">{{ $errors->first('category_id') }}</strong>
                  @enderror
                </div>
                  <div class="col-md-6 col-lg-6 col-xl-6">
                      <label for="category">Select a BRANDS</label>
                      <select name="brand_ids[]" id="category" required multiple class="form-control select2 @error('brand_ids') is-invalid @enderror">
                          <option value="">Choose a Category</option>
                          @foreach($brands as $value)
                              <option value="{{ $value->id }}" @selected(in_array($value->id, old('brand_ids', $brandExists->toArray())))>{{ $value->name }}</option>
                          @endforeach
                      </select>
                      @error('brand_ids')
                      <strong class="text-danger">{{ $errors->first('brand_ids') }}</strong>
                      @enderror
                  </div>
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="sub_category_name">Name</label>
                  <input type="text" id="sub_category_name" required value="{{ $sub_category->name }}" placeholder="Enter a sub-category name" name="name" class="form-control @error('name') is-invalid @enderror">
                  @error('name')
                  <strong class="text-danger">{{ $errors->first('name') }}</strong>
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
    <script src="{{ asset('assets/admin/node_modules/select2/select2.min.js') }}"></script>
    <script>
        $(document).ready(function () {

            $('.select2').select2();
        })
    </script>
@endsection
