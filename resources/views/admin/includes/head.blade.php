@php
    $details = \App\Models\Details::where('id', '=', 1)->first();
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $details->name}} | Admin Dashboard</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('public/backend/assets/images/'.$details->fav_icon) }}" />

    <link rel="stylesheet" href="{{ asset('public/backend/assets/css/backend-plugin.min.css' ) }} ">
    <link rel="stylesheet" href="{{ asset('public/backend//assets/css/backend-v=1.0.0.css' ) }} ">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
