@extends('admin.includes.admin_design')

@section('content')
    <div class="row">
        <div class="col-md-12 mb-4 mt-1">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <h4 class="font-weight-bold">Overview</h4>
                <div class="form-group mb-0 vanila-daterangepicker d-flex flex-row">
                    <div class="date-icon-set">
                        <input type="text" name="start" class="form-control" placeholder="From Date">
                        <span class="search-link">
                            <svg xmlns="http://www.w3.org/2000/svg" class="___class_+?8___" width="20" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </span>
                    </div>
                    <span class="flex-grow-0">
                        <span class="btn">To</span>
                    </span>
                    <div class="date-icon-set">
                        <input type="text" name="end" class="form-control" placeholder="To Date">
                        <span class="search-link">
                            <svg xmlns="http://www.w3.org/2000/svg" class="___class_+?14___" width="20" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="___class_+?47___">
                                    <p class="mb-2 text-secondary">Total {{ $profit > 0 ? 'Profit' : 'Loss' }}</p>
                                    <div class="d-flex flex-wrap justify-content-start align-items-center">
                                        <h5 class="mb-0 font-weight-bold">Rs. {{ $profit }}</h5>
                                        @if($profit > 0)
                                        <p class="mb-0 ml-3 text-success font-weight-bold">
                                            +{{ $sales == null ? '0' : round($profit * 100 / $sales, 2) }}%
                                        </p>
                                        @else
                                        <p class="mb-0 ml-3 text-danger font-weight-bold">
                                            {{ $sales == null ? '0' : round($profit * 100 / $sales, 2) }}%
                                        </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="___class_+?56___">
                                    <p class="mb-2 text-secondary">Total Expenses</p>
                                    <div class="d-flex flex-wrap justify-content-start align-items-center">
                                        <h5 class="mb-0 font-weight-bold">Rs. {{ $expense }}</h5>
                                        <p class="mb-0 ml-3 text-danger font-weight-bold">
                                            {{ $sales == null ? '0' : round($expense * 100 / $sales, 2) }}%
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="___class_+?65___">
                                    <p class="mb-2 text-secondary">Total Sales</p>
                                    <div class="d-flex flex-wrap justify-content-start align-items-center">
                                        <h5 class="mb-0 font-weight-bold">Rs. {{ $sales }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Column Chart</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="apex-columns"></div>
                        </div>
                    </div>
                    {{-- <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <h4 class="font-weight-bold">Sales Report</h4>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><svg width="24" height="24" viewBox="0 0 24 24" fill="primary"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect x="3" y="3" width="18" height="18" rx="2" fill="#3378FF" />
                                        </svg>
                                        <span>Incomes</span>
                                    </div>
                                    <div class="ml-3"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect x="3" y="3" width="18" height="18" rx="2" fill="#19b3b3" />
                                        </svg>
                                        <span>Expenses</span>
                                    </div>
                                </div>
                            </div>
                            <div id="chart-apex-column-01" class="custom-chart"></div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-8">
            <div class="card card-block card-stretch card-height">
                <div class="card-header card-header-border d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Top Selling Product</h4>
                    </div>
                </div>
                <div class="card-body-list">
                    <ul class="list-style-3 mb-0">
                        @foreach ($bestSelling as $value)
                        <li class="p-3 list-item d-flex justify-content-start align-items-center">
                            <div class="avatar">
                                <img class="avatar avatar-img avatar-60 rounded" src="{{ ($value['image']) ? asset('public/uploads/product/' . $value['image']) : asset('public/uploads/no-image.jpg') }}"
                                    alt="1.jpg">
                            </div>
                            <div class="list-style-detail ml-3 mr-2">
                                <p class="mb-0">{{ $value['name'] }}</p>
                            </div>
                            <div class="list-style-action d-flex justify-content-end ml-auto">
                                <h6 class="font-weight-bold">{{ $value['price'] }}</h6>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card bg-primary">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="fit-icon-2 text-info text-center">
                                    <div id="circle-progress-01"
                                        class="circle-progress-01 circle-progress circle-progress-light" data-min-value="0"
                                        data-max-value="100" data-value="62" data-type="percent"></div>
                                </div>
                                <div class="ml-3">
                                    <h5 class="text-white font-weight-bold">1,860 <small> /3k Target</small></h5>
                                    <small class="mb-0">Order In Period</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="font-weight-bold">Active Users</h6>
                                <div class="d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span class=" font-weight-bold">200</span>
                                </div>
                            </div>
                            <p class="mb-0">Pages views per day</p>
                            <div id="chart-apex-column-02" class="custom-chart"></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="mb-0 pt-3 ">25 June</p>
                                <p class="mb-0 pt-3 ">26 June</p>
                                <p class="mb-0 pt-3 ">27 June</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card card-block card-stretch card-height">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Upcoming Events</h4>
                    </div>
                    <div class="card-header-toolbar d-flex align-items-center">
                        <div class="dropdown">
                            <a href="index.html#" class="text-muted pl-3" id="dropdownMenuButton-event"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" stroke="currentColor" stroke-width="2"
                                    aria-hidden="true" focusable="false"
                                    style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"
                                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                    <g fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="1" />
                                        <circle cx="19" cy="12" r="1" />
                                        <circle cx="5" cy="12" r="1" />
                                    </g>
                                </svg>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-event">
                                <a class="dropdown-item" href="index.html#">
                                    <svg class="svg-icon text-secondary" width="20" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>
                                <a class="dropdown-item" href="index.html#">
                                    <svg class="svg-icon text-secondary" width="20" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    View
                                </a>
                                <a class="dropdown-item" href="index.html#">
                                    <svg class="svg-icon text-secondary" width="20" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-spacing mb-0">
                            <tbody>
                                <tr class="white-space-no-wrap">
                                    <td>
                                        <h6 class="mb-0 text-uppercase text-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="pr-2" width="30"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            30 Jun, Tue
                                        </h6>
                                    </td>
                                    <td class="pl-0 py-3">
                                        Big Billion Day Sale
                                    </td>
                                </tr>
                                <tr class="white-space-no-wrap">
                                    <td>
                                        <h6 class="mb-0 text-uppercase text-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="pr-2" width="30"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            09 July, Mon
                                        </h6>
                                    </td>
                                    <td class="pl-0 py-3">
                                        5% Off on Mobile
                                    </td>
                                </tr>
                                <tr class="white-space-no-wrap">
                                    <td>
                                        <h6 class="mb-0 text-uppercase text-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="pr-2" width="30"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            15 Aug, Sun
                                        </h6>
                                    </td>
                                    <td class="pl-0 py-3">
                                        Electronics Sale
                                    </td>
                                </tr>
                                <tr class="white-space-no-wrap">
                                    <td>
                                        <h6 class="mb-0 text-uppercase text-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="pr-2" width="30"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            26 Oct, Thu
                                        </h6>
                                    </td>
                                    <td class="pl-0 py-3">
                                        Fashionable Sale
                                    </td>
                                </tr>
                                <tr class="white-space-no-wrap">
                                    <td>
                                        <h6 class="mb-0 text-uppercase text-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="pr-2" width="30"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            25 Dec, Fri
                                        </h6>
                                    </td>
                                    <td class="pl-0 py-3">
                                        5% Off on Cloths
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="d-flex justify-content-end align-items-center border-top-table p-3">
                        <button class="btn btn-secondary btn-sm">See All</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="font-weight-bold mb-3">Popular Categories</h4>
                    <div id="chart-apex-column-03" class="custom-chart"></div>
                    <div class="d-flex justify-content-around align-items-center">
                        <div><svg width="24" height="24" viewBox="0 0 24 24" fill="#ffbb33"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="3" y="3" width="18" height="18" rx="2" fill="#ffbb33" />
                            </svg>

                            <span>Mobile</span>
                        </div>
                        <div>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="#e60000"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="3" y="3" width="18" height="18" rx="2" fill="#e60000" />
                            </svg>

                            <span>Laptop</span>
                        </div>
                    </div>
                    <div class="d-flex justify-content-around align-items-center mt-3">
                        <div>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="primary"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="3" y="3" width="18" height="18" rx="2" fill="#04237D" />
                            </svg>

                            <span>Electronics</span>
                        </div>
                        <div>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="primary"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="3" y="3" width="18" height="18" rx="2" fill="#8080ff" />
                            </svg>

                            <span>Others</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">New Customer</h4>
                    </div>
                    <div class="card-header-toolbar d-flex align-items-center">
                        <div class="dropdown">
                            <a href="index.html#" class="text-muted pl-3" id="dropdownMenuButton-customer"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" stroke="currentColor" stroke-width="2"
                                    aria-hidden="true" focusable="false"
                                    style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"
                                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                    <g fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="1" />
                                        <circle cx="19" cy="12" r="1" />
                                        <circle cx="5" cy="12" r="1" />
                                    </g>
                                </svg>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-customer">
                                <a class="dropdown-item" href="index.html#">
                                    <svg class="svg-icon text-secondary" width="20" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>
                                <a class="dropdown-item" href="index.html#">
                                    <svg class="svg-icon text-secondary" width="20" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    View
                                </a>
                                <a class="dropdown-item" href="index.html#">
                                    <svg class="svg-icon text-secondary" width="20" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-color-heading">
                                <tr class="text-secondary">
                                    <th scope="col">Date</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="white-space-no-wrap">
                                    <td>01 Jun 2020</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-45 mr-2">
                                                <img src="../assets/images/user/2.jpg" class="img-fluid rounded-circle"
                                                    alt="image">
                                            </div>
                                            <div>Maggie Potts</div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-success d-flex justify-content-start align-items-center">
                                            <small><svg class="mr-2" xmlns="http://www.w3.org/2000/svg"
                                                    width="18" viewBox="0 0 24 24" fill="none">
                                                    <circle cx="12" cy="12" r="8" fill="#3cb72c"></circle>
                                                </svg>
                                            </small> Completed
                                        </p>
                                    </td>
                                    <td class="text-right">$104.98</td>
                                </tr>
                                <tr class="white-space-no-wrap">
                                    <td>02 Jun 2020</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-45 mr-2">
                                                <img src="../assets/images/user/5.jpg" class="img-fluid rounded-circle"
                                                    alt="image">
                                            </div>
                                            <div>Kevin Adkins</div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-success d-flex justify-content-start align-items-center">
                                            <small><svg class="mr-2" xmlns="http://www.w3.org/2000/svg"
                                                    width="18" viewBox="0 0 24 24" fill="none">
                                                    <circle cx="12" cy="12" r="8" fill="#3cb72c"></circle>
                                                </svg>
                                            </small> Completed
                                        </p>
                                    </td>
                                    <td class="text-right">$233.00</td>
                                </tr>
                                <tr class="white-space-no-wrap">
                                    <td>05 Jun 2020</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-45 mr-2">
                                                <img src="../assets/images/user/1.jpg" class="img-fluid rounded-circle"
                                                    alt="image">
                                            </div>
                                            <div>Max Lynn</div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-warning d-flex justify-content-start align-items-center">
                                            <small><svg class="mr-2" xmlns="http://www.w3.org/2000/svg"
                                                    width="18" viewBox="0 0 24 24" fill="none">
                                                    <circle cx="12" cy="12" r="8" fill="#db7e06"></circle>
                                                </svg>
                                            </small>Pending
                                        </p>
                                    </td>
                                    <td class="text-right">$150.01</td>
                                </tr>
                                <tr class="white-space-no-wrap">
                                    <td>06 Jun 2020</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-45 mr-2">
                                                <img src="../assets/images/user/3.jpg" class="img-fluid rounded-circle"
                                                    alt="image">
                                            </div>
                                            <div>Danniw Yatt</div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 text-danger d-flex justify-content-start align-items-center">
                                            <small><svg class="mr-2" xmlns="http://www.w3.org/2000/svg"
                                                    width="18" viewBox="0 0 24 24" fill="none">
                                                    <circle cx="12" cy="12" r="8" fill="#F42B3D"></circle>
                                                </svg>
                                            </small>Cancelled
                                        </p>
                                    </td>
                                    <td class="text-right">$199.99</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end align-items-center border-top-table p-3">
                            <button class="btn btn-secondary btn-sm">See All</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="font-weight-bold mb-3">City Orders Statistics</h4>
                    <div id="chart-map-column-04" class="custom-chart"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
@endsection

@section('js')
 <script>
    var a = '{{ json_encode($sixMonth) }}';
    a = a.replaceAll('&quot;', '').slice(1, -1);
    a = a.split(',');

    (function(jQuery) {
        "use strict";
        // for apexchart
        function apexChartUpdate(chart, detail) {
            let color = getComputedStyle(document.documentElement).getPropertyValue('--dark');
            if (detail.dark) {
                color = getComputedStyle(document.documentElement).getPropertyValue('--white');
            }
            chart.updateOptions({
                chart: {
                    foreColor: color
                }
            })
        }
        if (jQuery("#apex-columns").length) {
            var options = {
                chart: {
                    height: 350,
                    type: "bar"
                },
                plotOptions: {
                    bar: {
                        horizontal: !1,
                        columnWidth: "55%",
                        endingShape: "rounded"
                    }
                },
                dataLabels: {
                    enabled: !1
                },
                stroke: {
                    show: !0,
                    width: 2,
                    colors: ["transparent"]
                },
                colors: ["#37e6b0", "#ff4b4b"],
                series: [{
                    name: "Sales",
                    data: {{ json_encode($monthlySales) }}
                }, {
                    name: "Expense",
                    data: {{ json_encode($monthlyExpense) }}
                }],
                xaxis: {
                    categories: a
                },
                // yaxis: {
                //     title: {
                //         text: "Rupee"
                //     }
                // },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(e) {
                            return 'Rs. ' + e
                        }
                    }
                }
            };
            var chart = new ApexCharts(document.querySelector("#apex-columns"), options);
            chart.render();
            const body = document.querySelector('body')
            if (body.classList.contains('dark')) {
                apexChartUpdate(chart, {
                    dark: true
                })
            }
            document.addEventListener('ChangeColorMode', function(e) {
                apexChartUpdate(chart, e.detail)
            })
        }
    })(jQuery);
 </script>
@endsection
