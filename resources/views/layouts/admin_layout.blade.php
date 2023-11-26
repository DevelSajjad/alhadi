<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from slidesigma.com/themes/html/costic/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Mar 2020 03:34:45 GMT -->
<head>
    <meta name="facebook-domain-verification" content="ug3pzda6xnsvy6ea69zzhrde2m6vri" />
    
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  {{--<title> @yield('title')</title>--}}
  <title>AL Hadi Enterprise</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Iconic Fonts -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="{{ asset('assets/admin/vendors/iconic-fonts/font-awesome/css/all.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/admin/vendors/iconic-fonts/flat-icons/flaticon.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/vendors/iconic-fonts/cryptocoins/cryptocoins.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/vendors/iconic-fonts/cryptocoins/cryptocoins-colors.css') }}">
  <!-- Bootstrap core CSS -->
  <link href="{{ asset('assets/admin//css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- jQuery UI -->
  <link href="{{ asset('assets/admin//css/jquery-ui.min.css') }}" rel="stylesheet">
  <!-- Page Specific CSS (Slick Slider.css) -->
  {{--<link href="{{ asset('assets/admin//css/slick.css') }}" rel="stylesheet">--}}
  {{--<link href="{{ asset('assets/admin//css/datatables.min.css') }}" rel="stylesheet">--}}
  <!-- Costic styles -->
  <link href="{{ asset('assets/admin//css/style.css') }}" rel="stylesheet">


    @yield('stylesheet')

<!-- Favicon -->
  {{--<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/admin/favicon.ico') }}">--}}
  <link rel="icon" href="{{ asset('assets/images/fav.png') }}" type="image/x-icon">

</head>

<body class="ms-body ms-aside-left-open ms-primary-theme ms-has-quickbar">
<!-- Preloader -->
<div id="preloader-wrap">
  <div class="spinner spinner-8">
    <div class="ms-circle1 ms-child"></div>
    <div class="ms-circle2 ms-child"></div>
    <div class="ms-circle3 ms-child"></div>
    <div class="ms-circle4 ms-child"></div>
    <div class="ms-circle5 ms-child"></div>
    <div class="ms-circle6 ms-child"></div>
    <div class="ms-circle7 ms-child"></div>
    <div class="ms-circle8 ms-child"></div>
    <div class="ms-circle9 ms-child"></div>
    <div class="ms-circle10 ms-child"></div>
    <div class="ms-circle11 ms-child"></div>
    <div class="ms-circle12 ms-child"></div>
  </div>
</div>
<!-- Overlays -->
<div class="ms-aside-overlay ms-overlay-left ms-toggler" data-target="#ms-side-nav" data-toggle="slideLeft"></div>
<div class="ms-aside-overlay ms-overlay-right ms-toggler" data-target="#ms-recent-activity" data-toggle="slideRight"></div>
<!-- Sidebar Navigation Left -->
<aside id="ms-side-nav" class="side-nav fixed ms-aside-scrollable ms-aside-left">
  @php
    $logo = $company_info->logo?? ''
  @endphp
  <!-- Logo -->
  <div class="logo-sn ms-d-block-lg">
    <a class="pl-0 ml-0 text-center" href="{{ route('home') }}">
      <img src="{{ asset($logo) }}" alt="logo">
    </a>
  </div>
  <!-- Navigation -->
  <ul class="accordion ms-main-aside fs-14" id="side-nav-accordion">
    <!-- dashboard -->
    <li class="menu-item">
      <a href="{{ route('admin.dashboard') }}" > <span><i class="material-icons fs-16">dashboard</i>Dashboard</span>
      </a>
    </li>
    <!-- dashboard end -->
  @if(auth()->user()->type == 'admin')
    <!-- moberator -->
    <li class="menu-item">
      <a href="#" class="has-chevron" data-toggle="collapse" data-target="#moderator" aria-expanded="false" aria-controls="moderator"> <span><i class="fa fa-users-cog fs-16"></i>Moderator</span>
      </a>
      <ul id="moderator" class="collapse" aria-labelledby="moderator" data-parent="#side-nav-accordion">
        <li> <a href="{{ route('admin.moderator.add') }}">Add</a></li>
        <li> <a href="{{ route('admin.moderator.view') }}">View</a></li>
      </ul>
    </li>

    {{-- log start--}}
    <li class="menu-item">
      <a href="{{ route('admin.logs') }}"> <span><i class="fas fa-clipboard-list fs-16"></i>Activity Logs</span>
      </a>
    </li>
    {{-- log end--}}

    <li class="menu-item">
      <a href="{{ route('admin.report.index') }}"> <span><i class="fas fa-clipboard-list fs-16"></i>Sales Report</span>
      </a>
    </li>

    {{-- Message start--}}
    <li class="menu-item">
      <a href="{{ route('admin.message.add') }}"> <span><i class="fas fa-envelope fs-16"></i>Send Message</span>
      </a>
    </li>

    <li class="menu-item">
      <a href="{{ route('admin.messages') }}"> <span><i class="fas fa-box-open fs-16"></i>Message Logs</span>
      </a>
    </li>
    {{-- Message ends --}}
    {{-- Customer start--}}
    <li class="menu-item">
      <a href="{{ route('admin.customer') }}"> <span><i class="fas fa-user-friends fs-16"></i>Customer Logs</span>
      </a>
    </li>
    {{-- Customer ends --}}
  @endif
    <!-- moberator end -->

     <!-- order -->
     <li class="menu-item">
      <a href="#" class="has-chevron" data-toggle="collapse" data-target="#oders" aria-expanded="false" aria-controls="oders"> <span><i class="fa fa-tags fs-16"></i>Order</span>
      </a>
      <ul id="oders" class="collapse" aria-labelledby="oders" data-parent="#side-nav-accordion">
        <li> <a href="{{ route('admin.order.view') }}">View</a></li>
        <li> <a href="{{ route('admin.order.unpaid') }}">Unpaid</a></li>
      </ul>
    </li>
    <!-- order end -->

    <!-- product -->
    <li class="menu-item">
      <a href="#" class="has-chevron" data-toggle="collapse" data-target="#product" aria-expanded="false" aria-controls="product"> <span><i class="fa fa-archive fs-16"></i>Product</span>
      </a>
      <ul id="product" class="collapse" aria-labelledby="product" data-parent="#side-nav-accordion">
        <li> <a href="{{ route('admin.product.add') }}">Add</a></li>
        <li> <a href="{{ route('admin.product.view') }}">View</a></li>
      </ul>
    </li>
    <!-- product end -->

    <!-- Coupons -->
  <li class="menu-item">
    <a href="{{ route('admin.coupon.add') }}" class="" aria-expanded="false" aria-controls="gallery"> <span><i class="fa fa-ticket-alt fs-16"></i>Coupons</span>
    </a>
  </li>
  <!-- Coupons end -->

    <!-- Notice -->
    <li class="menu-item">
      <a href="#" class="has-chevron" data-toggle="collapse" data-target="#notice" aria-expanded="false" aria-controls="notice"> <span><i class="material-icons fs-16">border_color</i>Notice</span>
      </a>
      <ul id="notice" class="collapse" aria-labelledby="notice" data-parent="#side-nav-accordion">
        <li> <a href="{{ route('admin.notice.add') }}">Add</a></li>
        <li> <a href="{{ route('admin.notice.view') }}">View</a></li>
      </ul>
    </li>
    <!-- brand end -->


    <!-- brand -->
    <li class="menu-item">
      <a href="#" class="has-chevron" data-toggle="collapse" data-target="#brand" aria-expanded="false" aria-controls="brand"> <span><i class="material-icons fs-16">menu</i>Brand</span>
      </a>
      <ul id="brand" class="collapse" aria-labelledby="brand" data-parent="#side-nav-accordion">
        <li> <a href="{{ route('admin.brand.add') }}">Add</a></li>
        <li> <a href="{{ route('admin.brand.view') }}">View</a></li>
      </ul>
    </li>
    <!-- brand end -->


    <!-- category -->
    <li class="menu-item">
      <a href="#" class="has-chevron" data-toggle="collapse" data-target="#category" aria-expanded="false" aria-controls="category"> <span><i class="material-icons fs-16">widgets</i>Category</span>
      </a>
      <ul id="category" class="collapse" aria-labelledby="category" data-parent="#side-nav-accordion">
        <li> <a href="{{ route('admin.category.add') }}">Add</a></li>
        <li> <a href="{{ route('admin.category.view') }}">View</a></li>
      </ul>
    </li>
    <!-- category end -->
    <!-- banner -->
    <li class="menu-item">
      <a href="#" class="has-chevron" data-toggle="collapse" data-target="#banner" aria-expanded="false" aria-controls="banner"> <span><i class="fa fa-bullhorn fs-16"></i>Banner</span>
      </a>
      <ul id="banner" class="collapse" aria-labelledby="banner" data-parent="#side-nav-accordion">
        <li> <a href="{{ route('admin.banner.add') }}">Add</a></li>
        <li> <a href="{{ route('admin.banner.view') }}">View</a></li>
      </ul>
    </li>
    <!-- banner end -->


    <!-- Side banner -->
    <li class="menu-item">
      <a href="#" class="has-chevron" data-toggle="collapse" data-target="#sidebanner" aria-expanded="false" aria-controls="sidebanner"> <span><i class="fa fa-bullhorn fs-16"></i>Side Banner</span>
      </a>
      <ul id="sidebanner" class="collapse" aria-labelledby="sidebanner" data-parent="#side-nav-accordion">
        <li> <a href="{{ route('admin.sidebanner.add') }}">Add</a></li>
        <li> <a href="{{ route('admin.sidebanner.view') }}">View</a></li>
      </ul>
    </li>
    <!-- Side banner end -->

    {{-- Top Clients --}}
    <li class="menu-item">
      <a href="#" class="has-chevron" data-toggle="collapse" data-target="#clients" aria-expanded="false" aria-controls="clients"> <span><i class="fa fa-handshake fs-16"></i>Clients</span>
      </a>
      <ul id="clients" class="collapse" aria-labelledby="clients" data-parent="#side-nav-accordion">
        <li> <a href="{{ route('admin.clients.add') }}">Add</a></li>
        <li> <a href="{{ route('admin.clients.view') }}">View</a></li>
      </ul>
    </li>
    {{-- end Top Clients --}}

  {{--<!-- Tables -->--}}
  <li class="menu-item">
    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#sub-category" aria-expanded="false" aria-controls="sub-category"> <span><i class="material-icons fs-16">tune</i>Sub Category</span>
    </a>
    <ul id="sub-category" class="collapse" aria-labelledby="sub-category" data-parent="#side-nav-accordion">
      <li> <a href="{{ route('admin.sub-category.add') }}">Add</a></li>
      <li> <a href="{{ route('admin.sub-category.view') }}">View</a></li>
    </ul>
  </li>
  {{--<!-- /Tables -->--}}

  <!-- Gallery -->
  <li class="menu-item">
    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#gallery" aria-expanded="false" aria-controls="gallery"> <span><i class="fa fa-image fs-16"></i>Gallery</span>
    </a>
    <ul id="gallery" class="collapse" aria-labelledby="gallery" data-parent="#side-nav-accordion">
      <li> <a href="{{ route('admin.gallery.add') }}">Add</a></li>
      <li> <a href="{{ route('admin.gallery.view') }}">View</a></li>
    </ul>
  </li>

    <!-- {Company Info} -->
    <li class="menu-item">
      <a href="#" class="has-chevron" data-toggle="collapse" data-target="#companyInfo" aria-expanded="false" aria-controls="companyInfo"> <span><i class="fa fa-bullhorn fs-16"></i>Company Info</span>
      </a>
      <ul id="companyInfo" class="collapse" aria-labelledby="companyInfo" data-parent="#side-nav-accordion">
        <li> <a href="{{ route('admin.companyInfo.edit') }}">Update</a></li>
      </ul>
    </li>

    <!-- {Policies} -->
  <li class="menu-item">
    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#policy" aria-expanded="false" aria-controls="policy"> <span><i class="fa fa-bullhorn fs-16"></i>Return & Refund Policy</span>
    </a>
    <ul id="policy" class="collapse" aria-labelledby="policy" data-parent="#side-nav-accordion">
      <li> <a href="{{ route('admin.policy.view') }}">View</a></li>
      <li> <a href="{{ route('admin.policy.update') }}">Update</a></li>
    </ul>
  </li>

  <li class="menu-item">
    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#term" aria-expanded="false" aria-controls="term"> <span><i class="fa fa-bullhorn fs-16"></i>Term and Condition</span>
    </a>
    <ul id="term" class="collapse" aria-labelledby="term" data-parent="#side-nav-accordion">
      <li> <a href="{{ route('admin.term.view') }}">View</a></li>
      <li> <a href="{{ route('admin.term.update') }}">Update</a></li>
    </ul>
  </li>

  {{-- Privacy policy --}}
  <li class="menu-item">
    <a href="#" class="has-chevron" data-toggle="collapse" data-target="#privacy" aria-expanded="false" aria-controls="privacy"> <span><i class="fa fa-bullhorn fs-16"></i>Privacy & Policy</span>
    </a>
    <ul id="privacy" class="collapse" aria-labelledby="privacy" data-parent="#side-nav-accordion">
      <li> <a href="{{ route('admin.privacy.view') }}">View</a></li>
      <li> <a href="{{ route('admin.privacy.update') }}">Update</a></li>
    </ul>
  </li>

  <!-- {Socials} -->
      <li class="menu-item">
          <a href="#" class="has-chevron" data-toggle="collapse" data-target="#socials" aria-expanded="false" aria-controls="socials"> <span><i class="material-icons fs-16">border_color</i>Socials</span>
          </a>
          <ul id="socials" class="collapse" aria-labelledby="socials" data-parent="#side-nav-accordion">
              <li> <a href="{{ route('admin.socials.add') }}">Add</a></li>
              <li> <a href="{{ route('admin.socials.view') }}">View</a></li>
          </ul>
      </li>
  <!-- Gallery end -->



  </ul>
</aside>

<!-- Main Content -->
<main class="body-content">
  <!-- Navigation Bar -->
  <nav class="navbar ms-navbar">
    <div class="ms-aside-toggler ms-toggler pl-0" data-target="#ms-side-nav" data-toggle="slideLeft"> <span class="ms-toggler-bar bg-primary"></span>
      <span class="ms-toggler-bar bg-primary"></span>
      <span class="ms-toggler-bar bg-primary"></span>
    </div>
    <div class="logo-sn logo-sm ms-d-block-sm">
      <a class="pl-0 ml-0 text-center navbar-brand mr-0" href="{{ route('home') }}"><img src="{{ asset('assets/images/logo_long.jpg') }}" alt="logo"> </a>
    </div>
    <ul class="ms-nav-list ms-inline mb-0" id="ms-nav-options">
      @if($orderNotify->count() > 0)
        <li class="ms-nav-item dropdown"> <a href="#" class="text-disabled ms-has-notification" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flaticon-bell"></i></a>
          <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown">
            <li class="dropdown-menu-header">
              <h6 class="dropdown-header ms-inline m-0"><span class="text-disabled">Notifications</span></h6><span class="badge badge-pill badge-info">{{ $orderNotify->count() }} New</span>
            </li>
            <li class="dropdown-divider"></li>
            <li class="ms-scrollable ms-dropdown-list">
              @foreach($orderNotify as $item)
                <a class="media p-2" href="{{ route('admin.order.details', $item->id) }}">
                  <div class="media-body"> <span><strong class="mr-1">ID: {{ $item->id }}</strong> ({{ $item->amount }} TK) <strong class="ml-1 mr-1">{{ $item->status }}</strong> (<span class="text-capitalize">{{ $item->area }}</span>)</span>
                    <p class="fs-10 my-1 text-disabled"><i class="material-icons">access_time</i> {{ date('h:s:i A - M d, Y', strtotime($item->created_at)) }}</p>
                  </div>
                </a>
              @endforeach
            </li>
          </ul>
        </li>
      @endif

      <li class="ms-nav-item ms-nav-user dropdown">
        <a href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img class="ms-user-img ms-img-round float-right" src="{{ asset('assets/images/user.png') }}" alt="people">
        </a>
        <ul class="dropdown-menu dropdown-menu-right user-dropdown" aria-labelledby="userDropdown">
          <li class="dropdown-menu-header">
            <h6 class="dropdown-header ms-inline m-0"><span class="text-disabled">Welcome, {{ auth()->user()->name }}</span></h6>
          </li>
          <li class="dropdown-divider"></li>
          <li class="ms-dropdown-list">
            <a class="media fs-14 p-2" href="{{ route('admin.profile') }}"> <span><i class="flaticon-user mr-2"></i> Profile</span>
            </a>
            <a class="media fs-14 p-2" href="{{ route('admin.contact') }}"> <span><i class="flaticon-phone mr-2"></i> Contact No</span>
            </a>
            <a class="media fs-14 p-2" href="{{ route('admin.changePassword') }}"> <span><i class="flaticon-gear mr-2"></i>Change Password</span>
            </a>
          </li>
          <li class="dropdown-divider"></li>
          <li class="dropdown-menu-footer">
            <a class="media fs-14 p-2" href="{{ route('admin.logout') }}"> <span><i class="flaticon-shut-down mr-2"></i> Logout</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
    <div class="ms-toggler ms-d-block-sm pr-0 ms-nav-toggler" data-toggle="slideDown" data-target="#ms-nav-options"> <span class="ms-toggler-bar bg-primary"></span>
      <span class="ms-toggler-bar bg-primary"></span>
      <span class="ms-toggler-bar bg-primary"></span>
    </div>
  </nav>
  <div class="ms-content-wrapper">
      @yield('content')
  </div>
</main>
<!-- MODALS -->
<!-- SCRIPTS -->
<!-- Global Required Scripts Start -->
{{-- <script src="{{ asset('assets/admin/js/jquery-3.3.1.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> --}}
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="{{ asset('assets/admin/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/admin/js/jquery-ui.min.js') }}"></script>
<!-- Global Required Scripts End -->
<!-- Page Specific Scripts Start -->


{{--<script src="{{ asset('assets/admin/js/clients.js') }}"></script>--}}
{{--<script src="{{ asset('assets/admin/js/Chart.Financial.js') }}"></script>--}}
{{--<script src="{{ asset('assets/admin/js/d3.v3.min.js') }}"></script>--}}
{{--<script src="{{ asset('assets/admin/js/topojson.v1.min.js') }}"></script>--}}
{{--<script src="{{ asset('assets/admin/js/datatables.min.js') }}"></script>--}}
{{--<script src="{{ asset('assets/admin/js/data-tables.js') }}"></script>--}}
{{--<!-- Page Specific Scripts Finish -->--}}
<!-- Costic core JavaScript -->
<script src="{{ asset('assets/admin/js/framework.js') }}"></script>
<!-- Settings -->
{{--<script src="{{ asset('assets/admin/js/settings.js') }}"></script>--}}
@yield('script')

</body>


<!-- Mirrored from slidesigma.com/themes/html/costic/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Mar 2020 03:37:31 GMT -->
</html>
