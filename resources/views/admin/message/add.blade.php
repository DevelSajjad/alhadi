@extends('layouts.admin_layout')

@section('stylesheet')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">Send Message</h1>
    </div>
    <div class="col-12">
      <div class="ms-panel">
        <div class="ms-panel-body">
          <div class="form-group text-right">
            <a href="" class="btn btn-outline-success btn-sm mb-2">View All</a>
          </div>
          @if(session()->has('status'))
            {!! session()->get('status') !!}
          @endif
          <form action="{{ route('admin.message.add') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-md-4">
                <label for="mobile_no">Mobile No</label>
                <input type="number" placeholder="Enter Mobile No" value="{{old('mobile_no')}}" required name="mobile_no" class="form-control @error('mobile_no') is-invalid @enderror">
                @error('mobile_no')
                    <strong class="text-danger">{{ $errors->first('mobile_no') }}</strong>
                @enderror
                </div>

                <div class="form-group col-md-8">
                    <label for="body">Message body</label>
                    <textarea type="text" value="{{old('body')}}" placeholder="Type the Message body" name="body" class="form-control @error('body') is-invalid @enderror" ></textarea>
                    @error('body')
                        <strong class="text-danger">{{ $errors->first('body') }}</strong>
                    @enderror
                </div>
            </div>

            <div class="form-group text-right">
                <button class="btn btn-info btn-sm mt-2" type="submit">Send</button>
            </div>


          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
    
@section('script')
@endsection