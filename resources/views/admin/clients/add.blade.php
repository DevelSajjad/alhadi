@extends('layouts.admin_layout')

@section('stylesheet')

@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">Top Client</h1>
    </div>
    <div class="col-12">
      <div class="ms-panel">
        <div class="ms-panel-body">
          <div class="form-group text-right">
            <a href="{{ route('admin.clients.view') }}" class="btn btn-outline-success btn-sm mb-2">View All</a>
          </div>
          @if(session()->has('status'))
            {!! session()->get('status') !!}
          @endif
          <form action="{{ route('admin.clients.add') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group col-md-4">
                <label for="name">Clients Name</label>
                <input type="text" placeholder="Enter name of the Client" value="{{old('name')}}" required name="name" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <strong class="text-danger">{{ $errors->first('name') }}</strong>
                @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="logo">Clients Logo</label>
                    <input type="file" id="logo" placeholder="Choose a brand Image" required name="logo" class="form-control @error('logo') is-invalid @enderror">
                    @error('logo')
                    <strong class="text-danger">{{ $errors->first('logo') }}</strong>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <label for="logo">Clients Website URL</label>
                    <input type="url" id="url" placeholder="https://example.com" required name="url" class="form-control @error('url') is-invalid @enderror">
                    @error('url')
                    <strong class="text-danger">{{ $errors->first('url') }}</strong>
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

@endsection