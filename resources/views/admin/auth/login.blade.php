<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>IMS | Login</title>

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
                    <div class="card">
                        <div class="card-body">
                            <div class="auth-logo">
                                <img src="{{ asset('public/backend/assets/images/logo.png') }}" class="img-fluid rounded-normal" alt="logo">
                            </div>
                            <h2 class="mb-2 text-center">Sign In</h2>
                            <p class="text-center">To Keep connected with us please login with your personal info.</p>

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


                            <form method="post" action="{{ route('adminLogin') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input class="form-control" type="email" name="email" id="email">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input class="form-control" type="password" id="password" name="password">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Remember Me</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-between align-items-center text-right">
                                    <button type="submit" class="btn btn-primary">Sign In</button>
                                </div>
                            </form>

                            <br>
                            <div class="text-center">
                                <span>Forget Your Password <a href="{{ route('forgetPassword') }}" class="text-primary">Reset Here</a></span>
                            </div>

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
