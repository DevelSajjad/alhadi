@extends('layouts.frontend_layout')

@section('stylesheet')
  <style>
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
  </style>
@endsection

@section('content')
  <div class="ps-section--features-product ps-section masonry-root pt-100 pb-100 shadow mt-10 mb-10">
    <div class="ps-container">
      <div class="row">
        <div class="col-12 text-center">
          <span class="ssl_warning">Please don't close the browser until payment successfully</span>
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
            <div class="row" style="margin: 0px">
              <div class="col-md-6 col-lg-6 col-xl-6"></div>
              <form action="{{ route('customer.proceed.to.payment') }}" method="post">
                @csrf
                <div class="col-md-6 col-lg-6 col-xl-6 cart-total-amount">
                  <div class="col-12 cart-total-amount-item">
                    <div><h6><strong>Sub-Total</strong></h6></div>
                    <div class="text-right"><strong class="sub_total">{{ \Cart::getTotal() }}</strong><strong> TK</strong></div>
                  </div>
                  <div class="col-12 cart-total-amount-item">
                      <div>
                        <spam class="h6"><strong>Delivery Charge</strong></spam><br>
                        <label for="inDhaka" class="curser-pointer"><input type="radio" name="delivery" value="inDhaka" checked id="inDhaka"> In dhaka</label>
                        <label for="outDhaka" class="curser-pointer"><input type="radio" name="delivery" value="outDhaka" id="outDhaka">Outside dhaka</label>
                      </div>
                      <div class="text-right">
                        <strong class="available_delivery_charge">{{ (\Cart::getTotal() < 5000) ? "100 TK" : "0 TK" }}</strong>
                      </div>
                  </div>
                  
                   <div class="col-12 cart-total-amount-item">
                    <div><h4><strong>Vat (5%)</strong></h4></div>
                    <div class="text-right"><strong id="vat_total">{{ \Cart::getTotal() * (5/100) }}</strong></div>
                  </div>

                  <div class="col-12 cart-total-amount-item">
                    <div><h4><strong>Total</strong></h4></div>
                    <div class="text-right"><strong id="grand_total">{{ \Cart::getTotal() * (5/100) + \Cart::getTotal() + ((\Cart::getTotal() < 5000) ? 100 : 0) }} </strong><strong> TK</strong></div>
                  </div>
                  <hr>
                  <div class="col-12 text-right">
                    @if(\Cart::getTotal() > 0)
                      <button style="background-color: #005caf; color: white;" type="submit" class="btn curser-pointer">Proceed To Checkout</button>
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
          vatt = $('.sub_total').text() * (5/100)
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

          vat = $('.sub_total').text() * (5/100)
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
    })
  </script>
@endsection
