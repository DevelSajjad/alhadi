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
    label{
      color: #005caf;
    }
    div > p > strong {
      margin-left: 10px;
    }
  </style>
@endsection

@section('customer.content')
  <div class="row ">
    <div class="col-12 text-center mb-40">
      <span class="page_title">Profile</span>
    </div>
        <div class="col-12 card" style="margin: 10px">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12">
          @if(session()->has('status'))
            {!! session()->get('status') !!}
          @endif
        </div>
      </div>
      <div class="row">
          <div class="col-md-8">
              <img src="{{ asset(auth()->user()->image) }}" alt="" style="max-width: 150px;">
              <ul class="profile-info">
                  <li><strong>Name:</strong>{{ auth()->user()->name }}</li>
                  <li><strong>Email:</strong>{{ auth()->user()->email }}</li>
                  <li><strong>Status:</strong>{{ auth()->user()->status }}</li>
                  <li><strong>Mobile No:</strong>{{ auth()->user()->mobile_no }}</li>
                  <li><strong>Address:</strong>{{ auth()->user()->address }}</li>
              </ul>

          </div>
          <div class="mt-100 text-center">
              <a style="background-color: #005caf; color: white;" href="{{ route('customer.updateProfile') }}" class="btn btn-sm float-right">Update Profile</a>
          </div>

    </div>
  </div>
      <style>
          .profile-info li{
              padding: 10px;
          }
          .card {
              display: block !important;
          }
      </style>
@endsection

@section('customer.script')

@endsection
