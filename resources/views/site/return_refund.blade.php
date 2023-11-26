@extends('layouts.frontend_layout')

@section('stylesheet')

@endsection

@section('content')
  <div class="row">
    <div class="container">
      <div class="col-12">
        <div class="ms-panel">
          <div class="ms-panel-body">
            <div class="col-sm-3">
              <select onChange="window.location.href=this.value" class="form-control">
                <option selected value="{{ route('return.refund') }}">English</option>
                <option value="{{ route('return.refundBN') }}">বাংলা</option>
              </select><br><br><br>
            </div>
            <div class="col-md-12">
              <h2 class="db-header-title" id="title">{{$policy-> title_en?? 'No Data'}}</h2>
            </div>
            <div class="col-md-12">
              <span id="description">{!! $policy-> description_en?? 'No Data'!!}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>

@endsection

@section('script')


@endsection


