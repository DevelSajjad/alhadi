@extends('layouts.admin_layout')

@section('stylesheet')
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">Add Notice</h1>
    </div>
    <div class="col-12">
      <div class="ms-panel">
        {{--<div class="ms-panel-header">--}}
          {{--<h6>Basic Form Elements</h6>--}}
        {{--</div>--}}
        <div class="ms-panel-body">
          <div class="form-group text-right">
            <a href="{{ route('admin.notice.view') }}" class="btn btn-outline-success btn-sm mb-2">View All</a>
          </div>
          @if(session()->has('status'))
            {!! session()->get('status') !!}
          @endif
          <form action="{{ route('admin.notice.add') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="notice_title">Title <span class="text-danger">(Maximum 250 character) <strong id="char_count" class="text-black-50"></strong></span></label>
              <input type="text" id="notice_title" placeholder="Enter title" value="{{old('title')}}" required name="title" class="form-control @error('title') is-invalid @enderror">
              @error('title')
                <strong class="text-danger">{{ $errors->first('title') }}</strong>
              @enderror
            </div>
            <div class="form-group">
              <label for="summernote">Description</label>
              <textarea id="summernote" name="description" required>{{ old('description') }}</textarea>
              @error('description')
              <strong class="text-danger">{{ $errors->first('description') }}</strong>
              @enderror
            </div>
            <div class="form-group">
              <label for="notice_file">File<span class="text-danger">(File must be in 10MB, support only jpeg,png,jpg, webp and pdf formate)</span></label>
              <input type="file" id="notice_file" placeholder="Choose a file" name="notice_file" class="form-control @error('notice_file') is-invalid @enderror">
              @error('notice_file')
              <strong class="text-danger">{{ $errors->first('notice_file') }}</strong>
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
        placeholder: 'Write notice description',
        tabsize: 2,
        height: 120,
      });

      $('input[name="title"]').keyup(function () {
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
    })
  </script>
@endsection