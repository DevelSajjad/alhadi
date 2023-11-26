@extends('layouts.admin_layout')

@section('stylesheet')

@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">Edit Brand</h1>
    </div>
    <div class="col-12">
      <div class="ms-panel">
        {{--<div class="ms-panel-header">--}}
        {{--<h6>Basic Form Elements</h6>--}}
        {{--</div>--}}
        <div class="ms-panel-body">
          <div class="form-group text-right">
            <a href="{{ route('admin.brand.view') }}" class="btn btn-outline-success btn-sm mb-2">View All</a>
          </div>
          @if(session()->has('status'))
            {!! session()->get('status') !!}
          @endif
          <form action="{{ route('admin.brand.edit', $brand->slug ) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="brand_name">Name</label>
              <input type="text" id="brand_name" placeholder="Enter a brand name" name="name" value="{{ $brand->name }}" class="form-control @error('name') is-invalid @enderror">
              @error('name')
              <strong class="text-danger">{{ $errors->first('name') }}</strong>
              @enderror
            </div>

            <div class="form-group">
              <label for="">Brand Image</label>
              <div class="row">
                <div class="col-md-4 col-lg-4 col-xl-4 text-center">
                  <img src="{{ asset($brand->image) }}" alt="" class="border-dark">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="brand_image">Brand Image <span class="text-danger">(Image must be in 100KB, support only jpeg,png,jpg & webp formate)</span></label>
              <input type="file" id="brand_image" placeholder="Choose a brand Image" name="brand_image" class="form-control @error('brand_image') is-invalid @enderror">
              @error('brand_image')
              <strong class="text-danger">{{ $errors->first('brand_image') }}</strong>
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
  <script src="{{ asset('assets/admin/js/jquery-3.3.1.min.js') }}"></script>
  <script>
    $(document).ready(function () {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $(document).on('change', 'select[name="category_id"]', function () {
        const category_id = $(this).val();
        console.log(category_id)
        const $this = $(this);
        var output = "";
        if(category_id !== "") {
          $.ajax({
            url: "{{ route('admin.ajax.category.to.subcategory') }}",
            method: "POST",
            dataType: "json",
            data: {category_id: category_id},
            success: function (attributes_value) {
              if (attributes_value.length > 0) {
                output += '<option value="">Choose a Sub Category</option>';
                $.each(attributes_value, function (i, e) {
                  output += '<option value="' + e.id + '">' + e.name + '</option>';
                })
                output += '</select>';
              } else { // if attributes has no value
                output += '<option value="">Choose a Sub Category</option>';
              }
              $('select[name="sub_category_id"]').empty()
              $('select[name="sub_category_id"]').append(output)
            }
          })
        }


      })
    })
  </script>
@endsection