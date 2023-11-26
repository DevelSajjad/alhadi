@extends('layouts.admin_layout')

@section('stylesheet')
<link href="{{ asset('assets/admin/css/datatables.min.css') }}" rel="stylesheet">

  <style>
      .btn{
          margin-top:0;
      }

      .tooption{
          display: flex;
          align-items: center;
      }

      .sbmtArea{
        
	text-align: center;
	display: flex;
	justify-content: center;
	align-items: flex-end;

      }
 
  </style>
@endsection

@section('content')

<div class="container">

<div class="row">
    <div class="col-md-12 ">
        
        <form action="{{route('admin.report.data')}}" method="post">
            @csrf
            
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Start Date</label>
                    <input type="date" class="form-control" name="start" required >
                    
                </div>
    
                <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">End Date</label>
                    <input type="date" class="form-control" name="end" required >
                    
                </div>
    
                <div class="form-group col-md-2">
                    <label for="exampleInputEmail1">Payment Status</label>
                    
                    <select name="option" id="" class=" form-control">
                        <option value="Paid">Paid</option>
                        <option value="unpaid">Unpaid</option>
                    </select>
                    
                </div>
                
                <div class="form-group col-md-2 sbmtArea">
                    
                    <button class="btn btn-success btn-sm ml-5 text-center" type="submit" > Search </button>
                    
                </div>
    
                
    
                
            </div>

        </form>
        
        
        </div>

    </div>
</div>

@if (isset($data))
<div class="table-responsive">
    <table id="category_data_table" class="table w-100 thead-dark table-striped no-footer">
      <thead>
      <th >Id</th>
      <th >Address</th>
      <th>Amount</th>
      <th >Payment Status</th>
      <th >Status</th>
      </thead>
      <tbody>
      @foreach($data as $value)
        <tr class="gradeX">
          <td >{{ $loop->iteration }}</td>
          <td>{{$value->delivery_address}}</td>
          <td>{{$value->amount}}</td>
          <td>{{$value->payment_status}}</td>
          <td>{{$value->status}}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>

  


@endif
    




</div>

@endsection



@section('scripts')


<script src="{{ asset('assets/admin/js/datatables.min.js') }}"></script>

<script>
  $( document ).ready(function() {
    $('#category_data_table').DataTable();
  })
</script>

@endsection