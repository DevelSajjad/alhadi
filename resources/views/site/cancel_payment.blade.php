@extends('layouts.frontend_layout')


@section('stylesheet')

@endsection


@section('content')

  <div class="jumbotron text-center mb-0" style="background-color: white">
    <h3 class="display-3">Transaction failed.</h3>
    <p class="lead">Your order ID: <strong>{{ $data['order_id'] }}</strong> is not completed.</p>
    <hr>
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