@extends('layouts.admin_layout')

@section('stylesheet')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">Add Gallery</h1>
    </div>
    <div class="col-12">
      <div class="ms-panel">
        <div class="ms-panel-body">
          <div class="form-group text-right">
            <a href="{{ route('admin.gallery.view') }}" class="btn btn-outline-success btn-sm mb-2">View All</a>
          </div>
          @if(session()->has('status'))
            {!! session()->get('status') !!}
          @endif
          <form action="{{ route('admin.gallery.add') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                <label for="title">Post Title</label>
                <input type="text" placeholder="Enter title of the post" value="{{old('title')}}" required name="title" class="form-control @error('title') is-invalid @enderror">
                @error('title')
                    <strong class="text-danger">{{ $errors->first('title') }}</strong>
                @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="thumb_img">Thumbnail Image</label>
                    <input type="file" id="thumb_img" placeholder="Choose a brand Image" required name="thumb_img" class="form-control @error('thumb_img') is-invalid @enderror">
                    @error('thumb_img')
                    <strong class="text-danger">{{ $errors->first('thumb_img') }}</strong>
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <label for="summernote">Post body</label>
                    <textarea type="text" id="summernote" value="{{old('body')}}" placeholder="Type the post body" name="body" class="form-control @error('body') is-invalid @enderror" ></textarea>
                    @error('body')
                        <strong class="text-danger">{{ $errors->first('body') }}</strong>
                    @enderror
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
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>  
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>
@endsection