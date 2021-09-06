<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $details->name}} | {{ Session::get('admin_page') ? Session::get('admin_page') : '' }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('public/backend/assets/images/'.$details->fav_icon) }}" />

    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/backend-plugin.min.css' ) }} ">
    <link rel="stylesheet" href="{{ asset('public/backend//assets/css/backend-v=1.0.0.css' ) }} ">

    <!-- dropzone -->
    <link rel="stylesheet" href="{{ asset('public/css/dropzone.css') }}">

    {{-- <!-- datatable button  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css"> --}}

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
