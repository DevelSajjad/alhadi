@extends('layouts.admin_layout')

@section('stylesheet')
  <link href="{{ asset('assets/admin/css/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">View Order</h1>
    </div>
    <div class="col-12">
      <div class="ms-panel">
        {{--<div class="ms-panel-header">--}}
        {{--<h6>Basic Form Elements</h6>--}}
        {{--</div>--}}
        <div class="ms-panel-body">
          <div class="form-group text-right">
            <a href="{{ route('admin.product.add') }}" class="btn btn-outline-success btn-sm mb-2">Add new</a>
          </div>
          <div class="row m-3">
            <div  class="p-1 h4">
              <span>Filter By</span>
            </div>
            <div class="">
              <form action="{{ route('admin.order.view') }}" method="GET">
                <input type="hidden" name="search_by" value="status">
                <select name="order_status" class="form-control" style="width: 250px">
                  <option value="" selected>Select a Status</option>
                  <option value="Pending" @if(strtolower($request->order_status) == 'pending') selected @endif>Pending</option>
                  <option value="Processing" @if(strtolower($request->order_status) == 'processing') selected @endif>Processing</option>
                  <option value="Delivered" @if(strtolower($request->order_status) == 'delivered') selected @endif>Delivered</option>
                  <option value="Completed" @if(strtolower($request->order_status) == 'completed') selected @endif>Completed</option>
                  <option value="Canceled" @if(strtolower($request->order_status) == 'canceled') selected @endif>Canceled</option>
                </select>
              </form>
            </div>
            <div class="ml-3">
              <form action="{{ route('admin.order.view') }}" method="GET">
                <input type="hidden" name="search_by" value="payment_status">
                <select name="payment_status" class="form-control" style="width: 250px">
                  <option value="" selected>Select Payment Status</option>
                  <option value="paid" @if(strtolower($request->payment_status) == 'paid') selected @endif>Paid</option>
                  <option value="unpaid" @if(strtolower($request->payment_status) == 'unpaid') selected @endif>Unpaid</option>
                </select>
              </form>
            </div>
          </div>
          @if(session()->has('status'))
            {!! session()->get('status') !!}
          @endif

          <div class="table-responsive">
            <table id="category_data_table" class="table w-100 thead-dark table-striped no-footer">
              <thead>
              <th width="20">Id</th>
              <th width="140">Date</th>
              <th>User Name</th>
              <th width="80">Contact NO</th>
              <th width="50">Amount</th>
              <th>Delivered By</th>
              <th width="50">Payment Status</th>
              <th width="70">Status</th>
              <th width="30">Options</th>
              </thead>
              <tbody>
                @foreach($orders as $value)
                  <tr class="gradeX">
                    <td width="20">{{ $value->id }}</td>
                    <td width="140">{{ date('F d, Y h:i A', strtotime($value->created_at)) }}</td>
                    <td>{{ $value->customer_name ?? $value->billing_name }}</td>
                    <td>{{ $value->customer_contact_no ?? $value->billing_phone}}</td>
                    <td>{{ $value->amount }} TK</td>
                    <td>{{ isset($value->delivered_by) ? $value->delivered_by : "N/A"  }}</td>
                    <td class="text-capitalize">{{ $value->payment_status }}</td>
                    <td>
                      <form action="{{ route('admin.order.change.status') }}" method="POST" class="d-flex">
                        @csrf
                        <input type="hidden" name="id" value="{{ $value->id }}">
                        <select name="status" class="p-0 m-0" data-id="{{ $value->id }}" style="width: 120px">
                          <option value="" selected>Select one</option>
                          <option value="Pending" @if(strtolower($value->status) == 'pending') selected @endif>Pending</option>
                          <option value="Processing" @if(strtolower($value->status) == 'processing') selected @endif>Processing</option>
                          <option value="Delivered" @if(strtolower($value->status) == 'delivered') selected @endif>Delivered</option>
                          <option value="Completed" @if(strtolower($value->status) == 'completed') selected @endif>Completed</option>
                          <option value="Canceled" @if(strtolower($value->status) == 'canceled') selected @endif>Canceled</option>
                        </select>
                      </form>
                    </td>
                    <td width="30">
                      <a href="{{ route('admin.order.details', $value->id) }}" class="btn btn-sm btn-outline-success m-0 p-2" style="min-width: 0px">Details{{--<span class="fa fa-atlas"></span>--}}</a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="productDeleteModal" tabindex="-1" role="dialog" aria-labelledby="productDeleteModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4>Change order status to Delivered</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('admin.order.add.deliveredby') }}" method="post">
            @csrf
            <input type="hidden" name="id" id="order_delivered_id">
            <div class="modal-body">
              <label for="">Name <span class="text-danger">*</span></label><br>
              <input type="text" class="form-control" name="name" placeholder="Name of the delivery boy" required>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
              <button type="submit" class="btn btn-success btn-sm yes-btn">Yes</button>
            </div>
          </form>
        </div>
      </div>
    </div>


  </div>
@endsection


@section('script')
  {{--<script src="{{ asset('assets/admin/js/jquery-3.3.1.min.js') }}"></script>--}}
  <script src="{{ asset('assets/admin/js/datatables.min.js') }}"></script>

  <script>
    $( document ).ready(function() {
      $('#category_data_table').DataTable({
        order: [[ 0, "desc" ]],
      });

      $(document).on('change', 'select[name="status"]', function () {
        var value = $(this).val();
        if(value === 'Delivered' || value === 'delivered' || value == 'Delivered' || value == 'delivered' ){
          const product_id = $(this).data('id')
          $('#order_delivered_id').val(product_id)
          $('#productDeleteModal').modal('show')
        }else{
          $(this).parent('form').submit()
        }
      })

      $(document).on('change', 'select[name="order_status"]', function () {
        if($(this).val() !== '') {
          $(this).parent('form').submit()
        }
      })
      $(document).on('change', 'select[name="payment_status"]', function () {
        if($(this).val() !== '') {
          $(this).parent('form').submit()
        }
      })
    })
  </script>
@endsection