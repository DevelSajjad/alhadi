@extends('layouts.frontend_layout')

@section('stylesheet')
  <style>
    ::placeholder{
      font-family: 'Times New Roman';
      color: black;
      font-size: 20px;
    }
    .page_title{
      font-size: 40px;
      font-weight: 500;
      font-family: fantasy;
    }
    .shadow{
      background: #e5e5e5;
      background: white;
    }

    .table{
      text-align: center;
    }
    .table th {
      text-align: center;
      font-size: 13px;
      background: white;
      border-top: 4px solid #005caf;
      border-bottom: 1px solid #c8c6c6;
      border-right: 1px solid #c8c6c6;
      border-left: 1px solid #c8c6c6;
      color: black;
      font-weight: 500;
      padding: 8px;
    }
    .table tr {
      border-top: 1px solid #c8c6c6;
      border-bottom: 1px solid #c8c6c6;
      border-left: 1px solid #c8c6c6;
      color: black;
      padding: 8px;
      vertical-align: inherit;
    }
    .table td {
      border-right: 1px solid #c8c6c6;
      color: black;
      padding: 8px;
    }
    .input-quantity{
      width: 30px!important;
      padding: 0px;
      margin-left: 2px;
      margin-right: 2px;
      text-align: center;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      /* display: none; <- Crashes Chrome on hover */
      -webkit-appearance: none;
      margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
    }

    input[type=number] {
      -moz-appearance:textfield; /* Firefox */
    }

    .cart-total-amount{
      border: #bfbfbf 1px solid;
      padding-bottom: 10px;
      border-radius: 5px
    }
    .cart-total-amount-item{
      display: flex;
    }
    .cart-total-amount-item div{
      min-width: 50%;
    }
    .curser-pointer{
      cursor: pointer;
    }
    .btn-black{
      color: #fff;
      background-color: black;
      border-color: black;
    }
    .ssl_warning{
      font-size: 30px;
      font-weight: 700;
      color: sandybrown;
    }

    .m-color {
      color: #8B75B3;
    }
  </style>

  <style>
    /*style for cheackout bar  */
      .checkout-bar {
          padding: 50px 0px;
          display: block;
      }
      .checkout-bar-wrap {
          display: flex;
          /* justify-content: space-around; */
          justify-content: center;
          align-items: start;
      }

      .checkout-bar-wrap .bar span {
          background: #000000;
          color: #ffff;
          font-weight: bold;
          height: 30px;
          width: 30px;
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          position: relative;
          opacity: 0.2;
      }
      .checkout-bar-wrap .bar.active span {
          opacity: 1;
      }
      .checkout-bar-wrap .bar.active p {
          font-weight: bolder;
          font-size: 17px;
      }

      .checkout-bar-wrap .bar {
          display: flex;
          align-items: center;
          justify-content: center;
          flex-direction: column;
          gap: 10px;
          width: 30%;
          position: relative;
      }
      .checkout-bar-wrap .bar::before {
          content: "";
          position: absolute;
          top: 15px;
          left: 55%;
          width: 90%;
          height: 2px;
          background: #8b75b3;
          opacity: 0.2;
      }
      .checkout-bar-wrap .bar.active::before {
          opacity: 1;
      }
      .checkout-bar-wrap .bar:last-child::before {
          display: none;
      }

      @media screen and (max-width: 768px) {
          .checkout-bar-wrap .bar span {
              height: 25px;
              width: 25px;
          }
          .checkout-bar-wrap .bar.active p {
              font-weight: bold;
              font-size: 14px;
          }
          .checkout-bar-wrap .bar {
              display: flex;
              flex-direction: column;
              width: 40%;
          }
          .checkout-bar-wrap .bar::before {
              top: 12px;
              left: 59%;
              width: 79%;
          }
      }
  </style>
@endsection

@section('content')
  <div class="ps-section--features-product ps-section masonry-root pt-100 pb-100 shadow mt-10 mb-10">
    <section class="checkout-bar">
      <div class="container">
          <div class="checkout-bar-wrap">
              <div class="bar @if(Route::current()->getName() == 'customer.checkout' || Route::current()->getName() == 'proceed.to.payment') active @endif ">
                  <span>1</span>
                  <p>Shopping Cart</p>
              </div>
              <div class="bar @if(Route::current()->getName() == 'proceed.to.payment') active @endif  ">
                  <span>2</span>
                  <p>Checkout</p>
              </div>
    
              <div class="bar ">
                  <span class="last">3</span>
                  <p>Confirmation</p>
              </div>
          </div>
      </div>
    </section>
    <div class="ps-container">
      <div class="row">
        <div class="col-12 text-center">
          <span class="ssl_warning">Please don't close the browser until payment is completed successfully</span>
        </div>
      </div>
      <h2>My Cart</h2>
      <div class="row">
        @if(count(Cart::getContent()) > 0)
        <div class="container" style="margin: 10px; padding: 10px; border-radius: 20px;  background: white; ">
          <table style="min-width: 100%;" class="table mb-20">
            <thead style="background-color: white">
              <tr>
                <th width="150px">Image</th>
                <th width="250px">Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Clear</th>
              </tr>
            </thead>
            <tbody>
              @foreach(\Cart::getContent() as $item)
                <tr>
                  <td><img src="{{ asset($item->attributes->image) }}" alt="" height="100px"></td>
                  <td>{{ (strlen($item->name) > 75) ? substr($item->name, 0, 75)."..." : $item->name }}</td>
                  <td>{{ $item->price }} TK</td>
                  <td>
                    <form action="{{ route('cart.update') }}" method="post">
                      @csrf
                      <input type="hidden" name="rowId" value="{{$item->id}}">
                      <div style="display: inline-flex">
                        <button type="button" class="btn btn-black btn-xs minus minus-btn"><span class="fa fa-minus" style="font-size: 15px"></span></button>
                        <input class="input-quantity btn-sm" name="qty" data-price="{{ $item->price }}" data-id="{{ $item->id }}" type="number" value="{{ $item->quantity }}">
                        <button type="button" class="btn btn-success btn-xs plus plus-btn" style="margin-right: 2px"><span class="fa fa-plus" style="font-size: 15px"></span></button>
                        <button type="submit" style="display: none" class="btn btn-success btn-xs"><span class="fa fa-check" style="font-size: 15px"></span></button>
                      </div>
                    </form>
                  </td>
                  <td id="{{ 'total-price'.$item->id }}">{{ ($item->quantity * $item->price) }} Tk</td>
                  <td><a href="{{ route('cart.remove', $item->id) }}" class="fa fa-trash text-danger" style="font-size: 25px; cursor: pointer"></a></td>
                </tr>
              @endforeach
            </tbody>
          </table>  
          @if(\Cart::getTotalQuantity() > 0)
            @php
                // setcookie('customer_data', '', time() - 3600, '/');
              if (auth()->user() != null) {
                $name = auth()->user()->name ?? '';
                $phone = auth()->user()->mobile_no ?? '';
                $address = auth()->user()->address ?? '';
              } else {
                $name = $customerData->billing_name ?? '';
                $phone = $customerData->billing_phone ?? '';
                $address = $customerData->billing_address ?? '';
              }
            @endphp
            <div class="row" style="margin: 0px">
              {{-- <div class="col-md-6 col-lg-6 col-xl-6"></div> --}}
              <form action="{{ route('customer.proceed.to.payment') }}" method="post">
                @csrf
                <input type="hidden" name="coupon_amount" value="0" id="coupon_amount"> 
                <div class="col-md-6 col-lg-6 col-xl-6">
                  <h1 class="" style="font-size: 30px;"> <strong>{{ __('Billing details') }}</strong> </h1>
                  <div class="form-group">
                    <input style="height: 45px;" type="text" value="{{ old('billing_name', $name) }}" class="form-control @error('billing_name') is-invalid @enderror" required autocomplete="off" name="billing_name"  placeholder="Write your name (*)">
                  </div>
                  @error('billing_name')
                    <strong class="text-danger"> {{$errors->first('billing_name')}} </strong>
                  @enderror

                  <div class="form-group">
                    <input style="height: 45px;" type="text" value="{{ old('billing_phone', $phone) }}" class="form-control @error('billing_phone') is-invalid @enderror" required autocomplete="off" name="billing_phone"  placeholder="Enter your number (*)">
                  </div>
                  @error('billing_phone')
                    <strong class="text-danger"> {{$errors->first('billing_phone')}} </strong>
                  @enderror

                  <div class="form-group">
                    <input style="height: 45px;" type="text" value="{{ old('billing_address', $address) }}" class="form-control @error('billing_address') is-invalid @enderror" required autocomplete="off" name="billing_address" placeholder="House, Road, Thana, Zilla (*)">
                  </div>
                  @error('billing_address')
                    <strong class="text-danger"> {{$errors->first('billing_address')}} </strong>
                  @enderror

                  <div class="form-check">
                    <input class="form-check-input" name="shipping" data-toggle="collapse" data-target="#collapseExample" type="checkbox" value="shipping" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                      Ship to a different address?
                    </label>
                  </div>
                  <div class="collapse" id="collapseExample">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Your Name <span class="text-danger"> {{ __('(*)') }} </span></label>
                      <input style="height: 45px;" type="text" value="{{ old('shipping_name') }}" class="form-control @error('shipping_name') is-invalid @enderror" name="shipping_name" placeholder="Write shipping Name">
                    </div>
                    @error('shipping_name')
                      <strong class="text-danger"> {{$errors->first('shipping_name')}} </strong>
                    @enderror

                    <div class="form-group">
                      <label for="exampleInputEmail1">Street Address <span class="text-danger"> {{ __('(*)') }} </span></label>
                      <input style="height: 45px;" type="text" value="{{ old('shipping_address') }}" class="form-control @error('shipping_address') is-invalid @enderror" name="shipping_address" placeholder="House, Road, Thana, Zilla">
                    </div>
                    @error('shipping_address')
                      <strong class="text-danger"> {{$errors->first('shipping_address')}} </strong>
                    @enderror
                  </div>
                  <div class="form-group">
                    <textarea name="customer_say" class="form-control" id="" cols="30" rows="10"> {{ old('customer_say') }} </textarea>
                  </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-6 cart-total-amount" style="margin-top: 48px; padding-bottom: 12px; padding-top:10px;">
                  <div class="col-12 cart-total-amount-item">
                    <div><h6><strong>Sub-Total</strong></h6></div>
                    <div class="text-right"><strong class="sub_total">{{ \Cart::getTotal() }}</strong><strong> TK</strong></div>
                  </div>
                  <div class="col-12 cart-total-amount-item">
                      <div>
                        <span class="h6"><strong>Delivery Charge</strong></span><br>
                        <span class="h6 d-block"><strong class="delivery_time">Inside Dhaka, Delivery time will be 3 to 5 Working Days</strong></span><br>
                        <label for="inDhaka" class="curser-pointer"><input type="radio" name="delivery" value="inDhaka" checked id="inDhaka"> In dhaka</label>
                        <label for="outDhaka" class="curser-pointer"><input type="radio" name="delivery" value="outDhaka" id="outDhaka">Outside dhaka</label><br>
                        <label for="cash_on_delivery" class="curser-pointer"><input type="radio" name="payment_type" value="cash_on_delivery" checked id="cash_on_delivery"> Cash on Delivery</label>
                        <label for="online" class="curser-pointer"><input type="radio" name="payment_type" value="online" id="online">Online Payment</label>
                      </div>
                      <div class="text-right">
                        <strong class="available_delivery_charge">{{ (\Cart::getTotal() < 5000) ? "100 TK" : "0 TK" }}</strong>
                      </div>
                  </div>

                  {{-- <div class="col-12 cart-total-amount-item">
                    <div><h4><strong>Vat (5%)</strong></h4></div>
                    <div class="text-right"><strong id="vat_total">{{ 0 }}</strong></div>
                  </div> --}}

                  <div class="col-12 cart-total-amount-item">
                    <div><h4><strong>Total</strong></h4></div>
                    <div class="text-right"><strong id="grand_total">{{ \Cart::getTotal() + 0 + ((\Cart::getTotal() < 5000) ? 100 : 0) }} </strong><strong> TK</strong></div>
                  </div>
                  <hr>

                  <div class="col-12 col-md-8 col-md-offset-4 cart-coupon">
                    <div class="form-group">
                      <label for="coupon">Coupon Code</label>
                      <input class="form-control" disabled type="text" id="coupon" name="coupon" placeholder="Type Coupon Code Here">
                      <span><i class="text-danger">Applicable in minimum bill <b>5000 Taka</b></i></span>
                    </div>
                  </div>


                  <div class="col-12 col-md-12">
                    @if(\Cart::getTotal() > 0)
                      <div class="d-flex">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" required>
                          <label class="form-check-label" for="flexCheckChecked">
                            I read and agree to the <a class="m-color" href="{{route('terms.and.conditions')}}">Terms & Condition</a>, <a class="m-color" href="{{route('privacy.policy')}}">Privacy & Policy</a> and <a class="m-color" href="{{route('return.refund')}}">Return Refund Policy</a>
                          </label>
                        </div>
                          <div>
                            <button style="background-color: #005caf; color: white;" type="submit" class="btn pull-right curser-pointer">Proceed To Checkout</button>
                          </div>
                      </div>
                    @endif
                  </div>
                </div>
              </form>
            </div>
          @endif
        </div>
        @else
          <div class="container text-center">
            <strong style="font-size: 30px">Cart has no data. <a class="btn btn-sm btn-success" href="{{ route('home') }}">GO to shop</a></strong>
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script type="text/javascript" src="{{ asset("assets/frontend/plugins/jquery/dist/jquery.min.js") }}"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  {{--<script type="text/javascript" src="{{ asset("assets/frontend/plugins/gmap3.min.js") }}"></script>--}}
  <script>
    $(document).ready(function () {
      window.addEventListener( "pageshow", function ( event ) {
        var historyTraversal = event.persisted ||
          ( typeof window.performance != "undefined" &&
            window.performance.navigation.type === 2 );
        if ( historyTraversal ) {
          // Handle page restore.
          window.location.reload();
        }
      });



      //Coupon Setup
      const grand_total = $('#grand_total').text();

      $(document).ready(function(){
        if(grand_total>=5000){
        $('#coupon').prop('disabled',false)
        }
      })

      $('#coupon').keyup(function(){
        $.ajaxSetup({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        var code = $(this).val();
        let url = "{{  url('') }}" + "/isvalidCoupon/"+code;
        if(code != ""){
          $.ajax({
            url: url,
            method: "get",
            data: {code:code},
            datatype:"json",
            success: function(data){
                if(data!=0){
                    swal("You have got "+data+ " TK Discount using coupon code: "+code)
                }
                var total = grand_total-data;
                $('#grand_total').text(total);
                $('#coupon_amount').val(data);
            }
          })
        }
        if(code == "")
        {
          $('#grand_total').text(grand_total)
          $('#coupon_amount').val(0);
        }
      });




      // console.log(window.location.origin+window.location.pathname)
      $(document).on('click', '.plus-btn', function () {
        var vatt = 0;
        const sub_total = $('.sub_total').text()
        const input = $(this).parent('div').find('input[name="qty"]')
        const price = input.data('price')
        const id = input.data('id')
        const qu = (Number(input.val())+1);
        if (qu > 0) {
          input.val(qu)
          const totalPrice = qu*price
          $('.sub_total').text(Number(sub_total) + price)
          $('#total-price'+id).text(totalPrice+" TK")
          vatt = 0 //$('.sub_total').text() * (5/100)
          $('#vat_total').text(vatt)
          setGrandTotal()
        } else {
          input.val(1)
          $('#total-price'+id).text(price+" TK")
        }

        $(this).parent('div').find('button[type="submit"]').css('display', 'block')
      })
      // clicking on modal minus btn
      $(document).on('click', '.minus-btn', function () {
        var vat = 0;
        const sub_total = $('.sub_total').text()
        const input = $(this).parent('div').find('input[name="qty"]')
        const price = input.data('price')
        const id = input.data('id')
        const qu = (Number(input.val())-1);
        if (qu > 0) {
          input.val(qu)
          const totalPrice = qu*price
          $('.sub_total').text(Number(sub_total) - price)
          $('#total-price'+id).text(totalPrice+" TK")

          vat = 0 //$('.sub_total').text() * (5/100)
          $('#vat_total').text(vat)

          setGrandTotal()
        } else {
          input.val(1)
          $('#total-price'+id).text(price+" TK")
        }
        $(this).parent('div').find('button[type="submit"]').css('display', 'block')
      })

      function setGrandTotal() {
        const sub_total = Number($('.sub_total').text());
        var total = 0;
        const area = $('input[type="radio"]:checked').attr('id')
        if(area === 'inDhaka'){
          if(sub_total < 5000) {
            total = sub_total + 100;
            $('.available_delivery_charge').text('100 TK')
          }else {
            total = sub_total;
            $('.available_delivery_charge').text('0 TK')
          }
        }else{
          if(sub_total < 10000) {
            total = sub_total + 200;
            $('.available_delivery_charge').text('200 TK')
          }else {
            total = sub_total;
            $('.available_delivery_charge').text('0 TK')
          }
        }
        const vatadd1 = Number($('#vat_total').text());

        total = total + vatadd1;
        $('#grand_total').text(total)
      };

      // on change
      $(document).on('change', '.input-quantity', function () {
        const input = $(this).parent('div').find('input[name="qty"]')
        const price = input.data('price')
        const id = input.data('id')
        const qu = Number(input.val());
        if (qu > 0) {
          input.val(qu)
          const totalPrice = qu*price
          $('#total-price'+id).text(totalPrice)
        } else {
          input.val(1)
          $('#total-price'+id).text(price)
        }
        $(this).parent('div').find('button[type="submit"]').css('display', 'block')
      })

      // on key press
      $(document).on('keyup', '.input-quantity', function () {
        const input = $(this).parent('div').find('input[name="qty"]')
        const price = input.data('price')
        const id = input.data('id')
        const qu = Number(input.val());
        if (qu > 0) {
          input.val(qu)
          const totalPrice = qu*price
          $('#total-price'+id).text(totalPrice)
        } else {
          input.val(1)
          $('#total-price'+id).text(price)
        }
        $(this).parent('div').find('button[type="submit"]').css('display', 'block')
      })

      $(document).on('change', 'input[type="radio"]', function (){
        const cartTotal = Number($('.sub_total').text())
        var total = 0;
        if($(this).attr('id') === 'inDhaka'){
          if(cartTotal < 5000) {
            total = cartTotal + 100;
            $('.available_delivery_charge').text('100 TK')
          }else {
            total = cartTotal;
            $('.available_delivery_charge').text('0 TK')
          }
        }else{
          if(cartTotal < 10000) {
            total = cartTotal + 200;
            $('.available_delivery_charge').text('200 TK')
          }else {
            total = cartTotal;
            $('.available_delivery_charge').text('0 TK')
          }
        }
        const vatadd = Number($('#vat_total').text());
        total = total + vatadd;
        $('#grand_total').text(total)
      })

      $(document).on('click', '#inDhaka, #outDhaka', function(e) {
        // e.preventDefault();
        let val = $(this).val();
        if (val == 'inDhaka') {
          $('.delivery_time').text('Inside Dhaka, Delivery time will be 3 to 5 Working Days.');
        } else {
          $('.delivery_time').text('Outside Dhaka, Delivery time will be 5 to 7 Working Days.')
        }
      });
    })
  </script>
@endsection
