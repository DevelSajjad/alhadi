@extends('layouts.admin_layout')

@section('stylesheet')
  <link href="{{ asset('assets/admin//css/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">View Sub Category</h1>
    </div>
    <div class="col-12">
      <div class="ms-panel">
        {{--<div class="ms-panel-header">--}}
        {{--<h6>Basic Form Elements</h6>--}}
        {{--</div>--}}
        <div class="ms-panel-body">
          <div class="form-group text-right">
            <a href="{{ route('admin.sub-category.add') }}" class="btn btn-outline-success btn-sm mb-2">Add new</a>
          </div>
          @if(session()->has('status'))
            {!! session()->get('status') !!}
          @endif

          <div class="table-responsive">
            <table id="sub-category_data_table" class="table w-100 thead-dark table-striped no-footer">
              <thead>
                <th width="30">#</th>
                <th>Name</th>
                <th>Category</th>
                <th width="30">Options</th>
              </thead>
              <tbody>
                <?php $id = 0; ?>
                @foreach($sub_categories as $value)
                  <tr class="gradeX">
                    <td width="30">{{ ++$id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->category }}</td>
                    <td width="30">
                      <a href="{{ route('admin.sub-category.edit', $value->slug) }}" class="btn btn-outline-info btn-sm m-0 p-1 mr-1" style="min-width: 0px;">
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

    <div class="modal fade" id="subCategoryDeleteModal" tabindex="-1" role="dialog" aria-labelledby="subCategoryDeleteModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4>Delete Sub-Category</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <strong>Are you sure to delete this Sub-Category?</strong>
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
      $('#sub-category_data_table').DataTable();

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $(document).on('click', '.yes-btn', function () {
        var pid = $(this).data('id');
        var $this = $('.delete_'+pid)
        $.ajax({
          url: "{{ route('admin.sub-category.delete') }}",
          method: "delete",
          dataType: "html",
          data: {id: pid},
          success: function (data) {
            if (data === "success"){
              $('#subCategoryDeleteModal').modal('hide')
              $this.closest('tr').css('background-color', 'red').fadeOut();
            }
          }
        });
      })

      $(document).on('click', '.btn-delete', function () {
        var pid = $(this).data('id');
        $('.yes-btn').data('id', pid);
        $('#subCategoryDeleteModal').modal('show')

      });



      {{--$(document).on('click', '.btn-delete', function () {--}}
        {{--var $this = $(this);--}}
        {{--var pid = $this.data('id');--}}
        {{--console.log(pid)--}}
        {{--$.ajaxSetup({--}}
          {{--headers: {--}}
            {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
          {{--}--}}
        {{--});--}}
        {{--$.ajax({--}}
          {{--url: "{{ route('admin.sub-category.delete') }}",--}}
          {{--method: "delete",--}}
          {{--dataType: "html",--}}
          {{--data: {id: pid},--}}
          {{--success: function (data) {--}}
            {{--console.log(data)--}}
            {{--if (data === "success"){--}}
              {{--$this.closest('tr').css('background-color', 'red').fadeOut();--}}
            {{--}--}}
          {{--}--}}
        {{--});--}}
      {{--});--}}
    })
  </script>
@endsection