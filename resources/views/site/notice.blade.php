@extends('layouts.frontend_layout')


@section('stylesheet')
  <style>
    .modal{
      z-index: 999999!important;
    }
  </style>

@endsection


@section('content')

  <div class="m-20">
    <div class="card">
      <div class="card-header text-center">
        <h2>Notice</h2>
      </div>
      <div class="card-body">
          <div class="table-responsive pt-20 pb-20">
            @if(session()->has('status'))
              {!! session()->get('status') !!}
            @endif
            <table id="data-tables" class="table table-striped table-bordered" style="min-width:100%">
              <thead>
              <tr>
                <th width="100">ID</th>
                <th>Title</th>
                <th width="150">File</th>
                <th width="100">Option</th>
              </tr>
              </thead>
              <tbody>
              @foreach($notices as $key => $notice)
                <tr>
                  <td>{{ ($key + 1) }}</td>
                  {{--<td>{{ date('F jS, Y', strtotime($order->created_at)) }}</td>--}}
                  <td class="text-capitalize">{!!$notice->title !!}</td>
                  <td class="text-capitalize"><a href="{{ asset($notice->file) }}" download>Download</a></td>
                  <td>
                    <a
                      class="btn btn-success btn-sm view_details"
                      data-title="{{ $notice->title }}"
                      data-description="{{ $notice->description }}"
                    >Details</a>
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>

  <div class="modal" id="notice_details" tabindex="-1" role="dialog" style="z-index: 999999!important;">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Notice Details</h5>
        </div>
        <div class="modal-body">
          <h3 class="mb-20" id="notice_title"></h3>
          <div id="notice_description"></div>
        </div>
        <div class="modal-footer">
          {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $(document).ready(function () {
      $(document).on('click', '.view_details', function () {
        var $title = $(this).data('title')
        var $description = $(this).data('description')

        $('#notice_title').html($title)
        $('#notice_description').html($description)

        $('#notice_details').modal('show')
        // $('#notice_details').addClass('on-top')

      })
    })
  </script>
@endsection
