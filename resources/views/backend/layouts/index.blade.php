<!doctype html>
<html lang="en" class="semi-dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset(getSettingValue('favicon')) }}" sizes="64x64">
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


    <link rel="stylesheet" href="{{ asset('backend') }}/assets/plugins/notifications/css/lobibox.min.css" />


    <style>
        td {
            vertical-align: middle;
        }

        .menu-title {
            text-transform: capitalize !important;
        }

        .mr-3 {
            margin-right: .25rem;
        }
    </style>

    @yield('styles')

    <title>{{ getSettingValue('website_title') }} - Backend </title>
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

                @yield('content')

            </div>
            <!-- end page content-->
        </div>
        <!--end page content wrapper-->


        @include('backend.layouts.partials.footer')

    </div>
    <!--end wrapper-->


    @include('notification')

    <!-- JS Files-->
    <script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('backend') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>



    <!-- Main JS-->
    <script src="{{ asset('backend') }}/assets/js/main.js"></script>


    <script>
        const getInvalidFeedback = (error) => {
            return `<div class="invalid-feedback">${error}</div>`;
        }

        const removeInvalidFeedback = (el) => {
            $(el).removeClass('is-invalid');
            $(el).next('.invalid-feedback').remove();
        }

        const formValidation = (btn) => {
            var isValidForm = true;
            const form = $(btn).closest('form');
            // get all  form data-validation
            const validations = form.find('[data-validation]');
            if (validations.length) {
                validations.each(function() {
                    removeInvalidFeedback(this);
                    validationArray = $(this).attr('data-validation').split('|');
                    var message = '';
                    validationArray.forEach(function(item) {
                        if (message == '') {
                            var name = $(this).attr('name');
                            // ucword name
                            name = name.charAt(0).toUpperCase() + name.slice(1);
                            const validation = item.split(':');
                            const validationName = validation[0];

                            switch (validationName) {
                                case 'required':
                                    if ($(this).val() == '') {
                                        $(this).addClass('is-invalid');
                                        message =
                                            `${name} is required.`;
                                    }
                                    break;
                                case 'min':
                                    if ($(this).val().length < validation[1]) {
                                        $(this).addClass('is-invalid');
                                        message =
                                            `${name} must be at least ${validation[1]} characters.`
                                    }
                                    break;
                                case 'max':
                                    if ($(this).val().length > validation[1]) {
                                        $(this).addClass('is-invalid');
                                        message =
                                            `${name} must be at most ${validation[1]} characters.`;
                                    }
                                    break;
                                default:

                                    break;
                            }
                            if (message != '') {
                                isValidForm = false;
                                $(this).after(getInvalidFeedback(message));
                            }
                        }
                    }.bind(this));
                });
            }

            return isValidForm;
        }
        if (window) {
            window.formValidation = formValidation;
        }
    </script>

    @stack('scripts')




</body>

</html>
