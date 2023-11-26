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
        display: block;
    }
    .card:hover{
      box-shadow: 0 4px 4px 4px #9dcb9b;
    }

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
      <span class="page_title">Wishlist</span>
    </div>

    <div class="table-responsive col-12 card pt-20 pb-20">
      @if(session()->has('status'))
        {!! session()->get('status') !!}
      @endif
      <table id="data-tables" class="table table-striped table-bordered" style="min-width:100%">
        <thead>
        <tr>
          <th width="30px">#No</th>
          <th>Image</th>
          <th>Name</th>
          <th>Price</th>
          <th>Status</th>
          <th width="140px">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($wishlists as $key => $wishlist)
          <tr>
            <td>{{ ++$key }}</td>
{{--            <td>{{ date('F jS, Y', strtotime($wishlist->created_at)) }}</td>--}}
            <td><img src="{{ asset($wishlist->product_image) }}" width="45px" height="45px" alt="{{ $wishlist->product_name }}"></td>
            <td>{{ $wishlist->product_name }}</td>
            <td>{{ ($wishlist->product_price > 0) ? $wishlist->product_price : "Call For Price" }}</td>
            <td>{{ ($wishlist->product_quantity > 0) ? "Available" : "Stock Out" }}</td>
            <td>
              <a href="{{ route('product.details', $wishlist->product_slug) }}" class="btn btn-success btn-sm">Details</a>
              <span data-url="{{ route('customer.wishlist.remove', $wishlist->id) }}" class="btn btn-danger btn-sm delete-wishlist"><i class="fa fa-trash"></i></span>
            </td>
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

      $(document).on('click', '.delete-wishlist', function () {
        var url = $(this).data('url');
        var $this = $(this);
        $.ajax({
          url: url,
          method: "get",
          dataType: "html",
          success: function (data) {
            if (data === "success"){
              $this.closest('tr').css('background-color', 'red').fadeOut();
            }
          }
        });
      })

    });
  </script>
@endsection
