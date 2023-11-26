@extends('layouts.frontend_layout')
@section('stylesheet')
  <style>
    @media print {
      body * {
        visibility: hidden;
      }
      #section-to-print, #section-to-print * {
        visibility: visible;
      }
      #section-to-print {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        padding: 15px;
      }
      #section-to-print-logo img {
        display: block!important;
      }
    }

    .table-header{
      font-size: 13px;
      background: #2ac37d;
      border-top: 4px solid #2ac37d;
      border-bottom: 1px solid #c8c6c6;
      border-right: 1px solid #c8c6c6;
      border-left: 1px solid #c8c6c6;
      color: black;
      font-weight: bold;
      padding: 8px;
    }
    .t-border-r {
      border-right: 1px solid #c8c6c6;
    }
    .t-border-l {
      border-left: 1px solid #c8c6c6;
    }
    .t-border-b {
      border-bottom: 1px solid #c8c6c6;
    }
    .t-border-t {
      border-top: 1px solid #c8c6c6;
    }
    .border-bottom{
      border-bottom: 1px solid lightgray;
    }
    .tr-border-bottom{
      border-bottom: 1px solid rgba(211, 211, 211, 0.219);
    }
    .margin-top{
      margin-top: 25px;
    }
    .invoice-container{
      background-color: white;
      padding: 15px;
      margin: 20px;
  }
  .table-head{
    
    background-color: lightgray
  }
  .table-head > th{
    font-weight: bold;
    font-size: 16px;
  }
  .text-bold{
    font-weight: bold;
  }
  .margin-right{
    margin-right: 10px;
  }
  .padding-top{
    padding-top: 50px;
  }
  .text-decoration-none{
    text-decoration: none;
    color: red;
  }
  .text-decoration-none:hover{
    text-decoration: none;
    color: crimson !important;
  }
  .logo-touch{
    color: rgb(26,76,119);
    font-size: 24px;
    font-weight: 700;
  }
  .logo-and{
    color: rgb(239,232,108);
    font-size: 24px;
    font-weight: 700;
  }
  .logo-solve{
    color: rgb(98,185,91);
    font-size: 24px;
    font-weight: 700;
  }
  </style>

@endsection

@section('content')
<section id="section-to-print" class="invoice-container">
  
<section class="">
  <div class="container mt-5">
      <div class="row gx-5 border-bottom">
          <div class="col-xs-8 col-sm-8 col-lg-8 ">
            @php
              $logo = $company_info->logo?? ''
            @endphp
              <div class="m-0">
                  <img width="50%" src="{{asset($logo)}}" alt="">
              </div>
              <div class="mt-5">
                  <h2 class="fw-bold"><span class="logo-touch">Touch</span> <span class="logo-and">&</span><span class="logo-solve">Solve </span>  Technologies Limited</h2>
                  <h4 class="">Company ID : C-172940</h4>
                  <h4 class="">Tax ID : 849776384956</h4>
                  <h4 class="">House: # 202, 3rd Floor, Road: 3/A, Block: B Sagupta Housing Society Pallabi, Mirpur -12, Dhaka- 1216</h4>
                  <h4>Web: www.touchandsolve.com, E:sales@touchandsolve.com</h4>
                  <h4>Dhaka, Bangladesh</h4>
              </div>
          </div>
          <div class="col-xs-4 col-sm-4  text-right">
              <h1 class="fw-bold mt-4">Invoice</h1>
             <h2># INV-000003</h2>
             <h4 class="mt-3">Total Amount</h4>
             <h2>BDT {{$order->amount}}</h2>
          </div>
      </div>
  </div>
</section>

<section class="margin-top">
  <div class="container">
      <div class="row">
          <div class="col-sm-6">
              <p class="fs-4">To</p>
              <h4>Lucid Health Care</h4>
              <p class="fs-4">Rahman Lucid Tower wing -1 Level -2 19/3 Kakrail area Dhaka, 1000</p>
          </div>
          <div class="col-sm-6 text-right">
              <p class="fs-4"><span class="text-bold">Invoice Date :</span> 31 Jul 2022</p>
              <p class="fs-4"><span class="text-bold">Terms : </span>Due on Receipt</p>
              <p class="fs-4"><span class="text-bold">Due Date :</span> 31 Jul 2022</p>
          </div>
      </div>
  </div>
</section>
<section class="margin-top">
  <div class="container">
    <h2 class="card-title mt-10 mt-20">Order Details</h2>
      <div class="row border-bottom">
          <div class="col-sm-12 table-responsive">
              <table class="table  border-light">
                  <thead>
                    <tr class="table-head text-light">
                      <th scope="col">#</th>
                      <th scope="col" class="">Item & Description</th>
                      <th scope="col"> Qty</th>
                      <th scope="col"> Rate</th>
                      <th scope="col"> Amount</th>
                    </tr>
                  </thead>
                  <tbody class="fs-3">
                    <?php
                      $product_details = unserialize($order->products);
                      $subTotal = 0;
                      $i = 1;
                      ?>
                    @foreach ($product_details as $key => $val)
                    <?php $subTotal += $val->quantity * $val->price; ?>
                    <tr class="tr-border-bottom">
                      <th scope="row">{{$key}}</th>
                      <td>{{$val->name}}</td>
                      <td>{{$val->quantity}}</td>
                      <td>{{$val->price}}</td>
                      <td>{{$val->quantity * $val->price}}</td>
                    </tr>
                    @endforeach
                    
                  </tbody>
                </table>
          </div>
      </div>
  </div>
</section>

<section class="margin-top">
<div class="container text-right">
  <div class="row">
    <div class="col-sm-12">
      <p class="fs-4"><span class="text-bold margin-right"> Sub Total:</span>{{$subTotal}}</p>
      <p class="fs-4"><span class="text-bold margin-right">Delivery Charge:</span>{{$order->delivery_charge}}</p>
      <p class="fs-4"><span class="text-bold margin-right"> Total BDT:</span>{{ $subTotal + $order->delivery_charge}}</p>
    </div>
  </div>
</div>
</section>

<section>
  <div class="container margin-top">
    <div class="col-12">

      <!-- Entry Header -->

      <!-- /entry header -->

      <!-- Card -->
      <h2 class="card-title mt-10 mt-20">Payment Details</h2>
      <div class="dt-card overflow-hidden">
        <!-- Card Body -->
        <div class="dt-card__body">
          <!-- Tables -->
          <div class="table-responsive">
            <table class="table table-hover mb-0">
              <thead>
                <tr class="table-head text-light">
                  <th scope="col">#</th>
                  <th scope="col" class="">Payment Date</th>
                  <th scope="col"> Method</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              {{-- <thead>
              <tr class="table-head t-border-t">
                <th scope="col" class="table-header">#</th>
                <th class="text-uppercase table-header" scope="col"></th>
                <th class="text-uppercase table-header" scope="col"></th>
                <th class="text-uppercase table-header" scope="col"></th>
                <th class="text-uppercase table-header" scope="col"></th>
              </tr>
              </thead> --}}
              <tbody>
              <?php $i = 1;?>
              @foreach($payment_details as $row)
                <tr class="t-border-b">
                  <th scope="row" class="t-border-r t-border-l">{{ $i++ }}</th>
                  <td class="t-border-r">{{ $row->created_at }} </td>
                  <td class="t-border-r">{{ $row->card_type }}</td>
                  <td class="t-border-r">{{ $row->amount }}</td>
                  <td class="t-border-r">{{ $row->status }}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <!-- /tables -->

        </div>
        <!-- /card body -->

      </div>
      <!-- /card -->

    </div>
  </div>
</section>
<section class="margin-top padding-top">
<div class="container ">
  <div class="row">
    <div class="col-sm-12">
      <p class="fs-4 text-bold"> Notes</p>
      <p class="fs-4">Thanks for your business.</p>
      <p class="fs-4 text-bold">Terms & Conditions</p>
      <p class="fs-4">For Terms & Conditions Please visit: <a target="_blank" class="text-decoration-none" href="https://www.touchandsolve.com/">Touch and Solve Terms & Conditions</a></p>
    </div>
  </div>
</div>
</section>
<section class="mt-5 mb-5 pb-5">
<div class="container">
  <div class="row">
    <div class="col-sm-3 me-5">
      <p class="fs-4 text-bold border-bottom">Authorized Signature</p>
    </div>
    <div class="col-sm-3 ">
      <p class="fs-4 text-bold border-bottom"> Receiver Signature</p>
    </div>
  </div>
</div>
</section>
<button type="button" class="btn btn-warning" onclick="window.print()">Print</button>
</section>
@endsection






@section('script')

@endsection
