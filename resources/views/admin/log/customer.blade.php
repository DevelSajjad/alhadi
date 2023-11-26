@extends('layouts.admin_layout')

@section('stylesheet')
  {{--<link href="{{ asset('assets/admin/css/datatables.min.css') }}" rel="stylesheet">--}}
  <link href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css" rel="stylesheet">
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">Customer List</h1>
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
              <th>Name</th>
              <th>Email</th>
              <th>Mobile No</th>
              <th width="200">Created At</th>
              </thead>
              <tbody>
              @foreach($customers as $value)
                <tr class="gradeX">
                  <td width="20">{{ $loop->iteration }}</td>
                  <td class="text-capitalize">{{ $value->name }}</td>
                  <td>{{ $value->email ?? "N\A" }}</td>
                  <td>{{ $value->mobile_no }}</td>
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
  {{--<script src="{{ asset('assets/admin/js/datatables.min.js') }}"></script>--}}





  <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
  <script>
    $( document ).ready(function() {
      $('#category_data_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'excel', 'pdf'
        ]
      });
    })
  </script>
@endsection