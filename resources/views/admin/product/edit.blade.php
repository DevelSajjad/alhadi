@extends('layouts.admin_layout')

@section('stylesheet')
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">
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
            <a href="{{ route('admin.product.view') }}" class="btn btn-outline-success btn-sm mb-2">View All</a>
          </div>
          @if(session()->has('status'))
            {!! session()->get('status') !!}
          @endif
          <form action="{{ route('admin.product.edit', $product->slug) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="product_name">Name <span class="text-danger">*</span></label>
                  <input type="text" id="product_name" required value="{{$product->name}}" placeholder="Enter a product name" name="name" class="form-control @error('name') is-invalid @enderror">
                  @error('name')
                  <strong class="text-danger">{{ $errors->first('name') }}</strong>
                  @enderror
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="product_code">Code/Model <span class="text-danger">*</span></label>
                  <input type="text" id="product_code" required value="{{$product->code}}" placeholder="Enter a code/model" name="code" class="form-control @error('code') is-invalid @enderror">
                  @error('code')
                  <strong class="text-danger">{{ $errors->first('code') }}</strong>
                  @enderror
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="quantity">Quantity <span class="text-danger">*</span></label>
                  <input type="text" id="quantity" value="{{$product->quantity}}" placeholder="Enter product quantity" name="quantity" class="form-control @error('quantity') is-invalid @enderror">
                  @error('quantity')
                  <strong class="text-danger">{{ $errors->first('quantity') }}</strong>
                  @enderror
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="category">Select a Category <span class="text-danger">*</span></label>
                  <select name="category_id" id="category" required class="form-control @error('category_id') is-invalid @enderror">
                    <option value="">Choose a Category</option>
                    @foreach($categories as $value)
                      <option value="{{ $value->id }}" @if($product->category_id == $value->id) selected @endif>{{ $value->name }}</option>
                    @endforeach
                  </select>
                  @error('category_id')
                  <strong class="text-danger">{{ $errors->first('category_id') }}</strong>
                  @enderror
                </div>
              </div>
            </div>


            <div class="form-group">
              <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="sub_category">Select a Sub Category <span class="text-danger">*</span></label>
                  <select name="subcategory_id" id="sub_category" required class="form-control @error('subcategory_id') is-invalid @enderror">
                    <option value="">Choose a Sub Category</option>
                    @foreach($sub_categories as $value)
                      @if($product->category_id == $value->category_id)
                        <option value="{{ $value->id }}" @if($product->sub_category_id == $value->id) selected @endif>{{ $value->name }}</option>
                      @endif
                    @endforeach
                  </select>
                  @error('subcategory_id')
                  <strong class="text-danger">{{ $errors->first('subcategory_id') }}</strong>
                  @enderror
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="brands">Select a Brand <span class="text-danger">*</span></label>
                  <select name="brand_id" id="brands" required class="form-control @error('brand_id') is-invalid @enderror">
                    <option value="">Choose a Brand</option>
                    @foreach($brands as $value)
                      @if(($product->brand_id == $value->id))
                        <option value="{{ $value->id }}" @if($product->brand_id == $value->id) selected @endif>{{ $value->name }}</option>
                      @endif
                    @endforeach
                  </select>
                  @error('brand_id')
                  <strong class="text-danger">{{ $errors->first('brand_id') }}</strong>
                  @enderror
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="weight">Weight</label>
                  <input type="number" id="weight" value="{{$product->weight}}" placeholder="Enter product weight" name="weight" class="form-control @error('weight') is-invalid @enderror">
                  @error('weight')
                  <strong class="text-danger">{{ $errors->first('weight') }}</strong>
                  @enderror
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="dimensions">Dimensions</label>
                  <input type="text" id="dimensions" value="{{$product->dimensions}}" placeholder="Enter product dimensions" name="dimensions" class="form-control @error('dimensions') is-invalid @enderror">
                  @error('dimensions')
                  <strong class="text-danger">{{ $errors->first('dimensions') }}</strong>
                  @enderror
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="include">Include</label>
                  <input type="text" id="include" value="{{$product->include}}" placeholder="Enter product include" name="include" class="form-control @error('include') is-invalid @enderror">
                  @error('include')
                  <strong class="text-danger">{{ $errors->first('include') }}</strong>
                  @enderror
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="guarantee">Warranty</label>
                  <input type="number" id="guarantee" value="{{$product->guarantee}}" placeholder="Enter product warranty" name="guarantee" class="form-control @error('guarantee') is-invalid @enderror">
                  @error('guarantee')
                  <strong class="text-danger">{{ $errors->first('guarantee') }}</strong>
                  @enderror
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="made_in">Made In/Country of Origin</label>
                  <input type="text" id="made_in" value="{{$product->made_in }}" placeholder="Enter country name" name="made_in" class="form-control @error('made_in') is-invalid @enderror">
                  @error('made_in')
                  <strong class="text-danger">{{ $errors->first('made_in') }}</strong>
                  @enderror
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="previous_price">Previous Price</label>
                  <input type="number" id="previous_price" value="{{$product->previous_price }}" placeholder="Enter product previous price" name="previous_price" class="form-control @error('previous_price') is-invalid @enderror">
                  @error('previous_price')
                  <strong class="text-danger">{{ $errors->first('previous_price') }}</strong>
                  @enderror
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <label for="price">Price <span class="text-danger">*</span></label>
                  <input type="number" id="price" value="{{$product->price}}" placeholder="Enter product price" name="price" class="form-control @error('price') is-invalid @enderror">
                  @error('price')
                  <strong class="text-danger">{{ $errors->first('price') }}</strong>
                  @enderror
                </div>
              </div>
            </div>


            <div class="form-group">
              <div class="row color-parent">
                <?php $colors = explode("|", $product->color); ?>
                @if(count($colors) < 1)
                  <div class="col-md-6 col-lg-6 col-xl-6 mb-3">
                    <div class="row">
                      <div class="col-11">
                        <label for="color">Color</label>
                        <input type="color" id="color" value="{{old('color')}}" placeholder="Enter product color" name="color[]" class="form-control @error('color') is-invalid @enderror">
                        @error('color')
                        <strong class="text-danger">{{ $errors->first('color') }}</strong>
                        @enderror
                      </div>
                      <div class="col-1" style="margin-top: auto">
                        <span style="font-size: 35px;margin-left: -20px; cursor: pointer" class="fa fa-plus-circle color-add-btn text-success"></span>
                      </div>
                    </div>
                  </div>
                @else
                  @foreach($colors as $key => $color)
                    @if($key == 0)
                      <div class="col-md-6 col-lg-6 col-xl-6 mb-3">
                        <div class="row">
                          <div class="col-11">
                            <label for="color">Color</label>
                            <input type="color" id="color" value="{{ $color }}" placeholder="Enter product color" name="color[]" class="form-control @error('color') is-invalid @enderror">
                            @error('color')
                            <strong class="text-danger">{{ $errors->first('color') }}</strong>
                            @enderror
                          </div>
                          <div class="col-1" style="margin-top: auto">
                            <span style="font-size: 35px;margin-left: -20px; cursor: pointer" class="fa fa-plus-circle color-add-btn text-success"></span>
                          </div>
                        </div>
                      </div>
                    @else
                      <div class="col-md-6 col-lg-6 col-xl-6 mb-3 remove-child">
                        <div class="row">
                          <div class="col-11">
                            <label for="color">Color</label>
                            <input type="color" id="color" value="{{ $color }}" placeholder="Enter product color" name="color[]" class="form-control @error('color') is-invalid @enderror">
                            @error('color')
                            <strong class="text-danger">{{ $errors->first('color') }}</strong>
                            @enderror
                          </div>
                          <div class="col-1" style="margin-top: auto">
                            <span style="font-size: 35px;margin-left: -20px; cursor: pointer" class="fa fa-minus-circle color-remove-btn text-danger"></span>
                          </div>
                        </div>
                      </div>
                    @endif
                  @endforeach
                @endif
              </div>

              <div class="form-group">
                <label for="summernote">Description <span class="text-danger">*</span></label>
                {{--<textarea type="text" id="description" cols="30" rows="5" placeholder="Enter product description" name="description" class="form-control @error('description') is-invalid @enderror" required >{{$product->description}}</textarea>--}}
                <textarea id="summernote" name="description" required>{!! $product->description !!}</textarea>
                @error('description')
                <strong class="text-danger">{{ $errors->first('description') }}</strong>
                @enderror
              </div>
                <div class="form-group">
                    <label for="summernote1">specification <span class="text-danger">*</span></label>
                    {{--<textarea type="text" id="description" cols="30" rows="5" placeholder="Enter product description" name="description" class="form-control @error('description') is-invalid @enderror" required >{{$product->description}}</textarea>--}}
                    <textarea id="summernote1" name="specification" required>{!! $product->specification !!}</textarea>
                    @error('specification')
                    <strong class="text-danger">{{ $errors->first('specification') }}</strong>
                    @enderror
                </div>

              <div class="form-group">
                <label for="">Thumbnail Image</label>
                <div class="row">
                  <div class="col-md-4 col-lg-4 col-xl-4 text-center">
                    <img src="{{ asset($product->thumbnail_image) }}" alt="" class="border-dark">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="thumbnail_image">Change Thumbnail Image <span class="text-danger">(Image must be in 500KB, support only jpeg,png,jpg & webp formate)</span></label>
                <input type="file" id="thumbnail_image" placeholder="Enter product thumbnail_image" name="thumbnail_image" class="form-control @error('thumbnail_image') is-invalid @enderror">
                @error('thumbnail_image')
                <strong class="text-danger">{{ $errors->first('thumbnail_image') }}</strong>
                @enderror
              </div>


              @if(isset($images))
                <div class="form-group">
                  <label for="">Others Image </label>
                  <div class="row">
                    @foreach($images as $image)
                      <div class="col-md-3 col-lg-3 col-xl-3 text-center p-2 product_single_image_area">
                        <img src="{{ asset($image->image) }}" alt="" class="border-dark">
                        <span class="btn btn-outline-danger mt-2 mb-2 btn-sm delete_product_image" data-id="{{$image->id}}">Remove</span>
                      </div>
                    @endforeach
                  </div>
                </div>
              @endif


              <div class="form-group">
                <label for="image">Others Image <span class="text-danger">(Image must be in 500KB, support only jpeg,png,jpg & webp formate)</span></label>
                <input type="file" multiple id="image"  placeholder="Enter product image" name="image[]" class="form-control @error('image') is-invalid @enderror" >
                @error('image.*')
                <strong class="text-danger">{{ $errors->first('image.*') }}</strong>
                @enderror
              </div>

              <div class="form-group">
                <span>Product Type: </span>
                <label for="special_discount" class="mr-3"><input id="special_discount" type="radio" value="special_discount" class="ml-3 mr-2" name="clearing_sale" @if($product->clearing_sale == 'special_discount') checked @endif>Special Discount</label>
                <label for="yes" class="mr-3"><input id="yes" type="radio" value="yes" class="ml-3 mr-2" name="clearing_sale" @if($product->clearing_sale == 'yes') checked @endif>Clearing Sale</label>
                <label for="no" class="mr-3"><input id="no" type="radio" value="no" class="ml-3 mr-2" name="clearing_sale" @if($product->clearing_sale == 'no') checked @endif>Regular</label>
              </div>

              <div class="form-group">
                <span>Product Status: </span>
                <label for="active" class="mr-3"><input id="active" type="radio" value="active" class="ml-3 mr-2" name="status" @if(strtolower($product->status) == 'active') checked @endif>Active</label>
                <label for="inactive" class="mr-3"><input id="inactive" type="radio" value="inactive" class="ml-3 mr-2" name="status" @if(strtolower($product->status) == 'inactive') checked @endif>Inactive</label>
              </div>

              <div class="form-group">
                <span>Add To Bestseller: </span>
                <label for="true" class="mr-3"><input id="true" type="radio" value="true" class="ml-3 mr-2" name="best_seller" @if(strtolower($product->best_seller) == 'true') checked @endif>Yes</label>
                <label for="false" class="mr-3"><input id="false" type="radio" value="false" class="ml-3 mr-2" name="best_seller" @if(strtolower($product->best_seller) == 'false') checked @endif>No</label>
              </div>
                <h3>SEO Section</h3>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" id="meta_title" value="{{$product->meta_title}}" placeholder="Enter Meta Title" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror">
                            @error('meta_title')
                            <strong class="text-danger">{{ $errors->first('meta_title') }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <label for="meta_description">Meta Description</label>
                            <textarea id="meta_description" placeholder="Enter Meta Description" name="meta_description" class="form-control @error('meta_description') is-invalid @enderror">{{$product->meta_description}}</textarea>
                            @error('meta_description')
                            <strong class="text-danger">{{ $errors->first('meta_description') }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <label for="meta_tags">Meta Tags</label>
                            <textarea id="meta_tags" placeholder="Enter Meta Tags" name="meta_tags" class="form-control @error('meta_tags') is-invalid @enderror">{{$product->meta_tags}}</textarea>
                            @error('meta_tags')
                            <strong class="text-danger">{{ $errors->first('meta_tags') }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>

              <div class="form-group text-right">
                <button class="btn btn-outline-info btn-sm mt-2" type="submit">Save</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('script')
  <script src="{{ asset('assets/admin/js/jquery-3.3.1.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#summernote').summernote({
        placeholder: 'Write product description',
        tabsize: 2,
        height: 120,
      });
      $('#summernote1').summernote({
        placeholder: 'Write product description',
        tabsize: 2,
        height: 120,
      });

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $(document).on('change', 'select[name="subcategory_id"]', function () {
        const category_id = $('select[name="category_id"]').val();
        const subcategory_id = $(this).val();
        const $this = $(this);
        var output = "";
        {{--if(category_id !== "" && subcategory_id !== "") {--}}
        {{--  $.ajax({--}}
        {{--    url: "{{ route('admin.ajax.subcategory.to.brand') }}",--}}
        {{--    method: "POST",--}}
        {{--    dataType: "json",--}}
        {{--    data: { category_id, subcategory_id },--}}
        {{--    success: function (attributes_value) {--}}
        {{--      if (attributes_value.length > 0) {--}}
        {{--        output += '<option value="">Choose a Brand</option>';--}}
        {{--        $.each(attributes_value, function (i, e) {--}}
        {{--          output += '<option value="' + e.id + '">' + e.name + '</option>';--}}
        {{--        })--}}
        {{--        output += '</select>';--}}
        {{--      } else { // if attributes has no value--}}
        {{--        output += '<option value="">Choose a Brand</option>';--}}
        {{--      }--}}
        {{--      $('select[name="brand_id"]').empty()--}}
        {{--      $('select[name="brand_id"]').append(output)--}}
        {{--    }--}}
        {{--  })--}}
        {{--}--}}
      })

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
              $('select[name="subcategory_id"]').empty()
              $('select[name="subcategory_id"]').append(output)
            }
          })
        }


      })

      $(document).on('click', '.color-add-btn', function () {
        $('.color-parent').append('\n' +
          '                <div class="col-md-6 col-lg-6 col-xl-6 remove-child">\n' +
          '                  <div class="row">\n' +
          '                    <div class="col-11">\n' +
          '                      <label for="color">Color</label>\n' +
          '                      <input type="color" id="color"  placeholder="Enter product color" name="color[]" class="form-control">\n' +
          '                    </div>\n' +
          '                    <div class="col-1" style="margin-top: auto">\n' +
          '                      <span style="font-size: 35px;margin-left: -20px; cursor: pointer" class="fa fa-minus-circle color-remove-btn text-danger"></span>\n' +
          '                    </div>\n' +
          '                  </div>\n' +
          '              </div>')
      })

      $(document).on('click', '.color-remove-btn', function () {
        $(this).parents('.remove-child').remove();
      })

      // product.delete_image
      $(document).on('click', '.delete_product_image', function () {
        const product_image_id = $(this).data("id");
        const $this = $(this);
        $.ajax({
          url: "{{ route('admin.product.delete_image') }}",
          method: "POST",
          dataType: "html",
          data: {id: product_image_id},
          success: function (data) {
            console.log(data)
            if (data === "success"){
              $this.closest('.product_single_image_area').css('background-color', 'red').fadeOut();
            }
          }
        })
      })


    })
  </script>
@endsection
