@extends('layouts.admin_layout')

@section('stylesheet')
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">Add Privacy Policy</h1>
    </div>
    <div class="col-12">
      <div class="ms-panel">
        @include('flash_messages')
      </div>
      <div class="ms-panel">
        {{--<div class="ms-panel-header">--}}
          {{--<h6>Basic Form Elements</h6>--}}
        {{--</div>--}}
        <div class="ms-panel-body">
          <form action="{{ route('admin.policy.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="title_en">Title [EN] <span class="text-danger">* (Maximum 250 character) <strong id="char_count" class="text-black-50"></strong></span></label>
              <input type="text" id="title_en" placeholder="Enter  title [EN]" value="{{old('title_en')}}" required name="title_en" class="form-control @error('title_en') is-invalid @enderror">
              @error('title_en')
                <strong class="text-danger">{{ $errors->first('title_en') }}</strong>
              @enderror
            </div>
            <div class="form-group">
              <label for="title_bn">Title [BN] <span class="text-danger">* (Maximum 250 character) <strong id="char_count1" class="text-black-50"></strong></span></label>
              <input type="text" id="title_bn" placeholder="Enter  title [BN]" value="{{old('title_bn')}}" required name="title_bn" class="form-control @error('title_bn') is-invalid @enderror">
              @error('title_bn')
                <strong class="text-danger">{{ $errors->first('title_bn') }}</strong>
              @enderror
            </div>

            <div class="form-group">
              <label for="summernote">Description [EN] <span class="text-danger">*</span></label>
              <textarea id="summernote" name="description_en" required>{{ old('description_en') }}</textarea>
              @error('description_en')
              <strong class="text-danger">{{ $errors->first('description_en') }}</strong>
              @enderror
            </div>
            <div class="form-group">
              <label for="summernote1">Description [BN] <span class="text-danger">*</span></label>
              <textarea id="summernote1" name="description_bn" required>{{ old('description_bn') }}</textarea>
              @error('description_bn')
              <strong class="text-danger">{{ $errors->first('description_bn') }}</strong>
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
  {{--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>--}}
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#summernote').summernote({
        placeholder: 'Write policy description [EN]',
        tabsize: 2,
        height: 120,
      });
      $('#summernote1').summernote({
        placeholder: 'Write policy description [BN]',
        tabsize: 2,
        height: 120,
      });

      $('input[name="title_en"]').keyup(function () {
        const val = $(this).val();
        const number = val.length
        const char_start = "Remaining "
        const char_end = " character"
        const char_middle = 250 - number
        if(! (number > 250)){
          $('#char_count').text(char_start+char_middle+char_end)
        }else{
          $(this).val(val.substring(0, 250))
          $('#char_count').text(char_start+ "0" +char_end)
        }
      })

      $('input[name="title_bn"]').keyup(function () {
        const val = $(this).val();
        const number = val.length
        const char_start = "Remaining "
        const char_end = " character"
        const char_middle = 250 - number
        if(! (number > 250)){
          $('#char_count1').text(char_start+char_middle+char_end)
        }else{
          $(this).val(val.substring(0, 250))
          $('#char_count1').text(char_start+ "0" +char_end)
        }
      })
    })
  </script>
@endsection
