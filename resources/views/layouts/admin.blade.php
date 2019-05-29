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
    <!-- endinject -->

    <!-- plugin css for this page -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplebar@latest/dist/simplebar.css">
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('vendors/js/vendor.bundle.addons.js') }}"></script>
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/toastjs/toast.min.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}"/>
    {{-- <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}"> --}}
    @yield('styles')
</head>

<body>
    <div class="position-absolute w-100 d-flex flex-column p-4">
        <div class="toast ml-auto show" role="alert">
            <div class="toast-header">
                Header content...
                <button type="button" class="close" data-dismiss="toast">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                Body content...
            </div>
        </div>
    </div>
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
        alertType = "success";
        switch (alertType) {
            case "success" : alertColor = "green"; alertIcon = "mdi mdi-check"; break;
            case "danger" : alertColor = "red"; alertIcon = "mdi mdi-block-helper"; break;
            case "warning" : alertColor = "yellow"; alertIcon = "mdi mdi-alert"; break;
            case "info" : alertColor = "blue"; alertIcon = "mdi mdi-information-variant";
        }
        iziToast.show({
            message: alertMessage || "lorem ipsu lordor man izac tasha",
            timeout: 3000,
            theme: 'dark',
            color: alertColor,
            icon: alertIcon,
            transitionIn: 'bounceInUp',
            transitionOut: 'fadeOutLeft'
        });
    </script>
    <!-- End custom js for this page-->
</body>

</html>

