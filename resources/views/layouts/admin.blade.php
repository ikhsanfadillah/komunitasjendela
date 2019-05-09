<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Komunitas Jendela - @yield('title') </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.addons.css') }}">
    <!-- endinject -->

    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}"/>
    {{-- <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}"> --}}
    @yield('styles')
</head>

<body>

    <div class="container-scroller">

        <!-- NAVBAR TOP -->
        @include('partials._navbar')
        <!-- NAVBAR TOP ENDS -->

        <!-- CONTENT BODY WRAPPER -->
        <div class="container-fluid page-body-wrapper">

            <!-- SIDEBAR -->
            @include('partials._sidebar')
            <!-- SIDEBAR END -->

            <!-- MAIN PANEL -->
            <div class="main-panel">

                <!-- CONTENT -->
                @yield('content')
                <!-- CONTENT END -->

                <!-- FOOTER -->
                @include('partials._footer')
                <!-- FOOTEREND -->
            </div>
            <!-- MAIN PANEL ENDS-->

        </div>
        <!-- CONTENT BODY WRAPPER END-->

    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('vendors/js/vendor.bundle.addons.js') }}"></script>
    <!-- endinject -->

    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/misc.js') }}"></script>
    <!-- endinject -->

    <!-- Custom js for this page-->
    @yield('script')
    <!-- End custom js for this page-->
</body>

</html>
