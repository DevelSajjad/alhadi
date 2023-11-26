@extends('layouts.admin_layout')


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
                display: block !important;
            }

            #section-customer div {
                margin-top: 115px;
            }

            #section-title {
                display: block !important;
            }
            .not-print{
                display: none;
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
      /* font-size: 10px; */
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
  .logo-touch{
    color: rgb(26,76,119);
    font-size: 30px;
    font-weight: 700;
  }
  .logo-and{
    color: rgb(239,232,108);
    font-size: 30px;
    font-weight: 700;
  }
  .logo-solve{
    color: rgb(98,185,91);
    font-size: 30px;
    font-weight: 700;
  }
    </style>

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1 class="db-header-title">Order Details</h1>
        </div>
        <div class="col-12 " id="section-to-print">
            <div class="ms-panel">
                <div class="ms-panel-body">
                    <section class="invoice-container">
  
                        <section >
                          <div class="container ">
                              <div class="row gx-5 border-bottom">
                                  <div class="col-xs-8 col-sm-8 col-lg-8 ">
                                    @php
                                      $logo = $company_info->logo?? ''
                                    @endphp
                                      <div class="m-0">
                                          <img width="50%" src="{{asset($logo)}}" alt="">
                                      </div>
                                      <div class="">
                                          <h3 class=""><span class="logo-touch">Touch</span> <span class="logo-and">& </span><span class="logo-solve">Solve </span> Technologies Ltd</h3>
                                          <h6 class="">Company ID : C-172940</h6>
                                          <h6 class="">Tax ID : 849776384956</h6>
                                          <h6 class="">House: # 202, 3rd Floor, Road: 3/A, Block: B Sagupta Housing Society Pallabi, Mirpur -12, Dhaka- 1216</h6>
                                          <h6>Web: www.touchandsolve.com, E:sales@touchandsolve.com</h6>
                                          <h6>Dhaka, Bangladesh</h6>
                                      </div>
                                  </div>
                                  <div class="col-xs-4 col-sm-4  text-right">
                                      <h5 class="fw-bold mt-4">Invoice</h5>
                                     <h3># INV-000003</h3>
                                     <h5 class="mt-3">Total Amount</h5>
                                     <h3>BDT {{$order->amount}}</h3>
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
                            <h4 class="card-title mt-10 mt-20">Order Details</h4>
                              <div class="row border-bottom">
                                  <div class="col-sm-12 table-responsive">
                                      <table class="table  border-light">
                                          <thead>
                                            <tr class="table-head ">
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
                              <h4 class="card-title mt-10 mt-20">Payment Details</h4>
                              <div class="dt-card overflow-hidden">
                                <!-- Card Body -->
                                <div class="dt-card__body">
                                  <!-- Tables -->
                                  <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                      <thead>
                                        <tr class="table-head ">
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
                              <p class="fs-4">For Terms & Conditions Please visit: <a target="_blank" class="text-decoration-none" href="https://www.touchandsolve.com/#/">Touch and Solve Terms & Conditions</a></p>
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
                    </section>

                    <div class="row mb-3 not-print">
                        <div class="col-6 mt-3 mb-4 d-flex text-center">
                            <span class="h5 mr-2">Order Status</span>
                            <form action="{{ route('admin.order.change.status') }}" method="POST" class="d-flex">
                                @csrf
                                <input type="hidden" name="id" value="{{ $order->id }}">
                                <select name="status" class="form-control p-0 m-0" data-id="{{ $order->id }}"
                                        style="width: 120px">
                                    <option value="" selected>Select one</option>
                                    <option value="Pending"
                                            @if(strtolower($order->status) == 'pending') selected @endif>Pending
                                    </option>
                                    <option value="Processing"
                                            @if(strtolower($order->status) == 'processing') selected @endif>Processing
                                    </option>
                                    <option value="Delivered"
                                            @if(strtolower($order->status) == 'delivered') selected @endif>Delivered
                                    </option>
                                    <option value="Completed"
                                            @if(strtolower($order->status) == 'completed') selected @endif>Completed
                                    </option>
                                    <option value="Canceled"
                                            @if(strtolower($order->status) == 'canceled') selected @endif>Canceled
                                    </option>
                                </select>
                            </form>
                        </div>
                        <div class="col-6 text-right ">
                            <button type="button" class="btn btn-success btn-sm mt-3 mb-4" onclick="window.print()">
                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 512 512"
                                     style="enable-background:new 0 0 512 512; width:25px; margin-right: 10px; fill: #ffffff;"
                                     xml:space="preserve">
<g>
    <g>
        <path d="M446.016,245.61h-18.253c-10.122,0-18.357,8.235-18.357,18.358v18.252c0,10.122,8.235,18.357,18.357,18.357h18.253
    c10.122,0,18.357-8.235,18.357-18.357v-18.252C464.373,253.845,456.137,245.61,446.016,245.61z M449.382,282.219
    c0,1.856-1.51,3.366-3.366,3.366h-18.253c-1.856,0-3.366-1.51-3.366-3.366v-18.252c0-1.856,1.51-3.367,3.366-3.367h18.253
    c1.856,0,3.366,1.511,3.366,3.367V282.219z"/>
    </g>
</g>
                                    <g>
                                        <g>
                                            <path d="M503.985,208.921c-5.195-5.233-12.118-8.13-19.49-8.156l-15.623-0.056l0.341-94.114
    c0.025-7.018-2.689-13.624-7.642-18.597c-4.953-4.974-11.547-7.715-18.567-7.719l-26.603-0.014v-49.7
    c0-10.415-8.472-18.887-18.887-18.887H113.568c-10.415,0-18.887,8.472-18.887,18.887V80.1l-25.177-0.014c-0.005,0-0.01,0-0.015,0
    c-14.406,0-26.168,11.717-26.221,26.127l-0.336,92.956l-14.526-0.052c-0.035,0-0.067,0-0.101,0
    c-15.174,0-27.549,12.319-27.603,27.505L0,420.529c-0.055,15.222,12.284,27.65,27.505,27.705l64.13,0.232l-12.31,34.338
    c-1.335,3.725-0.776,7.884,1.496,11.124c2.272,3.24,5.991,5.183,9.949,5.198l330.406,1.196c0.015,0,0.029,0,0.044,0
    c3.941,0,7.655-1.914,9.942-5.126c2.295-3.224,2.886-7.378,1.577-11.114l-12.061-34.425l62.916,0.227c0.035,0,0.067,0,0.102,0
    c15.174-0.001,27.549-12.319,27.603-27.505L512,228.47C512.026,221.097,509.18,214.154,503.985,208.921z M416.401,95.256h0.001
    l26.595,0.014c3.006,0.002,5.83,1.176,7.952,3.307c2.122,2.131,3.284,4.959,3.273,7.965l-0.341,94.113l-37.48-0.135V95.256z
     M109.672,30.565c0-2.148,1.748-3.896,3.896-3.896h283.947c2.148,0,3.896,1.748,3.896,3.896v169.899l-291.739-1.055V30.565z
     M58.26,106.267c0.022-6.172,5.059-11.19,11.23-11.19c0.002,0,0.005,0,0.007,0l25.185,0.014v104.265l-36.758-0.133L58.26,106.267z
     M74.513,433.412l0.124-34.365c0.008-2.292,1.875-4.15,4.164-4.15c0.006,0,0.011,0,0.016,0l31.979,0.116l-6.476,18.066
    l-7.071,19.724l-0.247,0.69L74.513,433.412z M94.767,484.15l14.555-40.601c0.001-0.003,0.003-0.007,0.005-0.01l17.385-48.498
    l259.275,0.937l17.035,48.623c0.001,0.003,0.003,0.006,0.004,0.009l14.262,40.707L94.767,484.15z M437.348,434.724l-21.93-0.079
    l-2.938-8.386l-10.578-30.193l31.42,0.114c1.113,0.004,2.157,0.441,2.941,1.231s1.213,1.837,1.209,2.948L437.348,434.724z
     M496.306,422.324c-0.025,6.94-5.679,12.568-12.613,12.568c-0.016,0-0.031,0-0.046,0l-31.309-0.113l0.124-34.366
    c0.019-5.117-1.957-9.934-5.562-13.565c-3.604-3.632-8.408-5.641-13.524-5.66l-41.654-0.151c-0.129-0.007-0.255-0.031-0.385-0.032
    l-269.866-0.976c-0.01,0-0.019,0-0.027,0c-0.125,0-0.245,0.023-0.369,0.029l-42.202-0.153c-0.024,0-0.047,0-0.071,0
    c-10.53,0-19.116,8.548-19.154,19.086l-0.124,34.366l-31.963-0.115c-6.956-0.025-12.594-5.705-12.568-12.659l0.702-193.909
    c0.025-6.94,5.679-12.568,12.613-12.568c0.016,0,0.031,0,0.046,0l22.014,0.08c0.001,0,434.07,1.57,434.072,1.57
    c6.956,0.025,12.594,5.705,12.568,12.659L496.306,422.324z"/>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M300.973,132.313H150.536c-4.14,0-7.495,3.355-7.495,7.495s3.355,7.495,7.495,7.495h150.436
    c4.14,0,7.495-3.355,7.495-7.495S305.113,132.313,300.973,132.313z"/>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M364.405,132.313h-21.979c-4.14,0-7.495,3.355-7.495,7.495s3.355,7.495,7.495,7.495h21.979
    c4.139,0.001,7.495-3.355,7.495-7.495S368.545,132.313,364.405,132.313z"/>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M172.926,76.111h-22.39c-4.14,0-7.495,3.355-7.495,7.495c0,4.139,3.355,7.495,7.495,7.495h22.39
    c4.14,0,7.495-3.355,7.495-7.495C180.421,79.466,177.066,76.111,172.926,76.111z"/>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M364.404,76.111h-150.9c-4.14,0-7.495,3.355-7.495,7.495c0,4.139,3.355,7.495,7.495,7.495h150.9
    c4.14,0,7.495-3.355,7.495-7.495C371.899,79.466,368.544,76.111,364.404,76.111z"/>
                                        </g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
</svg>
                                <span class="text-white">Print</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="productDeleteModal" tabindex="-1" role="dialog" aria-labelledby="productDeleteModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Change order status to Delivered</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.order.add.deliveredby') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="order_delivered_id">
                    <div class="modal-body">
                        <label for="">Name <span class="text-danger">*</span></label><br>
                        <input type="text" class="form-control" name="name" placeholder="Name of the delivery boy"
                               required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-success btn-sm yes-btn">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
        $(document).ready(function () {

            // $(document).on('change', 'select[name="status"]', function () {
            //   $(this).parent('form').submit()
            // })
            $(document).on('change', 'select[name="status"]', function () {
                var value = $(this).val();
                if (value === 'Delivered' || value === 'delivered' || value == 'Delivered' || value == 'delivered') {
                    const product_id = $(this).data('id')
                    $('#order_delivered_id').val(product_id)
                    $('#productDeleteModal').modal('show')
                } else {
                    $(this).parent('form').submit()
                }
            })
        })
    </script>
@endsection
