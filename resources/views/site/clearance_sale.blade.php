@extends('layouts.frontend_layout')
@section('stylesheet')

  <link rel="stylesheet"
        href="{{ asset("assets/frontend/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css") }}">
  <link rel="stylesheet" href="{{ asset("assets/frontend/plugins/slick/slick/slick.css") }}">
  <link rel="stylesheet"
        href="{{ asset("assets/frontend/plugins/bootstrap-select/dist/css/bootstrap-select.min.css") }}">
  <link rel="stylesheet" href="{{ asset("assets/frontend/plugins/Magnific-Popup/dist/magnific-popup.css") }}">
  <link rel="stylesheet" href="{{ asset("assets/frontend/plugins/jquery-ui/jquery-ui.min.css") }}">
@endsection

@section('content')

  <div class="container">
    <div class="row">
      <div class="col-12 text-center" style="margin: 25px">
        <h2><strong>Clearance Sale</strong></h2>
      </div>
    </div>
    <div class="row">
      @foreach ($clearingsales as $value)
        <div class="col-md-3 col-lg-3 col-xl-3" style="margin-bottom: 20px">
          <div style="max-width: 200px; max-height: 200px; margin: auto;">
            <div class="product-container">
              <div class="content">
                <div class="content-overlay"></div>
                <img style="height: 200px!important; max-width: 200px!important;" class="content-image"
                     src="{{ asset($value->thumbnail_image) }}">
                @if($value->quantity > 0 && $value->price > 0)
                  <div class="content-details fadeIn-top" style="margin-top: -50px;">
                    <a class="btn btn-success add-to-cart" data-id="{{ $value->id }}"><i class="fa fa-shopping-cart"></i> Add To Cart</a>
                  </div>
                @endif
                <div class="content-details fadeIn-bottom">
                  <a class="btn btn-success" href="{{ route('product.details', $value->slug) }}"><i class="fa fa-tasks"></i> See Details</a>
                </div>
              </div>
            </div>
            <div style="float: left;">
              <p class="product-name">
                <a style="font-weight: bold; font-size: larger; color: black;"
                   href="{{ route('product.details', $value->slug) }}">{{ (strlen($value->name) > 20 ) ? substr($value->name, 0, 20).'...' : $value->name }}</a>
              </p>
              <p style="margin: 0px;margin-top: -10px;">
                @if($value->quantity > 0)
                  <span class="ps-shoe__price"
                        style="font-size: 10px; color: #005caf"><strong>Available</strong></span>
                @else
                  <span class="ps-shoe__price"
                        style="font-size: 10px; color: red;"><strong>Out of stock</strong></span>
                @endif
              </p>
              @if($value->price > 0)
                <span style="font-weight: bold; color: #005caf;">Call for price</span>
              @else
                <span style="font-weight: bold; color: #005caf;">Call for price</span>
              @endif

            </div>
          </div>
        </div>
      @endforeach
    </div>
    <div class="row">
      <div class="col-12 text-right">
        <div class="shop_toolbar t_bottom">
          <div class="pagination">
            <ul>
              {!! $clearingsales->links() !!}
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection

@section('script')

  <script type="text/javascript" src="{{ asset("assets/frontend/plugins/gmap3.min.js") }}"></script>
  <script type="text/javascript" src="{{ asset("assets/frontend/plugins/imagesloaded.pkgd.js") }}"></script>
  <script type="text/javascript" src="{{ asset("assets/frontend/plugins/isotope.pkgd.min.js") }}"></script>
  <script type="text/javascript"
          src="{{ asset("assets/frontend/plugins/bootstrap-select/dist/js/bootstrap-select.min.js") }}"></script>
  <script type="text/javascript" src="{{ asset("assets/frontend/plugins/jquery.matchHeight-min.js") }}"></script>
  <script type="text/javascript" src="{{ asset("assets/frontend/plugins/slick/slick/slick.min.js") }}"></script>
  <script type="text/javascript"
          src="{{ asset("assets/frontend/plugins/elevatezoom/jquery.elevatezoom.js") }}"></script>
  <script type="text/javascript"
          src="{{ asset("assets/frontend/plugins/Magnific-Popup/dist/jquery.magnific-popup.min.js") }}"></script>
  <script type="text/javascript" src="{{ asset("assets/frontend/plugins/jquery-ui/jquery-ui.min.js") }}"></script>
  <script type="text/javascript"
          src="{{ asset("assets/frontend/plugins/revolution/js/jquery.themepunch.tools.min.js") }}"></script>
  <script type="text/javascript"
          src="{{ asset("assets/frontend/plugins/revolution/js/jquery.themepunch.revolution.min.js") }}"></script>
  <script type="text/javascript"
          src="{{ asset("assets/frontend/plugins/revolution/js/extensions/revolution.extension.video.min.js") }}"></script>
  <script type="text/javascript"
          src="{{ asset("assets/frontend/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js") }}"></script>
  <script type="text/javascript"
          src="{{ asset("assets/frontend/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js") }}"></script>
  <script type="text/javascript"
          src="{{ asset("assets/frontend/plugins/revolution/js/extensions/revolution.extension.navigation.min.js") }}"></script>
  <script type="text/javascript"
          src="{{ asset("assets/frontend/plugins/revolution/js/extensions/revolution.extension.parallax.min.js") }}"></script>
  <script type="text/javascript"
          src="{{ asset("assets/frontend/plugins/revolution/js/extensions/revolution.extension.actions.min.js") }}"></script>

  <script src="{{ asset('assets/frontend/js/sweetalert2.js') }}"></script>

  {{-- <script>
    $(document).ready(function () {


      $("#home-banner").owlCarousel({
        items: 1,
        loop: true,
        center: true,
        autoplay: true,
        autoplayTimeout: 6000,
        lazyLoad: true,
        lazyLoadEager: 1,
      });

      $(document).on('click', '.add-to-cart', function () {
        var pid = $(this).data('id');
        // console.log(pid)
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
          data: {product_id: pid, quantity: 1},
          success: function (data) {
            data = JSON.parse(data)
            // console.log(data)
            if (data.status === "success") {
              let output = '';
              $.each(data.content, function (i, e) {
                output += '<div class="ps-cart-item"><a class="ps-cart-item__close" href="{{ URL::to('cart/remove') }}/' + e.id + '"></a>'
                output += '<div class="ps-cart-item__thumbnail"><a href="#"></a><img src="' + photoPath + e.attributes.image + '" alt=""></div>'
                output += '<div class="ps-cart-item__content"><a class="ps-cart-item__title" href="">' + ((e.name.length > 20) ? (e.name.substring(0, 20) + "...") : e.name) + '</a>'
                output += '<p style="font-size: 10px"><span style="color: white">Qty: ' + e.quantity + ' X Tk ' + e.price + ' = ' + (e.quantity * e.price) + '  Tk</span></p>'
                output += '</div>'
                output += '</div>'
              })

              $('.cart-count').html(data.totalItem)
              // $('.ps-cart__total_item').html(data.totalItem)
              $('.ps-cart__total_amount').html("TK " + data.total)
              $('.ps-cart__content').html(output)

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
    })
  </script> --}}


  <script>
    $(function () {
      $('#dl-menu').dlmenu({
        animationClasses: {classin: 'dl-animate-in-3', classout: 'dl-animate-out-3'}
      });
    });
  </script>

  <script>
    $(window).load(function () {
      $("#header").sticky({topSpacing: 0});
    });
  </script>

  <script>
    $('.owl-carousel').owlCarousel({
      rtl:false,
      loop:false,
      dots:false,
      margin:10,
      nav:true,
      navText: ["<i class='fa fa-arrow-left' aria-hidden='true'></i> Prev", "Next <i class='fa fa-arrow-right' aria-hidden='true'></i>"],
      // navContainer: ".section-header",
      responsive:{
        0:{
          items:2
        },
        600:{
          items:3
        },
        1000:{
          items:5
        }
      }
    });

    // var carouselEl = $('.owl-carousel');



    // $(".my-next-button").click(function() {
    //     carouselEl.trigger('next.owl.carousel');
    // });

    // $(".my-previous-button").click(function() {
    //     carouselEl.trigger('prev.owl.carousel');
    // });
  </script>

@endsection
