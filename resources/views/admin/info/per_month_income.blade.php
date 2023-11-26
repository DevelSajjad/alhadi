@extends('layouts.admin_layout')

@section('stylesheet')
  <link href="{{ asset('assets/admin/css/datatables.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/frontend/plugins/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/admin//css/jquery-ui.min.css') }}" rel="stylesheet">
  <script src="{{ asset('assets/frontend/plugins/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/admin/js/moment.js') }}"></script>
  
  <script src="{{ asset('assets/frontend/plugins/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

@endsection


@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">View Datewise Report</h1>
    </div>
  </div>

  <div class="row">

    {{-- Filter Area --}}
    <div class="col-md-12"> 
      <form action="{{ route('admin.search') }}" method="Post">
        @csrf
        <div class="row filter-area">
          <div class="col-md-4">
            <div class="form-group">
              <label for="dateFrom">From</label>
              <input type="date" name="fromDate" id="fromDate" class="form-control" placeholder="dd/mm/yy">
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="dateTo">To</label>
              <input type="date" name="toDate" id="toDate" class="form-control" placeholder="dd/mm/yy">
            </div>
          </div>
          <div class="col-md-4">
              <button type="submit" class="btn btn-success" style="margin-top: 1.7rem">Apply</button>
          </div>
        </div>
      </form>
    </div>

    {{-- Table Area --}}
    <div class="col-md-12 table-area mt-3">
      <div class="ms-panel">
        <div class="table-responsive">
          <table id="category_data_table" class="table w-100 thead-dark table-striped no-footer">
            <thead>
            <th >Income</th>
            <th >Product Sell</th>
            <th>Total Order</th>
            <th >Completed Order</th>
            <th >Pending Order</th>
            {{-- <th >Processing Order</th> --}}
            {{-- <th >Delivered Order</th> --}}
            {{-- <th >Canceled Order</th> --}}
            </thead>
            <tbody>
            
              <tr class="gradeX">
                  <td>{{ $monthly['income'] }} TK</td>
                  <td>{{ $monthly['product'] }}</td>
                  <td>{{ $monthly['total_order'] }}</td>
                  <td>{{ $monthly['completed'] }}</td>
                  <td>{{ $monthly['pending'] }}</td>
                  {{-- <td>{{ $monthly['processing'] }}</td> --}}
                  {{-- <td>{{ $monthly['delivered'] }}</td> --}}
                  {{-- <td>{{ $monthly['canceled'] }}</td> --}}
             
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    {{-- Table End --}}
  </div>
@endsection

@section('script')
  {{--<script src="{{ asset('assets/admin/js/jquery-3.3.1.min.js') }}"></script>--}}
  <script src="{{ asset('assets/admin/js/datatables.min.js') }}"></script>
  <script src="{{ asset('assets\frontend\plugins\bootstrap-datetimepicker\build\js\bootstrap-datetimepicker.min.js') }}"></script>

  <script>
    $( document ).ready(function() {
      $('#category_data_table').DataTable({
        order: [[ 0, "desc" ]],
      });

      $(document).on('change', 'select[name="status"]', function () {
        $(this).parent('form').submit()
      })
      $('.input-daterange').datepicker({
  todayBtn:'linked',
  format:'yyyy-mm-dd',
  autoclose:true
 });

 load_data();



    })
  </script>
@endsection