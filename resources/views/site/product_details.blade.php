@extends('layouts.frontend_layout')

@section('meta')
    <meta name="keywords" content="{{ $product->name }},
  {{ $product->brand_name }},
  {{ $product->name }} price in bd,
  {{ $product->brand_name }} price in bd,
  {{ $product->category_name }} price in bd,
  {{ $product->sub_category_name }} price in bd ">
@endsection
@section('page_title')
    {{ $product->name }} | {{ $product->sub_category_name }}
@endsection

@section('stylesheet')


    <style>
        .sweet-alert {
            z-index: 200000;
            font-size: 40px;
        }

        .star-rating span {
            cursor: pointer;
        }

        .owl-item {
            height: 100px;
        }
    </style>
@endsection

@section('content')
    <div class="card-wrapper">
        <div class="card">
            <!-- card left -->
            <div class="product-imgs">
                <div class="img-display">

                    <div class="img-showcase">
                        <img src="{{ asset($product->thumbnail_image) }}" alt="shoe image">
                        @foreach($productImage as $key => $val)
                            <img src="{{ asset($val->image) }}" alt="shoe image">

                        @endforeach
                    </div>
                </div>
                <div class="img-select">
                    <div class="img-item">
                        <a href="#" data-id="1">
                            <img style="max-height:150px; margin: 0 auto;" src="{{ asset($product->thumbnail_image) }}"
                                 alt="shoe image">
                        </a>
                    </div>
                    @foreach($productImage as $key => $val)
                        <div class="img-item">
                            <a href="#" data-id="{{ $key+2  }}">
                                <img style="max-height:150px; margin: 0 auto;" src="{{ asset($val->image) }}"
                                     alt="shoe image">
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
            <!-- card right -->
            <div class="product-content">
                <h3 class=>{{ $product->name }}</h3>
                <a href="#" class="product-link">{{ $product->brand_name }}</a>
                @if($num_of_review > 0)
                    <div class="ps-product__rating">
                        <i class="fa fa-star" @if($avg_review >= 1) style="color: #e0e000;" @endif></i>
                        <i class="fa fa-star" @if($avg_review >= 2) style="color: #e0e000;" @endif></i>
                        <i class="fa fa-star" @if($avg_review >= 3) style="color: #e0e000;" @endif></i>
                        <i class="fa fa-star" @if($avg_review >= 4) style="color: #e0e000;" @endif></i>
                        <i class="fa fa-star" @if($avg_review >= 5) style="color: #e0e000;" @endif></i>
                        <a href="#tab_02" aria-controls="tab_02" role="tab" data-toggle="tab">(Read
                            all {{ $num_of_review }} reviews)</a>
                    </div>
                @endif
                <div class="product-price">
                    <p class="last-price">Old Price: <span>{{ $product->previous_price }} Taka</span></p>
                    <p class="new-price">New Price: <span>{{ $product->price }} Taka</span></p>
                </div>

                <div class="product-detail">
                    <h2>about this item: </h2>
                    {{--                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eveniet veniam tempora fuga tenetur placeat sapiente architecto illum soluta consequuntur, aspernatur quidem at sequi ipsa!</p>--}}
                    {{--                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur, perferendis eius. Dignissimos, labore suscipit. Unde.</p>--}}
                    <ul>
                        {{--                        <li>Color: <span>Black</span></li>--}}
                        <li>Code: <span>{{ $product->code }}</span></li>
                        <li>Available: <span>
                                @if($product->quantity > 0)
                                    Available
                                @else
                                    <strong style="font-size: 10px; color: red">Out of stock</strong>
                                @endif
                            </span></li>
                        <li>Category: <span>{{ $product->category_name }} | {{ $product->sub_category_name }}</span>
                        </li>
                        <li>Brand: <span>{{ $product->brand_name }}</span></li>
                        <li>Shipping Fee: <span>Free</span></li>
                    </ul>
                </div>

                <div class="purchase-info">
                    @if(isset($product->color))

                        <hh>Colors</hh>
                        <ul>
                            @foreach(explode('|', $product->color) as $key => $color)
                                <li><label for="{{ $color }}">
                                        <input type="radio" @if($key == 0) checked @endif id="{{$color}}" name="color"
                                               value="{{ $color }}">
                                        <span class="btn"
                                              style="width: 10px; margin-left: -21px; background: {{ $color }}"></span></label>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="ps-product__shopping">
                        @if($product->quantity > 0 && $product->price > 0)
                            <div class="form-group--number mb-20">
                                <button class="minus minus-btn"><span>-</span></button>
                                <input class="form-control input-quantity" type="number" value="1">
                                <button class="plus plus-btn"><span>+</span></button>
                            </div>
                            <br>
                        @endif
                        <div class="">
                            @if($product->quantity > 0 && $product->price > 0)
                                <a class="btn mb-10 add-to-cart1" style="cursor: pointer" data-id="{{ $product->id }}">Add
                                    to cart</a>
                            @endif
                            <a title="Add to Wishlist" class="btn mb-10 add-to-wishlist " style="cursor: pointer; -webkit-writing-mode: vertical-rl;font-size: 30px; padding: 0 5px;
"
                               data-url="{{ route('customer.wishlist.add', $product->id) }}"><i
                                    class="ps-icon-heart"></i></a>
                            <a title="Add to Compair" style="cursor: pointer; -webkit-writing-mode: vertical-rl;font-size: 30px; padding: 0 5px;
" class="compare_btn btn mb-10"
                               data-url="{{ route('compare.add', $product->id) }}"><span style="margin-right: 5px;
margin-bottom: 5px;" class="glyphicon glyphicon-tags"></span></a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap');

        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
            font-family: 'Open Sans', sans-serif;
        }

        body {
            line-height: 1.5;
        }

        .card-wrapper {
            max-width: 1100px;
            margin: 0 auto;
        }

        img {
            width: 100%;
            display: block;
        }

        .img-display {
            overflow: hidden;
        }

        .img-showcase {
            display: flex;
            width: 100%;
            transition: all 0.5s ease;
        }

        .img-showcase img {
            min-width: 100%;
        }

        .img-select {
            display: flex;
        }

        .img-item {
            margin: 0.3rem;
        }

        .img-item:nth-child {
            margin-right: 0;
        }

        .img-item:hover {
            opacity: 0.8;
        }

        .product-content {
            padding: 2rem 1rem;
        }

        .product-title {
            font-size: 3rem;
            text-transform: capitalize;
            font-weight: 700;
            position: relative;
            color: #12263a;
            margin: 1rem 0;
        }

        .product-title::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            height: 4px;
            width: 80px;
            background: #12263a;
        }

        .product-link {
            text-decoration: none;
            text-transform: uppercase;
            font-weight: 400;
            font-size: 0.9rem;
            display: inline-block;
            margin-bottom: 0.5rem;
            background: #8b75b3;
            color: #fff;
            padding: 0 0.3rem;
            transition: all 0.5s ease;
        }

        .product-link:hover {
            opacity: 0.9;
        }

        .product-rating {
            color: #ffc107;
        }

        .product-rating span {
            font-weight: 600;
            color: #252525;
        }

        .product-price {
            margin: 1rem 0;
            font-size: 1rem;
            font-weight: 700;
        }

        .product-price span {
            font-weight: 400;
        }

        .last-price span {
            color: #f64749;
            text-decoration: line-through;
        }

        .new-price span {
            color: #8b75b3;
        }

        .product-detail h2 {
            text-transform: capitalize;
            color: #12263a;
            padding-bottom: 0.6rem;
        }

        .product-detail p {
            font-size: 0.9rem;
            padding: 0.3rem;
            opacity: 0.8;
        }

        .product-detail ul {
            margin: 1rem 0;
            font-size: 0.9rem;
        }

        .product-detail ul li {
            margin: 0;
            list-style: none;
            background: url(https://img1.pnghut.com/3/19/2/Rd4iwvCcGb/royaltyfree-line-art-check-mark-green-brand.jpg) left center no-repeat;
            background-size: 18px;
            padding-left: 1.7rem;
            margin: 0.4rem 0;
            font-weight: 600;
            opacity: 0.9;
        }

        .search-item a {
            background: #fff;
        }
        .search-item li:hover {
            background: #b6ce42;
            padding: 2px;
        }

        .product-detail ul li span {
            font-weight: 400;
        }

        .purchase-info {
            margin: 1.5rem 0;
        }

        .purchase-info input,
        .purchase-info .btn {
            /*border: 1.5px solid #ddd;*/
            /*border-radius: 25px;*/
            text-align: center;
            /*padding: 0.45rem 0.8rem;*/
            /*outline: 0;*/
            /*margin-right: 0.2rem;*/
            /*margin-bottom: 1rem;*/
        }

        .purchase-info input {
            width: 60px;
        }

        .purchase-info .btn {
            cursor: pointer;
            color: #fff;
        }

        .purchase-info .btn:first-of-type {
            background: #8b75b3;
        }

        .purchase-info .btn:last-of-type {
            background: #8b75b3;
        }

        .purchase-info .btn:hover {
            opacity: 0.9;
        }

        .social-links {
            display: flex;
            align-items: center;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 32px;
            height: 32px;
            color: #000;
            border: 1px solid #000;
            margin: 0 0.2rem;
            border-radius: 50%;
            text-decoration: none;
            font-size: 0.8rem;
            transition: all 0.5s ease;
        }

        .social-links a:hover {
            background: #000;
            border-color: transparent;
            color: #fff;
        }

        @media screen and (min-width: 992px) {
            .card {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                grid-gap: 1.5rem;
            }

            .card-wrapper {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            .product-imgs {
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .product-content {
                padding-top: 0;
            }
        }
    </style>

    <script !src="">
        const imgs = document.querySelectorAll('.img-select a');
        const imgBtns = [...imgs];
        let imgId = 1;

        imgBtns.forEach((imgItem) => {
            imgItem.addEventListener('click', (event) => {
                event.preventDefault();
                imgId = imgItem.dataset.id;
                slideImage();
            });
        });

        function slideImage() {
            const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

            document.querySelector('.img-showcase').style.transform = `translateX(${-(imgId - 1) * displayWidth}px)`;
        }

        window.addEventListener('resize', slideImage);


    </script>
    <div class="ps-product--detail pt-0">
        <div class="ps-container">
            <div class="row">
                <div class="col-lg-10 col-md-12 col-lg-offset-1">
                    <div class="clearfix"></div>
                    <div class="ps-product__content mt-50 bg-white">
                        @if(session()->has('status'))
                            {!! session()->get('status') !!}
                        @endif
                        <ul class="tab-list" role="tablist">
                            <li class="active btn"><a href="#tab_01" aria-controls="tab_01" role="tab"
                                                      data-toggle="tab">Specification</a></li>
                            <li class="btn"><a href="#tab_03 " aria-controls="tab_03" role="tab" data-toggle="tab">Description</a>
                            </li>
                            <li class="btn"><a href="#tab_02" aria-controls="tab_02" role="tab" data-toggle="tab">ADDITIONAL
                                    Information</a></li>
                            <li class="btn"><a href="#tab_04" aria-controls="tab_04" role="tab"
                                               data-toggle="tab">Review</a></li>
                            {{--<li><a href="#tab_03" aria-controls="tab_03" role="tab" data-toggle="tab">PRODUCT TAG</a></li>--}}

                        </ul>
                    </div>
                    <div class="tab-content mb-60 card bg-white" style="grid-template-columns: repeat(1, 1fr);">
                        <div class="tab-pane active" role="tabpanel" id="tab_01">
                            {!! $product->specification !!}
                        </div>
                        <div class="tab-pane" role="tabpanel" id="tab_03">
                            {!! $product->description !!}
                        </div>
                        <div class="tab-pane" role="tabpanel" id="tab_02">
                            <div class="form-group">
                                <strong class="h5">Weight: {{ $product->weight }}</strong>
                                <hr style="margin-bottom: 0px; margin-top: 0px">
                                <strong class="h5">Dimensions: {{ $product->dimensions }}</strong>
                                <hr style="margin-bottom: 0px; margin-top: 0px">
                                <strong class="h5">Include: {{ $product->include }}</strong>
                                <hr style="margin-bottom: 0px; margin-top: 0px">
                                <strong class="h5">Warranty: {{ $product->guarantee }}</strong>
                                <hr style="margin-bottom: 0px; margin-top: 0px">
                                <strong class="h5">Made In/Country of Origin: {{ $product->made_in }}</strong>
                            </div>
                        </div>

{{--                        <div class="tab-pane" role="tabpanel" id="tab_03">--}}
{{--                            <p>Add your tag <span> *</span></p>--}}
{{--                            <form class="ps-product__tags" action="_action" method="post">--}}
{{--                                <div class="form-group">--}}
{{--                                    <input class="form-control" type="text" placeholder="">--}}
{{--                                    <button class="ps-btn ps-btn--sm">Add Tags</button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
                        <div class="tab-pane" role="tabpanel" id="tab_04">
                            @if($num_of_review > 0)
                                <p class="mb-20">{{ $num_of_review }} review for <strong>{{ $product->name }}</strong>
                                </p>
                                <div class="ps-review">
                                    @foreach($reviews as $review)
                                        <div class="ps-review__thumbnail"><img src="{{ asset($review->image) }}" alt="">
                                        </div>
                                        <div class="ps-review__content">
                                            <header>
                                                <span class="fa fa-star"
                                                      @if($review->rating >= 1) style="color: #e0e000;" @endif></span>
                                                <span class="fa fa-star"
                                                      @if($review->rating >= 2) style="color: #e0e000;" @endif></span>
                                                <span class="fa fa-star"
                                                      @if($review->rating >= 3) style="color: #e0e000;" @endif></span>
                                                <span class="fa fa-star"
                                                      @if($review->rating >= 4) style="color: #e0e000;" @endif></span>
                                                <span class="fa fa-star"
                                                      @if($review->rating >= 5) style="color: #e0e000;" @endif></span>
                                                <span class="mr-10"></span>

                                                <p>By<a href=""> {{ $review->name }}</a>
                                                    - {{ date('F d, Y', strtotime($review->created_at)) }}</p>
                                            </header>
                                            <p>{{ $review->message }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <form class="ps-product__review" action="{{ route('customer.review.add', $product->id) }}"
                                  method="post">
                                @csrf
                                <h4>ADD YOUR REVIEW</h4>
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
                                        <style>
                                            .star-rating {
                                                line-height: 32px;
                                            }

                                            .star-rating .fa-star {
                                                color: yellow;
                                            }
                                        </style>
                                        <div class="form-group">
                                            <label>Your rating<span></span></label>
                                            <div class="star-rating">
                                                <span class="fa fa-star" data-rating="1"></span>
                                                <span class="fa fa-star" data-rating="2"></span>
                                                <span class="fa fa-star" data-rating="3"></span>
                                                <span class="fa fa-star" data-rating="4"></span>
                                                <span class="fa fa-star" data-rating="5"></span>
                                                <input type="hidden" name="rating" class="rating-value" value="2">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Your Review:</label>
                                            <textarea class="form-control" name="message" required rows="6"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="ps-btn ps-btn--sm">Submit<i
                                                    class="ps-icon-next"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .tab-list .btn a {
        margin-top: 5px;
    }

    .tab-list .btn a {
        color: #fff !important;
        text-decoration: none;
    }
</style>

@section('script')
    <script !src="">
        $(document).ready(function () {
            $(document).on('click', '.add-to-wishlist', function () {
                var url = $(this).data('url');

                $.ajax({
                    url: url,
                    method: "get",
                    dataType: "html",
                    success: function (data) {
                        // data = JSON.parse(data)
                        // console.log(data)
                        if (data === "success") {
                            Swal.fire({
                                customClass: {
                                    container: 'sweet-alert'
                                },
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                onOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                },
                                icon: 'success',
                                title: 'Product added to Wishlist!'
                            })
                        }
                    }
                });
            });

            $(document).on('click', '.compare_btn', function () {
                var url = $(this).data('url');

                $.ajax({
                    url: url,
                    method: "get",
                    dataType: "html",
                    success: function (data) {
                        data = JSON.parse(data)
                        // console.log(data)
                        if (data.status === "success") {
                            Swal.fire({
                                customClass: {
                                    container: 'sweet-alert'
                                },
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                onOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                },
                                icon: 'success',
                                title: 'Product added to compare!'
                            })
                            $('.compare-count').text(data.compare_count)
                        }
                    }
                });
            });

            $(document).on('click', '.plus-btn', function () {
                // const price = parseFloat($('.single-price').val())
                const qu = (Number($('.input-quantity').val()) + 1);
                if (qu > 0) {
                    // const newPrice = (price * qu)
                    $('.input-quantity').val(qu)
                    // $('.cart-popup-total-price').text(newPrice + " TK")
                } else {
                    $('.input-quantity').val(1)
                }
            })
            // clicking on modal minus btn
            $(document).on('click', '.minus-btn', function () {
                // const price = parseFloat($('.single-price').val())
                const qu = (Number($('.input-quantity').val()) - 1);
                if (qu > 0) {
                    // const newPrice = (price * qu)
                    $('.input-quantity').val(qu)
                    // $('.cart-popup-total-price').text(newPrice + " TK")
                } else {
                    $('.input-quantity').val(1)
                }
            })
            $(document).on('click', '.add-to-cart1', function () {
                var pid = $(this).data('id');
                var radioValue = $("input[name='color']:checked").val();
                var color = "no color";
                if (radioValue !== undefined) {
                    color = radioValue;
                }
                console.log(color)
                const qu = Number($('.input-quantity').val());
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var photoPath = "{{ asset('') }}"

                $.ajax({
                    url: "{{ route('cart.add') }}",
                    method: "post",
                    dataType: "html",
                    data: {product_id: pid, quantity: qu},
                    success: function (data) {
                        data = JSON.parse(data)
                        // console.log(data)
                        if (data.status === "success") {
                            let output = '';
                            $.each(data.content, function (i, e) {
                                output += '<div class="item ps-cart-item">'
                                output +=
                                    '<div class="image ps-cart-item__thumbnail"><img src="' +
                                    photoPath + e.attributes.image +
                                    '"  width="47" height="47"></div>'
                                output += '<div class="info">'
                                output += '<div class="name">' + ((e.name.length > 20) ?
                                    (e.name.substring(0, 20) + "...") : e.name) +
                                    '</div>'
                                output += '<span class="amount">' + e.price + '৳</span>'
                                output += '<i class="fa fa-times"></i>'
                                output += '<span>' + e.quantity + '</span>'
                                output += '<span class="eq">=</span>'
                                output += '<span class="total">' + (e.quantity * e
                                    .price) + ' ৳</span>'
                                output += '</div>'
                                output +=
                                    '<div class="remove"><a href="{{ URL::to('cart/remove') }}/' +
                                    e.id +
                                    '"><i class="fa fa-trash" aria-hidden="true"></i></a></div>'
                                output += '</div>'
                            })

                            if (data.has_many === "yes") {
                                Swal.fire({
                                    customClass: {
                                        container: 'sweet-alert'
                                    },
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    onOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    },
                                    icon: 'warning',
                                    title: 'This product is added once'
                                })
                                setTimeout(function () {
                                    Swal.fire({
                                        customClass: {
                                            container: 'sweet-alert'
                                        },
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        onOpen: (toast) => {
                                            toast.addEventListener('mouseenter', Swal.stopTimer)
                                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                                        },
                                        icon: 'success',
                                        title: 'Product added success!'
                                    })
                                }, 3000);
                            } else {
                                Swal.fire({
                                    customClass: {
                                        container: 'sweet-alert'
                                    },
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    onOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer)
                                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                                    },
                                    icon: 'success',
                                    title: 'Product added success!'
                                })
                            }

                            $('.cart-count').html(data.totalItem)
                            // $('.ps-cart__total_item').html(data.totalItem)
                            $('.ps-cart__total_amount').html("TK " + data.total)
                            $('.ps-cart__content').html(output)
                        }
                        if (data.available === "no") {
                            Swal.fire({
                                customClass: {
                                    container: 'sweet-alert'
                                },
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                onOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                },
                                icon: 'warning',
                                title: 'Stock out!'
                            })
                        }

                    }
                });
            });
        });
    </script>
@endsection
