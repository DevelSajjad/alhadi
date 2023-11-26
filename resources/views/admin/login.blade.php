<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from slidesigma.com/themes/html/costic/pages/prebuilt-pages/default-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Mar 2020 03:45:39 GMT -->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  {{--<title> @yield('title')</title>--}}
  <title>AL Hadi Enterprise</title>

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Iconic Fonts -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/admin/vendors/iconic-fonts/flat-icons/flaticon.css') }}">
  <link href="{{ asset('assets/admin/vendors/iconic-fonts/font-awesome/css/all.min.css') }}" rel="stylesheet">
  <!-- Bootstrap core CSS -->
  <link href="{{ asset('assets/admin/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- jQuery UI -->
  {{--<link href="{{ asset('assets/admin/css/jquery-ui.min.css) }}" rel="stylesheet">--}}
  <!-- Costic styles -->
  <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet">
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('assets/images/fav.png') }}" type="image/x-icon">


  <script src='https://www.google.com/recaptcha/api.js'></script>

</head>

<body class="ms-body ms-primary-theme ms-logged-out">

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

<!-- Main Content -->
<main class="body-content">
  <!-- Body Content Wrapper -->
  <div class="ms-content-wrapper ms-auth">
    <div class="ms-auth-container">
      <div class="ms-auth-bg" style=" margin-top: 120px; margin-left: 20px">
        <a href="{{ route('home') }}"><img style="width: 450px;" src="{{ asset('assets/images/logo-square.png') }}" alt="logo"></a>
      </div>
      <div class="ms-auth-col">
        <div class="ms-auth-form">
          <form class="needs-validation" method="POST" action="{{ route('admin.login') }}">
            @csrf
            <h3>Login to Account</h3>
            <p>Please enter your email and password to continue</p>

            @if(session()->has('status'))
              {!! session()->get('status') !!}
            @endif

            <div class="mb-3">
              <label for="validationCustom08">Email Address</label>
              <div class="input-group">
                <input type="email" id="validationCustom08" name="email" placeholder="Email Address" value="{{ old('email') }}" required class="form-control @error('email') is-invalid @enderror">
                @error('email')
                  <strong class="text-danger">{{ $errors->first('email') }}</strong>
                @enderror
              </div>
            </div>
            <div class="mb-2">
              <label for="validationCustom09">Password</label>
              <div class="input-group">
                <input type="password" id="validationCustom09" name="password" placeholder="Password" value="{{ old('password') }}" required class="form-control @error('password') is-invalid @enderror">
                @error('password')
                  <strong class="text-danger">{{ $errors->first('password') }}</strong>
                @enderror
              </div>
            </div>
            {{-- <div class="form-group">
                <div class="g-recaptcha" data-sitekey="6Le6NKkZAAAAAJzzE7vzTdJe3T2Vpaya65i-YJqL"></div>
                @error('g-recaptcha-response')
                  <strong class="text-danger">{{ $errors->first('g-recaptcha-response') }}</strong>
                @enderror
            </div> --}}
            {{--<div class="form-group">--}}
              {{--<label class="ms-checkbox-wrap">--}}
                {{--<input class="form-check-input" type="checkbox" value=""> <i class="ms-checkbox-check"></i>--}}
              {{--</label> <span> Remember Password </span>--}}
              {{--<label class="d-block mt-3"><a href="#" class="btn-link" data-toggle="modal" data-target="#modal-12">Forgot Password?</a>--}}
              {{--</label>--}}
            {{--</div>--}}
            <button class="btn btn-primary mt-4 d-block w-100" type="submit">Sign In</button>
            {{--<p class="mb-0 mt-3 text-center">Don't have an account? <a class="btn-link" href="default-register.html">Create Account</a>--}}
            {{--</p>--}}
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Forgot Password Modal -->
  <div class="modal fade" id="modal-12" tabindex="-1" role="dialog" aria-labelledby="modal-12">
    <div class="modal-dialog modal-dialog-centered modal-min" role="document">
      <div class="modal-content">
        <div class="modal-body text-center">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
          </button> <i class="flaticon-secure-shield d-block"></i>
          <h1>Forgot Password?</h1>
          <p>Enter your email to recover your password</p>
          <form method="post">
            <div class="ms-form-group has-icon">
              <input type="text" placeholder="Email Address" class="form-control" name="forgot-password" value=""> <i class="material-icons">email</i>
            </div>
            <button type="submit" class="btn btn-primary shadow-none">Reset Password</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- SCRIPTS -->
<!-- Global Required Scripts Start -->
<script src="{{ asset('assets/admin/js/jquery-3.3.1.min.js') }}"></script>
{{--<script src="{{ asset('assets/admin/js/popper.min.js') }}"></script>--}}
{{--<script src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>--}}
{{--<script src="{{ asset('assets/admin/js/perfect-scrollbar.js') }}"></script>--}}
{{----}}
{{--<script src="{{ asset('assets/admin/js/jquery-ui.min.js') }}"></script>--}}
{{----}}
{{--<!-- Global Required Scripts End -->--}}
{{--<!-- Costic core JavaScript -->--}}
<script src="{{ asset('assets/admin/js/framework.js') }}"></script>
{{--<!-- Settings -->--}}
{{--<script src="{{ asset('assets/admin/js/settings.js') }}"></script>--}}
</body>


<!-- Mirrored from slidesigma.com/themes/html/costic/pages/prebuilt-pages/default-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 06 Mar 2020 03:45:39 GMT -->
</html>
