@extends('layouts.admin_layout')

@section('stylesheet')
  <link href="{{ asset('assets/admin/css/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">VIew Customer</h1>
    </div>
    <div class="col-12">
      <div class="ms-panel">
        <div class="ms-panel-body">
          @if(session()->has('status'))
            {!! session()->get('status') !!}
          @endif

          <div class="table-responsive">
            <table id="brand_data_table" class="table w-100 thead-dark table-striped no-footer">
              <thead>
              <th width="30">#</th>
              <th width="100">Image</th>
              <th>Name</th>
              <th>Email</th>
              <th>Mobile No</th>
              <th width="160">Create At</th>
              </thead>
              <tbody>
              @foreach($customers as $key => $value)
                <tr class="gradeX">
                  <td width="30">{{ ++$key }}</td>
                  <td><img src="{{ asset($value->image) }}" alt="{{ $value->slug }}" height="100px" width="100px"></td>
                  <td>{{ $value->name }}</td>
                  <td>{{ $value->email }}</td>
                  <td>{{ $value->mobile_no }}</td>
                  <td width="160">{{ date('F d, Y h:i A', strtotime($value->created_at)) }}</td>
                  {{--<td width="30">--}}
                  {{--<a href="{{ route('admin.moderator.edit', $value->id) }}" class="btn btn-outline-info btn-sm m-0 p-1 mr-1" style="min-width: 0px;">--}}
                  {{--<i class="fa fa-edit m-0 p-0"></i>--}}
                  {{--</a>--}}
                  {{--<span class="btn btn-delete btn-outline-danger btn-sm m-0 p-1 delete_{{ $value->id }}" data-id="{{ $value->id }}" style="min-width: 0px;">--}}
                  {{--<i class="fa fa-trash m-0 p-0"></i>--}}
                  {{--</span>--}}
                  {{--</td>--}}
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
      $('#brand_data_table').DataTable();
    })
  </script>
@endsection