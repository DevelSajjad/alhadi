@extends('layouts.admin_layout')

@section('stylesheet')
  <link href="{{ asset('assets/admin/css/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">View Moderator</h1>
    </div>
    <div class="col-12">
      <div class="ms-panel">
        <div class="ms-panel-body">
          <div class="form-group text-right">
            <a href="{{ route('admin.moderator.add') }}" class="btn btn-outline-success btn-sm mb-2">Add new</a>
          </div>
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
              <th>Status</th>
              <th width="30">Options</th>
              </thead>
              <tbody>
              @foreach($moderators as $key => $value)
                <tr class="gradeX">
                  <td width="30">{{ ++$key }}</td>
                  <td><img src="{{ asset($value->image) }}" alt="{{ $value->slug }}" height="100px" width="100px"></td>
                  <td>{{ $value->name }}</td>
                  <td>{{ $value->email }}</td>
                  <td>{{ $value->mobile_no }}</td>
                  <td>{{ $value->status }}</td>
                  <td width="30">
                    <a href="{{ route('admin.moderator.edit', $value->id) }}" class="btn btn-outline-info btn-sm m-0 p-1 mr-1" style="min-width: 0px;">
                      <i class="fa fa-edit m-0 p-0"></i>
                    </a>
                    <span class="btn btn-delete btn-outline-danger btn-sm m-0 p-1 delete_{{ $value->id }}" data-id="{{ $value->id }}" style="min-width: 0px;">
                        <i class="fa fa-trash m-0 p-0"></i>
                      </span>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>



    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4>Delete Moderator</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <strong>Are you sure to delete this Moderator?</strong>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-success btn-sm yes-btn">Yes</button>
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


      $(document).on('click', '.yes-btn', function () {
        var pid = $(this).data('id');
        var $this = $('.delete_'+pid)
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          url: "{{ route('admin.moderator.delete') }}",
          method: "delete",
          dataType: "html",
          data: {id: pid},
          success: function (data) {
            if (data === "success"){
              $('#exampleModal').modal('hide')
              $this.closest('tr').css('background-color', 'red').fadeOut();
            }
          }
        });
      })
      $(document).on('click', '.btn-delete', function () {
        var pid = $(this).data('id');
        $('.yes-btn').data('id', pid);
        $('#exampleModal').modal('show')

      });
    })
  </script>
@endsection