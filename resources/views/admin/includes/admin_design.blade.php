@php
$details = \App\Models\Details::where('id', '=', 1)->first();
@endphp

<!doctype html>
<html lang="en">
@include('admin.includes.head')

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
        @include('admin.includes.sidebar')
        @include('admin.includes.navbar')
        <div class="content-page">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- Wrapper End-->
    @include('admin.includes.footer')
