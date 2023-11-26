@extends('layouts.admin_layout')

@section('stylesheet')
  <link href="{{ asset('assets/admin//css/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">View Notice</h1>
    </div>
    <div class="col-12">
      <div class="ms-panel">
        {{--<div class="ms-panel-header">--}}
        {{--<h6>Basic Form Elements</h6>--}}
        {{--</div>--}}
        <div class="ms-panel-body">
          <div class="form-group text-right">
            <a href="{{ route('admin.notice.add') }}" class="btn btn-outline-success btn-sm mb-2">Add new</a>
          </div>
          @if(session()->has('status'))
            {!! session()->get('status') !!}
          @endif

          <div class="table-responsive">
            <table id="category_data_table" class="table w-100 thead-dark table-striped no-footer">
              <thead>
                <th width="30">#</th>
                <th>Title</th>
                <th>Created At</th>
                <th>Status</th>
                <th width="30">Options</th>
              </thead>
              <tbody>
                <?php $id = 0; ?>
                @foreach($notices as $value)
                  <tr class="gradeX">
                    <td width="30">{{ ++$id }}</td>
                    <td>{{ $value->title }}</td>
                    <td>{{ date('F d, Y H:i:s A', strtotime($value->created_at)) }}</td>
                    <td class="text-capitalize">{{ $value->status }}</td>
                    <td width="30">
                      <div class="d-flex">
                        <a href="{{ route('admin.notice.edit', $value->id) }}" class="btn btn-outline-info btn-sm m-0 p-1 mr-1" style="min-width: 0px;">
                          <i class="fa fa-edit m-0 p-0"></i>
                        </a>
                        <span class="btn btn-delete btn-outline-danger btn-sm m-0 p-1 delete_{{ $value->id }}" data-id="{{ $value->id }}" style="min-width: 0px;">
                          <i class="fa fa-trash m-0 p-0"></i>
                        </span>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="categoryDeleteModal" tabindex="-1" role="dialog" aria-labelledby="bannerDeleteModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4>Delete Notice</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <strong>Are you sure to delete this Notice?</strong>
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

      $('#category_data_table').DataTable();

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $(document).on('click', '.yes-btn', function () {
        var pid = $(this).data('id');
        var $this = $('.delete_'+pid)
        $.ajax({
          url: "{{ route('admin.notice.delete') }}",
          method: "delete",
          dataType: "html",
          data: {id: pid},
          success: function (data) {
            if (data === "success"){
              $('#categoryDeleteModal').modal('hide')
              $this.closest('tr').css('background-color', 'red').fadeOut();
            }
          }
        });
      })
      $(document).on('click', '.btn-delete', function () {
        var pid = $(this).data('id');
        $('.yes-btn').data('id', pid);
        $('#categoryDeleteModal').modal('show')

      });
    })
  </script>
@endsection