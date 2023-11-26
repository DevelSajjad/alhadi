@extends('layouts.frontend_layout')


@section('stylesheet')

@endsection


@section('content')

  <div class="jumbotron text-center mb-0" style="background-color: white">
    <h1 class="display-3">Thank You!</h1>
    <p class="lead">Your order ID: <strong>{{ $data['order_id'] }}</strong> has been placed successfully</p>
    <hr>
    @if(($data['amount'] !=null) && ($data['card_type'] != null))
      <p class="lead"><strong>{{ $data['amount'] }}</strong> TK payed by <strong>{{ $data['card_type'] }}</strong></p>
    @endif
    <p>
      Having trouble? <a href="{{ route('contactus') }}">Contact us</a>
    </p>
    <p class="lead">
      <a class="btn btn-primary btn-sm" href="{{ route('customer.orders') }}" role="button">Check order history</a>
    </p>
  </div>
@endsection

@section('script')

@endsection