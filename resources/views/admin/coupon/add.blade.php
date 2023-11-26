@extends('layouts.admin_layout')

@section('stylesheet')

@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h1 class="db-header-title">Add Coupon</h1>
    </div>
    <div class="col-12">
      <div class="ms-panel">
        <div class="ms-panel-body">
          @if(session()->has('status'))
            {!! session()->get('status') !!}
          @endif
          <form action="{{ route('admin.coupon.add') }}" method="post">
            @csrf
            <div class="row">
                <div class="form-group col-md-3">
                <label for="title">Coupon Title</label>
                <input type="text" placeholder="Coupon Title" value="{{old('title')}}" required name="title" class="form-control @error('title') is-invalid @enderror">
                @error('title')
                    <strong class="text-danger">{{ $errors->first('title') }}</strong>
                @enderror
                </div>
                <div class="form-group col-md-3">
                    <label for="code">Coupon Code</label>
                    <input type="text" id="code" placeholder="COUPON200" required name="code" class="form-control @error('code') is-invalid @enderror">
                    @error('code')
                    <strong class="text-danger">{{ $errors->first('code') }}</strong>
                    @enderror
                </div>
                <div class="form-group col-md-3">
                    <label for="discount_amount">Discount Amount</label>
                    <input type="number" id="discount_amount" placeholder="1000" required name="discount_amount" class="form-control @error('discount_amount') is-invalid @enderror">
                    @error('discount_amount')
                    <strong class="text-danger">{{ $errors->first('discount_amount') }}</strong>
                    @enderror
                </div>
                <div class="form-group text-right mt-4">
                    <button class="btn btn-info btn-sm mt-2" type="submit">Save</button>
                </div>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-12">
      <div class="ms-panel">
        <div class="ms-panel-body">
          @if(session()->has('status2'))
            {!! session()->get('status2') !!}
          @endif

          <div class="table-responsive">
            <table id="brand_data_table" class="table w-100 thead-dark table-striped no-footer">
              <thead>
                <th width="30">#</th>
                <th width="100">Title</th>
                <th>Code</th>
                <th>Discount Amount</th>
                <th>Created at</th>
                <th width="30">Options</th>
              </thead>
              <tbody>
                <?php $id = 0; ?>
                @foreach($coupons as $value)
                  <tr class="gradeX">
                    <td>{{ ++$id }}</td>
                    <td width="30%">{{ $value->title }}</td>
                    <td>{{ $value->code }}</td>
                    <td>{{ $value->discount_amount }}</td>
                    <td width="30%">{{ date('F d, Y h:i A', strtotime($value->created_at)) }}</td>
                    <td>
                      <a href="{{ route('admin.coupon.delete', $value->id) }}" class="btn btn-outline-danger btn-sm m-0 p-1 mr-1" style="min-width: 0px;">
                        <i class="fa fa-trash m-0 p-0"></i>
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
@endsection
    
@section('script')

@endsection