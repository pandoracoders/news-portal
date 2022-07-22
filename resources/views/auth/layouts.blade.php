<!doctype html>
<html lang="en" class="light-theme">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- loader-->
    <link href="{{ asset('') }}backend/assets/css/pace.min.css" rel="stylesheet" />
    <script src="{{ asset('') }}backend/assets/js/pace.min.js"></script>

    <!--plugins-->
    <link href="{{ asset('') }}backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />

    <!-- CSS Files -->
    <link href="{{ asset('') }}backend/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('') }}backend/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="{{ asset('') }}backend/assets/css/style.css" rel="stylesheet">
    <link href="{{ asset('') }}backend/assets/css/icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <title>Blackdash - Bootstrap5 Admin Template</title>
</head>

<body class="bg-white">

    <!--start wrapper-->
    <div class="wrapper">
        <div class="">
            <div class="row g-0 m-0">
                <div class="col-xl-6 col-lg-12">
                    <div class="login-cover-wrapper">
                        <div class="card shadow-none">
                            <div class="card-body">
                                <div class="text-center">
                                    <h4>Sign In</h4>
                                    <p>Sign In to your account</p>

                                </div>
                                <form class="form-body row g-3" method="POST" action="{{ route('post-login') }}">
                                    @csrf
                                    <div class="col-12">
                                        <label for="inputEmail" class="form-label">Email</label>
                                        <input type="email"
                                            class="form-control {{ isset($errors) && $errors->has('email') ? 'is-invalid' : '' }}"
                                            id="inputEmail" name="email">
                                        @if (isset($errors) && $errors->has('email'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <label for="inputPassword" class="form-label">Password</label>
                                        <input type="password"
                                            class="form-control  {{ isset($errors) && $errors->has('password') ? 'is-invalid' : '' }}"
                                            id="inputPassword" name="password">

                                        @if (isset($errors) && $errors->has('password'))
                                            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                                {{ $errors->first('password') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckRemember" name="remember" value="true">
                                            <label class="form-check-label" for="flexSwitchCheckRemember">Remember
                                                Me</label>
                                            @if (isset($errors) && $errors->has('password'))
                                                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                                                    {{ $errors->first('password') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-dark">Sign In</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12">
                    <div class="position-fixed top-0 h-100 d-xl-block d-none login-cover-img">
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
    <!--end wrapper-->

</body>

</html>
