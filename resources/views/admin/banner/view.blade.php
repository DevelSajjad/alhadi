@extends('layouts.admin_layout')

@section('stylesheet')
  <link href="{{ asset('assets/admin//css/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">View Banner</h1>
    </div>
    <div class="col-12">
      <div class="ms-panel">
        {{--<div class="ms-panel-header">--}}
        {{--<h6>Basic Form Elements</h6>--}}
        {{--</div>--}}
        <div class="ms-panel-body">
          <div class="form-group text-right">
            <a href="{{ route('admin.banner.add') }}" class="btn btn-outline-success btn-sm mb-2">Add new</a>
          </div>
          @if(session()->has('status'))
            {!! session()->get('status') !!}
          @endif

          <div class="table-responsive">
            <table id="banner_data_table" class="table w-100 thead-dark table-striped no-footer">
              <thead>
                <th width="30">#</th>
                <th>Image</th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>Status</th>
                <th width="30">Options</th>
              </thead>
              <tbody>
                <?php $id = 0; ?>
                @foreach($banners as $value)
                  <tr class="gradeX">
                    <td width="30">{{ ++$id }}</td>
                    <td><img style="max-width: 100px;  border-radius: 0;" src="{{ asset($value->image) }}" alt=""></td>
                    <td>{{ $value->name }}</td>
                    <td><img style="max-width: 100px;  border-radius: 0;" src="{{ asset($value->product_image) }}" alt=""></td>
                    <td>
                      <label class="ms-switch">
                        <input type="checkbox" class="change-status" @if($value->status == "active")checked @endif data-id="{{ $value->id }}"> <span class="ms-switch-slider ms-switch-success round"></span>
                      </label>
                    </td>
                    <td width="30">
                      <a href="{{ route('admin.banner.edit', $value->id) }}" class="btn btn-outline-info btn-sm m-0 p-1 mr-1" style="min-width: 0px;">
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

    <div class="modal fade" id="bannerDeleteModal" tabindex="-1" role="dialog" aria-labelledby="bannerDeleteModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4>Delete Banner</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <strong>Are you sure to delete this Banner?</strong>
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
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $('#banner_data_table').DataTable();

      $(document).on('click', '.yes-btn', function () {
        var pid = $(this).data('id');
        var $this = $('.delete_'+pid)
        $.ajax({
          url: "{{ route('admin.banner.delete') }}",
          method: "delete",
          dataType: "html",
          data: {id: pid},
          success: function (data) {
            if (data === "success"){
              $('#bannerDeleteModal').modal('hide')
              $this.closest('tr').css('background-color', 'red').fadeOut();
            }
          }
        });
      })
      $(document).on('click', '.btn-delete', function () {
        var pid = $(this).data('id');
        $('.yes-btn').data('id', pid);
        $('#bannerDeleteModal').modal('show')

      });



      $(document).on('change', '.change-status', function () {
        var status = 'inactive';
        var id = $(this).data('id')
        var isChecked = $(this).is(":checked");
        if(isChecked){
          status = 'active';
        }
        $.ajax({
          url: "{{ route('admin.ajax.banner.change_banner_status') }}",
          method: "post",
          dataType: "html",
          data: {id, status},
          success: function (data) {
            if (data === "success"){
            // console.log(data)
            //   $(this).removeProp('checked');
            }
          }
        });
      })
    })
  </script>
@endsection