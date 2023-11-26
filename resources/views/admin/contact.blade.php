@extends('layouts.admin_layout')

@section('stylesheet')
  <style>
    label{
      color: #0ac282;
    }
    div > p{
      margin-left: 10px;
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      /* display: none; <- Crashes Chrome on hover */
      -webkit-appearance: none;
      margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
    }

    input[type=number] {
      -moz-appearance:textfield; /* Firefox */
    }
  </style>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">Contact</h1>
    </div>
    <div class="col-6 p-2">
      <div class="ms-panel">
        <div class="ms-panel-body">
          <div class="h5 mb-3">First Contact</div>

          @if(session()->has('status1'))
            {!! session()->get('status1') !!}
          @endif

          <form action="{{ route('admin.update.contact1') }}" method="post">
            @csrf
            <input type="hidden" value="{{ $contact1?->id }}" name="id1">
            <div class="form-group">
              <label for="">Mobile No</label>
              <input type="number" name="mobile_no1" placeholder="Enter a mobile no" value="{{ old('mobile_no1', $contact1?->mobile_no) }}" required class="form-control @error('mobile_no1') is-invalid @enderror">
              @error('mobile_no1')
              <strong class="text-danger">{{ $errors->first('mobile_no1') }}</strong>
              @enderror
            </div>
            <div class="form-group text-right">
              <button type="submit" class="btn btn-success btn-sm">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-6 p-2">
      <div class="ms-panel">
        <div class="ms-panel-body">
          <div class="h5 mb-3">Second Contact</div>
          @if(session()->has('status2'))
            {!! session()->get('status2') !!}
          @endif
          <form action="{{ route('admin.update.contact2') }}" method="post">
            @csrf
            <input type="hidden" value="{{ $contact2?->id }}" name="id2">
            <div class="form-group">
              <label for="">Mobile No</label>
              <input type="number" name="mobile_no2" placeholder="Enter a mobile no" value="{{ old('mobile_no2', $contact2?->mobile_no) }}" required class="form-control @error('mobile_no2') is-invalid @enderror">
              @error('mobile_no2')
                <strong class="text-danger">{{ $errors->first('mobile_no2') }}</strong>
              @enderror
            </div>
            <div class="form-group text-right">
              <button type="submit" class="btn btn-success btn-sm">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('script')
@endsection
