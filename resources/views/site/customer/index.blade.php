@extends('layouts.customer_layout')

@section('customer.stylesheet')
  <style>
    .page_title{
      font-size: 35px;
      font-weight: 500;
      font-family: fantasy;
    }
    .card{
      background-color: white;
      padding: 10px;
      border-radius: 5px;
      box-shadow: 0 4px 4px 4px #cbb5b6;
      min-height: 50px;
    }
    .card:hover{
      box-shadow: 0 4px 4px 4px #9dcb9b;
    }

    .p-5{
      padding: 5px;
    }
  </style>
@endsection

@section('customer.content')
  <div class="row ">
    <div class="col-12 text-center mb-40">
      <span class="page_title">Dashboard</span>
    </div>

    <div class="col-md-3 col-lg-3 col-xl-3 p-5">
      <div class="card">
        <strong><b>New Order: {{ $order['new'] }}</b></strong>
      </div>
    </div>
    <div class="col-md-3 col-lg-3 col-xl-3 p-5">
      <div class="card">
        <strong><b>Pending Order: {{ $order['pending'] }}</b></strong>
      </div>
    </div>
    <div class="col-md-3 col-lg-3 col-xl-3 p-5">
      <div class="card">
        <strong><b>Processing Order: {{ $order['processing'] }}</b></strong>
      </div>
    </div>
    <div class="col-md-3 col-lg-3 col-xl-3 p-5">
      <div class="card">
        <strong><b>Delivered Order: {{ $order['delivered'] }}</b></strong>
      </div>
    </div>
    <div class="col-md-3 col-lg-3 col-xl-3 p-5">
      <div class="card">
        <strong><b>Completed Order: {{ $order['completed'] }}</b></strong>
      </div>
    </div>
    <div class="col-md-3 col-lg-3 col-xl-3 p-5">
      <div class="card">
        <strong><b>Canceled Order: {{ $order['canceled'] }}</b></strong>
      </div>
    </div>
    <div class="col-md-3 col-lg-3 col-xl-3 p-5">
      <div class="card">
        <strong><b>Total Order: {{ $order['total'] }}</b></strong>
      </div>
    </div>

  </div>
@endsection

@section('customer.script')

@endsection
