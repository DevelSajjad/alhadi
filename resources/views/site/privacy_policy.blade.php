@extends('layouts.frontend_layout')

@section('stylesheet')
<style>
   h1 {
    font-size: 40px;
    font-weight: 700;
    color: #8B75B3;
  }
  title {
    font-size: 50px;
    font-weight: 500;
  }
</style>
@endsection

@section('content')
  <div class="row">
    <div class="container">
      <div class="col-12">
        <div class="ms-panel">
          <div class="ms-panel-body">
            {{-- <div class="col-sm-3">
              <select onChange="window.location.href=this.value" class="form-control">
                <option selected value="{{ route('return.refund') }}">English</option>
                <option value="{{ route('return.refundBN') }}">বাংলা</option>
              </select><br><br><br>
            </div> --}}
            {{-- <div class="col-md-12">
              <h2 class="db-header-title" id="title">{{$policy-> title_en?? 'No Data'}}</h2>
            </div>
            <div class="col-md-12">
              <span id="description">{!! $policy-> description?? 'No Data'!!}</span>
            </div> --}}

            <div class="col-md-12 text-center">
              <h1> {{ $privacy?->title_en }} </h1>
            </div>
            <div class="col-md-12 m-30">
              {{-- <div class="mb-10">
                <strong><b>OVERVIEW</b></strong>
              </div> --}}
              <div class="col-md-12">
                <p> {!! $privacy?->overview !!} </p>
              </div>
              
              <div class="col-md-12">
                {!! $privacy?->description !!}
              </div>
          </div>
        </div>
      </div>
    </div>
    </div>

@endsection

@section('script')


@endsection


