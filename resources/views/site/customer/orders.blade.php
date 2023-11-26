@extends('layouts.customer_layout')

@section('customer.stylesheet')

  <link rel="stylesheet" href="{{ asset("assets/frontend/css/bootstrap.min.css") }}">
  <link rel="stylesheet" href="{{ asset("assets/frontend/css/dataTables.bootstrap.min.css") }}">

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
        display: block !important;
    }
    .card:hover{
      box-shadow: 0 4px 4px 4px #9dcb9b;
    }

    /*table{*/
      /*text-align: center;*/
      /*min-width: 100%;*/
    /*}*/
    /*table th {*/
      /*text-align: center;*/
      /*font-size: 13px;*/
      /*background: #b9c9fe;*/
      /*border-top: 4px solid #aabcfe;*/
      /*border-bottom: 1px solid #c8c6c6;*/
      /*border-right: 1px solid #c8c6c6;*/
      /*border-left: 1px solid #c8c6c6;*/
      /*color: black;*/
      /*font-weight: bold;*/
      /*padding: 8px;*/
    /*}*/
    /*table tr {*/
      /*border-bottom: 1px solid #c8c6c6;*/
      /*border-left: 1px solid #c8c6c6;*/
      /*color: black;*/
      /*padding: 8px;*/
      /*vertical-align: inherit;*/
    /*}*/
    /*table td {*/
      /*border-right: 1px solid #c8c6c6;*/
      /*color: black;*/
      /*padding: 8px;*/
    /*}*/
    @media (max-width: 767px)
  {
   .partialResponsive {
    display: block !important;
   }

   .HambButton{
    left: 0px !important;
   }
  }
  </style>
@endsection

@section('customer.content')
  <div class="row">
    <div class="col-12 text-center mb-40">
      <span class="page_title">Orders</span>
    </div>

    <div class="table-responsive col-12 card pt-20 pb-20">
      @if(session()->has('status'))
        {!! session()->get('status') !!}
      @endif
      <table id="data-tables" class="table table-striped table-bordered" style="min-width:100%">
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Date</th>
            <th>Amount</th>
            <th>Area</th>
            <th>Status</th>
            <th width="100px">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $order)
            <tr>
              <td>{{ $order->id }}</td>
              <td>{{ date('F jS, Y', strtotime($order->created_at)) }}</td>
              <td>{{ $order->amount }} TK</td>
              <td class="text-capitalize">{{ $order->area }}</td>
              <td class="text-capitalize">{{ $order->status }}</td>
              <td><a href="{{ route('customer.orderDetails', $order->id) }}" class="btn btn-success btn-sm">Details</a></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>


  </div>
@endsection

@section('customer.script')
  {{--<script type="text/javascript" src="{{ asset("assets/frontend/plugins/jquery/dist/jquery.min.js") }}"></script>--}}
  <script src="{{ asset("assets/frontend/js/jquery.dataTables.min.js") }}"></script>
  <script src="{{ asset("assets/frontend/js/dataTables.bootstrap.min.js") }}"></script>

  <script>
    $(document).ready(function() {
      $('#data-tables').DataTable({
        order: [[ 0, "desc" ]],
      });
    } );
  </script>
@endsection
