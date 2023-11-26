@extends('layouts.admin_layout')

@section('stylesheet')
  <style>
    .border-rad-10{
      border-radius: 10px!important;
    }
  </style>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">Welcome, Admin</h1>
    </div>
    <div class="col-12">
      <div class="row">
        <div class="col-12">
          <h4>Current Month</h4>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget border-rad-10">
            <div class="ms-card-body media">
              <div class="media-body m-3">
                <span class="black-text mb-2"><strong><b>Income</b></strong></span>
                <h2 class="text-right"> {{ $monthly['income'] }} TK</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget border-rad-10">
            <div class="ms-card-body media">
              <div class="media-body m-3">
                <span class="black-text mb-2"><strong><b>Product Sell</b></strong></span>
                <h2 class="text-right"> {{ $monthly['product'] }}</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget border-rad-10">
            <div class="ms-card-body media">
              <div class="media-body m-3">
                <a href="{{ route('admin.total_orders_this_month') }}">
                <span class="black-text mb-2"><strong><b>Total Order</b></strong></span>
                <h2 class="text-right"> {{ $monthly['total_order'] }}</h2>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget border-rad-10">
            <div class="ms-card-body media">
              <div class="media-body m-3">
                <a href="{{ route('admin.completed_orders_this_month') }}">
                <span class="black-text mb-2"><strong><b>Completed Order</b></strong></span>
                <h2 class="text-right"> {{ $monthly['completed'] }}</h2>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget border-rad-10">
            <div class="ms-card-body media">
              <div class="media-body m-3">
                <a href="{{ route('admin.pending_orders_this_month') }}">
                <span class="black-text mb-2"><strong><b>Pending Order</b></strong></span>
                <h2 class="text-right"> {{ $monthly['pending'] }}</h2>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget border-rad-10">
            <div class="ms-card-body media">
              <div class="media-body m-3">
                <a href="{{ route('admin.processing_orders_this_month') }}">
                <span class="black-text mb-2"><strong><b>Processing Order</b></strong></span>
                <h2 class="text-right"> {{ $monthly['processing'] }}</h2>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget border-rad-10">
            <div class="ms-card-body media">
              <div class="media-body m-3">
                <a href="{{ route('admin.delivered_orders_this_month') }}">
                <span class="black-text mb-2"><strong><b>Delivered Order</b></strong></span>
                <h2 class="text-right"> {{ $monthly['delivered'] }}</h2>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget border-rad-10">
            <div class="ms-card-body media">
              <div class="media-body m-3" style="color: red">
                <a href="{{ route('admin.canceled_orders_this_month') }}">
                <span class="black-text mb-2"><strong><b>Canceled Order</b></strong></span>
                <h2 class="text-right"> {{ $monthly['canceled'] }}</h2>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <h4>Customer Section</h4>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget border-rad-10">
            <div class="ms-card-body media">
              <div class="media-body m-3">
                <span class="black-text mb-2"><strong><b>New Customer</b></strong></span>
                <h2 class="text-right"> {{ $user['new'] }}</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget border-rad-10">
            <div class="ms-card-body media">
              <div class="media-body m-3">
                <a href="{{ route('admin.active_customer') }}">
                  <span class="black-text mb-2"><strong><b>Active Customer</b></strong></span>
                  <h2 class="text-right"> {{ $user['active'] }}</h2>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget border-rad-10">
            <div class="ms-card-body media">
              <div class="media-body m-3">
                <a href="{{ route('admin.inactive_customer') }}">
                  <span class="black-text mb-2"><strong><b>Incative Customer</b></strong></span>
                  <h2 class="text-right"> {{ $user['inactive'] }}</h2>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget border-rad-10">
            <div class="ms-card-body media">
              <div class="media-body m-3">
                <a href="{{ route('admin.view_customer') }}">
                  <span class="black-text mb-2"><strong><b>Total Customer</b></strong></span>
                  <h2 class="text-right"> {{ $user['total'] }}</h2>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{--order--}}
      <div class="row">

        <div class="col-12">
          <h4>Order Section</h4>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget border-rad-10">
            <div class="ms-card-body media">
              <div class="media-body m-3">
                <a href="{{ route('admin.new_orders') }}">
                  <span class="black-text mb-2"><strong><b>New Order</b></strong></span>
                  <h2 class="text-right"> {{ $order['new'] }}</h2>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget border-rad-10">
            <div class="ms-card-body media">
              <div class="media-body m-3">
                <a href="{{ route('admin.pending_orders') }}">
                  <span class="black-text mb-2"><strong><b>Pending Order</b></strong></span>
                  <h2 class="text-right"> {{ $order['pending'] }}</h2>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget border-rad-10">
            <div class="ms-card-body media">
              <div class="media-body m-3">
                <a href="{{ route('admin.processing_orders') }}">
                  <span class="black-text mb-2"><strong><b>Processing Order</b></strong></span>
                  <h2 class="text-right"> {{ $order['processing'] }}</h2>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget border-rad-10">
            <div class="ms-card-body media">
              <div class="media-body m-3">
                <a href="{{ route('admin.delivered_orders') }}">
                  <span class="black-text mb-2"><strong><b>Delivered Order</b></strong></span>
                  <h2 class="text-right"> {{ $order['delivered'] }}</h2>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget border-rad-10">
            <div class="ms-card-body media">
              <div class="media-body m-3">
                <a href="{{ route('admin.completed_orders') }}">
                  <span class="black-text mb-2"><strong><b>Completed Order</b></strong></span>
                  <h2 class="text-right"> {{ $order['completed'] }}</h2>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget border-rad-10">
            <div class="ms-card-body media">
              <div class="media-body m-3">
                <a href="{{ route('admin.canceled_orders') }}">
                  <span class="black-text mb-2"><strong><b>Canceled Order</b></strong></span>
                  <h2 class="text-right"> {{ $order['canceled'] }}</h2>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget border-rad-10">
            <div class="ms-card-body media">
              <div class="media-body m-3">
                <a href="{{ route('admin.order.view') }}">
                  <span class="black-text mb-2"><strong><b>Total Order</b></strong></span>
                  <h2 class="text-right"> {{ $order['total'] }}</h2>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{--Product--}}
      <div class="row">
        <div class="col-12">
          <h4>Product Section</h4>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget border-rad-10">
            <div class="ms-card-body media">
              <div class="media-body m-3">
                <span class="black-text mb-2"><strong><b>New Product</b></strong></span>
                <h2 class="text-right"> {{ $product['new'] }}</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget border-rad-10">
            <div class="ms-card-body media">
              <div class="media-body m-3">
                <a href="{{ route('admin.available_product') }}">
                  <span class="black-text mb-2"><strong><b>Available Product</b></strong></span>
                  <h2 class="text-right"> {{ $product['available'] }}</h2>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget border-rad-10">
            <div class="ms-card-body media">
              <div class="media-body m-3">
                <a href="{{ route('admin.stock_out_product') }}">
                  <span class="black-text mb-2"><strong><b>Stock Out Product</b></strong></span>
                  <h2 class="text-right"> {{ $product['stock_out'] }}</h2>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
          <div class="ms-card ms-widget has-graph-full-width ms-infographics-widget border-rad-10">
            <div class="ms-card-body media">
              <div class="media-body m-3">
                <a href="{{ route('admin.product.view') }}">
                  <span class="black-text mb-2"><strong><b>Total Product</b></strong></span>
                  <h2 class="text-right"> {{ $product['total'] }}</h2>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('script')
  <script src="{{ asset('assets/admin/js/Chart.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/admin/js/widgets.js') }}"></script>
@endsection
