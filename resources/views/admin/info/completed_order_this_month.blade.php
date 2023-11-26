@extends('layouts.admin_layout')

@section('stylesheet')
  <link href="{{ asset('assets/admin/css/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">View Completed Order of {{ date('F', strtotime($now)) }}</h1>
    </div>
    <div class="col-12">
      <div class="ms-panel">
        {{--<div class="ms-panel-header">--}}
        {{--<h6>Basic Form Elements</h6>--}}
        {{--</div>--}}
        <div class="ms-panel-body">
          @if(session()->has('status'))
            {!! session()->get('status') !!}
          @endif

          <div class="table-responsive">
            <table id="category_data_table" class="table w-100 thead-dark table-striped no-footer">
              <thead>
              <th width="30">Id</th>
              <th width="70">Date</th>
              <th>User Name</th>
              <th width="80">Contact NO</th>
              <th width="50">Amount</th>
              <th width="110">Payment Status</th>
              <th width="70">Status</th>
              <th width="30">Options</th>
              </thead>
              <tbody>
              @foreach($completed_orders as $value)
                <tr class="gradeX">
                  <td width="30">{{ $value->id }}</td>
                  <td>{{ date('F d, Y', strtotime($value->created_at)) }}</td>
                  <td>{{ $value->customer_name }}</td>
                  <td>{{ $value->customer_contact_no }}</td>
                  <td>{{ $value->amount }} TK</td>
                  <td class="text-capitalize">{{ $value->payment_status }}</td>
                  <td>
                    <form action="{{ route('admin.order.change.status') }}" method="POST" class="d-flex">
                      @csrf
                      <input type="hidden" name="id" value="{{ $value->id }}">
                      <select name="status" class="p-0 m-0" style="width: 120px">
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
        $(this).parent('form').submit()
      })
    })
  </script>
@endsection