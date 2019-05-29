<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin Free Bootstrap Admin Dashboard Template</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.addons.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png')}}"/>
</head>

<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">

            <div class="row w-100">
                <div class="col-lg-4 mx-auto">
                    <div class="auto-form-wrapper" style="padding-top: 20px; background-color: rgba(255,255,255,0.9)">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('images/auth/jendela-nasional.png') }}" alt="" style="width: auto; height: 50px; margin-bottom: 15px">
                        </div>
                        <!-- LOGIN FORM -->
                        <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- INPUT EMAIL -->
                            <div class="form-group">
                                <label class="label">Email</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <div class="input-group-append">
                                      <span class="input-group-text">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                      </span>
                                    </div>
                                </div>

                            </div>
                            <!-- END INPUT EMAIL -->

                            <!-- INPUT PASSWORD -->
                            <div class="form-group">
                                <label class="label">Password</label>
                                <div class="input-group">
                                    <input id="password" type="password" class="form-control" placeholder="*********" name="password" required autocomplete="current-password">
                                    <div class="input-group-append">
                                      <span class="input-group-text">
                                        <i class="mdi mdi-check-circle-outline"></i>
                                      </span>
                                    </div>
                                </div>
                            </div>
                            <!-- END INPUT PASSWORD -->
                            <div class="form-group d-flex justify-content-between">
                                <div class="form-check form-check-flat mt-0">
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Keep me signed in
                                    </label>
                                </div>

                                @if (Route::has('password.request'))

                                    <a class="text-small forgot-password text-black" href="{{ route('password.request') }}">
                                        {{ __('Forgot Password') }}
                                    </a>
                                @endif
                            </div>

                        @if($errors->any())
                                <div class="alert alert-danger" role="alert" style="font-size: .8em">
                                    A simple danger alert—check it out!
                                </div>
                            @endif
                            <div class="form-group">
                                <button class="btn btn-primary submit-btn btn-block">Login</button>
                            </div>

                            @if (Route::has('register'))
                                <div class="text-block text-center my-3">
                                    <span class="text-small font-weight-semibold">Not a member ?</span>
                                    <a href="{{ route('register') }}" class="text-black text-small">Contact Our Zaky Wibowo</a>
                                </div>
                            @endif
                        </form>
                    </div>
                    <p class="mt-2 footer-text text-center">copyright © 2018 Komunitas Jendela. All rights reserved.</p>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('vendors/js/vendor.bundle.addons.js') }}"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="{{ asset('js/off-canvas.js') }}"></script>
<script src="{{ asset('js/misc.js') }}"></script>
<!-- endinject -->
</body>

</html>