@extends('layouts.admin_layout')

@section('stylesheet')
  <link href="{{ asset('assets/admin/css/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">Messages Log</h1>
    </div>
    <div class="col-12">
      <div class="ms-panel">
        <div class="ms-panel-body">
          @if(session()->has('status'))
            {!! session()->get('status') !!}
          @endif
          <div class="table-responsive">
            <table id="category_data_table" class="table w-100 thead-dark table-striped no-footer">
              <thead>
              <th width="20">Id</th>
              <th width="100">Mobile No</th>
              <th>Message</th>
              <th width="30">Status</th>
              <th width="160">Created At</th>
              </thead>
              <tbody>
              @foreach($messages as $value)
                <tr class="gradeX">
                  <td width="20">{{ $loop->iteration }}</td>
                  <td>{{ $value->number }}</td>
                  <td><small>{{ $value->body }}</small></td>
                  <td class="text-capitalize">{{ $value->status }}</td>
                  <td width="140">{{ date('F d, Y h:i A', strtotime($value->created_at)) }}</td>
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
  <script src="{{ asset('assets/admin/js/datatables.min.js') }}"></script>

  <script>
    $( document ).ready(function() {
      $('#category_data_table').DataTable();
    })
  </script>
@endsection