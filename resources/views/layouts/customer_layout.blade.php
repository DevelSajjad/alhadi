@extends('layouts.frontend_layout')

@section('stylesheet')
  @yield('customer.stylesheet')

@endsection

@section('content')
  <div class="ps-section--features-product ps-section masonry-root" style="padding: 00px">
    <div class="container-fluid">
      <div class="row partialResponsive" style="background: #fff; display: flex">
        <div class="col-md-3 col-lg-3 col-xl-3 pl-20" style="background: white; padding: 10px;">
          <ui class="ps-list--line" style="list-style-type: none">
            <li><a href="{{ route('customer.dashboard') }}"><strong style="color: black">Dashboard</strong></a></li>
            <hr style="margin: 0px; padding: 0px">
            <li><a href="{{ route('customer.profile') }}"><strong style="color: black">Profile</strong></a></li>
            <hr style="margin: 0px; padding: 0px">
            <li><a href="{{ route('customer.wishlist') }}"><strong style="color: black">WishList</strong></a></li>
            <hr style="margin: 0px; padding: 0px">
            <li><a href="{{ route('customer.orders') }}"><strong style="color: black">Orders</strong></a></li>
            <hr style="margin: 0px; padding: 0px">
            <li><a href="{{ route('customer.changePassword') }}"><strong style="color: black">Change Password</strong></a></li>
          </ui>
        </div>
        <div class="col-md-9 col-lg-9 col-xl-9" style="padding: 20px;">
          @yield('customer.content')
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  @yield('customer.script')
@endsection
