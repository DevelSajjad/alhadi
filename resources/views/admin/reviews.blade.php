@extends('layouts.admin_layout')

@section('stylesheet')
  <link href="{{ asset('assets/admin//css/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">Review</h1>
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
              <th width="25">#</th>
              <th width="200">Customer</th>
              <th width="15">Rating</th>
              <th>Comment</th>
              <th width="200">Time</th>
              </thead>
              <tbody>
              <?php $id = 0; ?>
              @foreach($reviews as $value)
                <tr class="gradeX">
                  <td width="30">{{ ++$id }}</td>
                  <td>
                    <img src="{{ asset($value->image) }}" alt="{{ $value->name }}" width="100px" height="100px">
                    {{ $value->name }}</td>
                  <td>{{ $value->rating }}</td>
                  <td><p style="font-size: 12px">{{ $value->message }}</p></td>
                  <td>{{ date('F d, Y H:i:s A', strtotime($value->created_at)) }}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="productDeleteModal" tabindex="-1" role="dialog" aria-labelledby="productDeleteModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4>Delete Product</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <strong>Are you sure to delete this Product?</strong>
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
          url: "{{ route('admin.product.delete') }}",
          method: "delete",
          dataType: "html",
          data: {id: pid},
          success: function (data) {
            if (data === "success"){
              $('#productDeleteModal').modal('hide')
              $this.closest('tr').css('background-color', 'red').fadeOut();
            }
          }
        });
      })

      $(document).on('click', '.btn-delete', function () {
        var pid = $(this).data('id');
        $('.yes-btn').data('id', pid);
        $('#productDeleteModal').modal('show')

      });
    })
  </script>
@endsection