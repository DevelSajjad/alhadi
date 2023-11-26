@extends('layouts.admin_layout')

@section('stylesheet')
  <link href="{{ asset('assets/admin//css/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">View Logs</h1>
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
              <th width="30">#</th>
              <th width="170">Date</th>
              <th>User Name</th>
              <th width="60">Order ID</th>
              <th>Old Status</th>
              <th>New Status</th>
              </thead>
              <tbody>
              @foreach($logs as $key => $value)
                <tr class="gradeX">
                  <td width="30">{{ ++$key }}</td>
                  <td>{{ date('F d, Y H:i:s A', strtotime($value->created_at)) }}</td>
                  <td>{{ $value->name }}</td>
                  <td>Order-{{ $value->order_id }}</td>
                  <td class="text-capitalize">{{ $value->old_status }}</td>
                  <td class="text-capitalize">{{ $value->new_status }}</td>
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
    })
  </script>
@endsection