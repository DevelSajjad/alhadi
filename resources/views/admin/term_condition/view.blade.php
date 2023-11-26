@extends('layouts.admin_layout')

@section('stylesheet')
  <link href="{{ asset('assets/admin//css/datatables.min.css') }}" rel="stylesheet">
  <style>
    .mb-40 {
      margin-bottom: 50px;
    }
  </style>
@endsection

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="ms-panel">
        @include('flash_messages')
      </div>
      <div class="ms-panel">
        {{--<div class="ms-panel-header">--}}
        {{--<h6>Basic Form Elements</h6>--}}
        {{--</div>--}}
        <div class="ms-panel-body">
          {{-- <div class="col-sm-3">
            <select onChange="window.location.href=this.value"  class="form-control">
              <option selected value="{{ route('admin.policy.view') }}">English</option>
              <option value="{{ route('admin.policy.viewBN') }}">বাংলা</option>
            </select>
          </div> --}}
          <div class="form-group text-right">
            <a href="{{ route('admin.term.update') }}" class="pull-right btn btn-outline-success btn-sm mb-2">Update Term & Condition</a>
          </div>
          <div class="col-md-12">
            <h2 class="db-header-title" id="title">{{$term-> title_en}}</h2>
          </div>
          <div class="col-md-12 mb-40">
            <h3>Overview</h3>
            <span id="overview">{!! $term-> overview !!}</span>
          </div>

          <div class="col-md-12">
            <h3>Terms and Condition</h3>
            <span id="description">{!! $term-> description !!}</span>
          </div>
        </div>
      </div>
    </div>



  </div>
@endsection


@section('script')
{{--  <script src="{{ asset('assets/admin/js/jquery-3.3.1.min.js') }}"></script>--}}
{{--  <script src="{{ asset('assets/admin/js/datatables.min.js') }}"></script>--}}

{{--  <script>--}}
{{--    var title_en = "<?php echo $policy-> title_en; ?>";--}}
{{--    const title_bn = "<?php echo $policy-> title_en; ?>";--}}
{{--    $(document).ready(function () {--}}
{{--      $("#language").on('change', function () {--}}
{{--        var value = $(this).val();--}}
{{--        if (value == "english"){--}}
{{--          $("#title").text("<?php echo $policy-> title_en; ?>");--}}
{{--          $("#description").text("<?php echo $policy-> description_en; ?>");--}}
{{--        }else {--}}
{{--          $("#title").text("<?php echo $policy-> title_bn; ?>");--}}
{{--          $("#description").text("<?php echo $policy-> description_bn; ?>");--}}
{{--        }--}}
{{--      })--}}

{{--    })--}}
{{--  </script>--}}
@endsection
