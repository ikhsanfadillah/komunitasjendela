<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Komunitas Jendela - @yield('title') </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.addons.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">
    <script src="{{ mix('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{asset('vendors/bootstrap-select-1.13.9/dist/css/bootstrap-select.min.css')}}">

    <script src="{{ asset('vendors/js/vendor.bundle.addons.js') }}"></script>
<!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ mix('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/toastjs/toast.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}"/>
    {{-- <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}"> --}}
    @yield('styles')
    <link rel="stylesheet" href="{{ asset('vendors/shed-css/dist/index.css') }}">

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

    <script src="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.min.js"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('vendors/toastjs/toast.js') }}"></script>
{{--    <script src="{{asset('vendors/bootstrap-select-1.13.9/dist/js/bootstrap-select.min.js')}}"></script>--}}
{{--    <script src="{{asset('vendors/bootstrap-select-1.13.9/dist/js/i18n/defaults-id_ID.js')}}"></script>--}}
    <!-- endinject -->

    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/misc.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>


    <!-- endinject -->

    <!-- Custom js for this page-->
    @yield('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var alertType = "{{ Session::get('alert-type') }}";
        var alertMessage = "{{ Session::get('alert-message') }}";
        var alertColor = "";
        var alertIcon = "";
        switch (alertType) {
            case "success" : alertColor = "green"; alertIcon = "mdi mdi-check"; break;
            case "danger" : alertColor = "red"; alertIcon = "mdi mdi-block-helper"; break;
            case "warning" : alertColor = "yellow"; alertIcon = "mdi mdi-alert"; break;
            case "info" : alertColor = "blue"; alertIcon = "mdi mdi-information-variant";
        }
        if(alertType){
            iziToast.show({
                message: alertMessage || "You have notification",
                timeout: 5000,
                theme: 'dark',
                color: alertColor,
                icon: alertIcon,
                transitionIn: 'bounceInUp',
                transitionOut: 'fadeOutLeft'
            });
        }
    </script>
    <!-- End custom js for this page-->
</body>

</html>

