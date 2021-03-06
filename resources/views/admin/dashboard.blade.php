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
                                        @if ($profit > 0)
                                            <p class="mb-0 ml-3 text-success font-weight-bold">
                                                +{{ $sales == null ? '0' : round(($profit * 100) / $sales, 2) }}%
                                            </p>
                                        @else
                                            <p class="mb-0 ml-3 text-danger font-weight-bold">
                                                {{ $sales == null ? '0' : round(($profit * 100) / $sales, 2) }}%
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
                                            -{{ $sales == null ? '0' : round(($expense * 100) / $sales, 2) }}%
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
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <h4 class="font-weight-bold">Sales Report</h4>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div><svg width="24" height="24" viewBox="0 0 24 24" fill="primary"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect x="3" y="3" width="18" height="18" rx="2" fill="#37e6b0"" />
                                                                            </svg>
                                                                            <span>Sales</span>
                                                                        </div>
                                                                        <div class="         ml-3"><svg width="24"
                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="3" y="3" width="18" height="18" rx="2" fill="#ff4b4b" />
                                                </svg>
                                                <span>Expense</span>
                                    </div>
                                </div>
                            </div>
                            <div id="apex-columns"></div>
                        </div>
                    </div>
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
                                    <img class="avatar avatar-img avatar-60 rounded"
                                        src="{{ $value['image'] ? asset('public/uploads/product/' . $value['image']['image']) : asset('public/uploads/no-image.jpg') }}"
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
                                @foreach ($newCustomer as $data)
                                    <tr class="white-space-no-wrap">
                                        <td>{{ $data->created_at }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>{{ $data->firstname . ' ' . $data->lastname }}</div>
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
                                        <td class="text-right">{{ $data->phone_number }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end align-items-center border-top-table p-3">
                            <button class="btn btn-secondary btn-sm">See All</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="font-weight-bold mb-3">Popular Categories</h4>
                    <div id="chart-apex-column-03s" class="custom-chart"></div>
                    @foreach ($popularCategories as $value)
                    <div class="d-flex justify-content-around align-items-center">
                        <div><svg width="24" height="24" viewBox="0 0 24 24" fill="{{ $value['color'] }}"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="3" y="3" width="18" height="18" rx="2" fill="{{ $value['color'] }}" />
                            </svg>

                            <span>{{ $value['name'] }}</span>
                        </div>
                    </div>
                    @endforeach
                    <div class="d-flex justify-content-around align-items-center mt-3">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page end  -->
@endsection

@section('js')
<script>
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

        var sixMonth = '{{ json_encode($sixMonth) }}';
        sixMonth = sixMonth.replaceAll('&quot;', '').slice(1, -1);
        sixMonth = sixMonth.split(',');
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
                    categories: sixMonth
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

        var categoriesName = '{{ json_encode($categoriesName) }}';
        categoriesName = categoriesName.replaceAll('&quot;', '').slice(1, -1);
        categoriesName = categoriesName.split(',');

        var categoriesQty = '{{ json_encode($categoriesQty) }}';
        categoriesQty = categoriesQty.replaceAll('&quot;', '').slice(1, -1);
        categoriesQty = categoriesQty.split(',');

        var categoriesColor = '{{ json_encode($categoriesColor) }}';
        categoriesColor = categoriesColor.replaceAll('&quot;', '').slice(1, -1);
        categoriesColor = categoriesColor.split(',');

        console.log(categoriesName);
        console.log(categoriesQty);
        console.log(categoriesColor);

        if (jQuery("#chart-apex-column-03s").length) {
            var options = {
                series: categoriesQty,
                chart: {
                    height: 330,
                    type: 'donut',
                },
                labels: categoriesName,
                colors: categoriesColor,
                plotOptions: {
                    pie: {
                        startAngle: -90,
                        endAngle: 270,
                        donut: {
                            size: '80%',
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    color: '#BCC1C8',
                                    fontSize: '18px',
                                    fontFamily: 'DM Sans',
                                    fontWeight: 600,
                                },
                                value: {
                                    show: true,
                                    fontSize: '25px',
                                    fontFamily: 'DM Sans',
                                    fontWeight: 700,
                                    color: '#8F9FBC',
                                },
                            }
                        }
                    }
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    lineCap: 'round'
                },
                grid: {
                    padding: {
                        bottom: 0,
                    }
                },
                legend: {
                    position: 'bottom',
                    offsetY: 8,
                    show: true,
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: 268
                        }
                    }
                }]
            };
            var chart = new ApexCharts(document.querySelector("#chart-apex-column-03s"), options);
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
