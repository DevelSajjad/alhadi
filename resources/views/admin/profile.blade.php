@extends('layouts.admin_layout')

@section('stylesheet')
  <style>
    label{
      color: #0ac282;
    }
    div > p{
      margin-left: 10px;
    }
  </style>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">Profile</h1>
    </div>
    <div class="col-12">
      <div class="ms-panel">
        <div class="ms-panel-body">
          <div class="row">
            <div class="col-md-6">
              <label for="">Name: </label>
              <p><strong>{{ auth()->user()->name }}</strong></p>
            </div>
            <div class="col-md-6">
              <label for="">Email: </label>
              <p><strong>{{ auth()->user()->email }}</strong></p>
            </div>
            <div class="col-md-6">
              <label for="">Mobile No: </label>
              <p><strong>{{ auth()->user()->mobile_no }}</strong></p>
            </div>
            <div class="col-md-6">
              <label for="">Status: </label>
              <p><strong class="">{{ auth()->user()->status }}</strong></p>
            </div>
            <div class="col-md-6">
              <label for="">Type: </label>
              <p><strong class="">{{ auth()->user()->type }}</strong></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('script')
@endsection
