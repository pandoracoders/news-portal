<!doctype html>
<html lang="en" class="semi-dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- loader-->
    <link href="{{ asset('backend') }}/assets/css/pace.min.css" rel="stylesheet" />
    <script src="{{ asset('backend') }}/assets/js/pace.min.js"></script>


    @stack('styles')

    <!-- CSS Files -->
    <link href="{{ asset('backend') }}/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/assets/css/style.css" rel="stylesheet">
    <link href="{{ asset('backend') }}/assets/css/icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!--Theme Styles-->
    <link href="{{ asset('backend') }}/assets/css/dark-theme.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/css/semi-dark.css" rel="stylesheet" />
    <link href="{{ asset('backend') }}/assets/css/header-colors.css" rel="stylesheet" />

    <style>
        td {
            vertical-align: middle;
        }
    </style>

    <title>Blackdash - Bootstrap5 Admin Template</title>
</head>

<body>


    <!--start wrapper-->
    <div class="wrapper">

        <!--start sidebar -->
        @include('backend.layouts.partials.sidebar')
        <!--end sidebar -->

        <!--start top header-->
        @include('backend.layouts.partials.header')
        <!--end top header-->


        <!-- start page content wrapper-->
        <div class="page-content-wrapper">
            <!-- start page content-->
            <div class="page-content">
                @include('backend.layouts.partials.breadcrumb')
                @yield('content')

            </div>
            <!-- end page content-->
        </div>
        <!--end page content wrapper-->


        @include('backend.layouts.partials.footer')

    </div>
    <!--end wrapper-->


    <!-- JS Files-->
    <script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>



    <!-- Main JS-->
    <script src="{{ asset('backend') }}/assets/js/main.js"></script>

    @stack('scripts')


</body>

</html>
