<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Datum | CRM Admin Dashboard Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('public/backend/assets/images/favicon.ico.png') }} " />

    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/backend-plugin.min.css' ) }} ">
    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/backend-v=1.0.0.css' ) }} ">
</head>
<body class=" ">
<!-- loader Start -->
<div id="loading">
    <div id="loading-center">
    </div>
</div>
<!-- loader END -->

<div class="wrapper">
    <section class="login-content">
        <div class="container h-100">
            <div class="row align-items-center justify-content-center h-100">
                <div class="col-md-5">
                    <div class="card p-5">
                        <div class="card-body">
                            <div class="auth-logo">
                                <img src="{{ asset('public/backend/assets/images/logo.png') }}" class="img-fluid  rounded-normal  darkmode-logo" alt="logo">
                                <img src="{{ asset('public/backend/assets/images/logo-dark.png') }}" class="img-fluid rounded-normal light-logo" alt="logo">
                            </div>
                            <h3 class="mb-3 text-center">Reset Password</h3>
                            <p class="text-center small text-secondary mb-3">You can reset your password here</p>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li style="list-style: none;">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if(Session::get('info_message'))
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <ul style="margin-bottom: -10px;">
                                        <li style="list-style: none; width: 800px;">
                                            <p> {{ Session::get('info_message') }}</p>
                                        </li>
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if(Session::get('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <ul style="margin-bottom: -10px;">
                                        <li style="list-style: none; width: 800px;">
                                            <p> {{ Session::get('error_message') }}</p>
                                        </li>
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form method="post" action="{{ route('forgetPassword') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label id="email" class="text-secondary">Email</label>
                                            <input class="form-control" type="email" name="email" id="email" placeholder="Enter Email">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Backend Bundle JavaScript -->
<script src="{{ asset('public/backend/assets/js/backend-bundle.min.js') }} "></script>
<!-- Chart Custom JavaScript -->
<script src="{{ asset('public/backend/assets/js/customizer.js') }} "></script>

<script src="{{ asset('public/backend/assets/js/sidebar.js') }} "></script>

<!-- Flextree Javascript-->
<script src="{{ asset('public/backend/assets/js/flex-tree.min.js') }} "></script>
<script src="{{ asset('public/backend/assets/js/tree.js') }} "></script>

<!-- Table Treeview JavaScript -->
<script src="{{ asset('public/backend/assets/js/table-treeview.js') }} "></script>

<!-- SweetAlert JavaScript -->
<script src="{{ asset('public/backend/assets/js/sweetalert.js') }} "></script>

<!-- Vectoe Map JavaScript -->
<script src="{{ asset('public/backend/assets/js/vector-map-custom.js') }} "></script>

<!-- Chart Custom JavaScript -->
<script src="{{ asset('public/backend/assets/js/chart-custom.js') }} "></script>
<script src="{{ asset('public/backend/assets/js/charts/01.js') }} "></script>
<script src="{{ asset('public/backend/assets/js/charts/02.js') }} "></script>

<!-- slider JavaScript -->
<script src="{{ asset('public/backend/assets/js/slider.js') }} "></script>




<!-- app JavaScript -->
<script src="{{ asset('public/backend//assets/js/app.js') }} "></script>  </body>
</html>
