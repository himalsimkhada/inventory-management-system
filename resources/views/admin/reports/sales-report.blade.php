@extends('admin.includes.admin_design') @section('content') <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
    <div class="d-flex align-items-center justify-content-between">
        <h4 class="font-weight-bold">Yearly Sales Report</h4>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="iq-edit-list-data">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Bar Chart</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="apex-bars"></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th hidden></th>
                                            <th>Month</th>
                                            <th>Quantity</th>
                                            <th>Tax</th>
                                            <th>Discount</th>
                                            <th>Remaining</th>
                                            <th>Grand Total</th>
                                        </tr>
                                    </thead>
                                    <tbody> @foreach ($row as $value) <tr>
                                            <th hidden></th>
                                            <td>{{ $value['month'] }}</td>
                                            <td>{{ $value['quantity'] }}</td>
                                            <td>{{ $value['tax'] }}</td>
                                            <td>{{ $value['discount'] }}</td>
                                            <td>{{ $value['remaining'] }}</td>
                                            <td>{{ $value['total'] }}</td>
                                        </tr> @endforeach </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> @endsection @section('js') <script>
    $(document).ready(function() {
        var table = $('#datatable').DataTable({
            dom: 'Bfrtipl',
            buttons: [{
                extend: 'pdf',
                className: 'btn btn-outline-danger',
                text: 'pdf',
                exportOptions: {
                    columns: 'th:not(:last-child)',
                }
            }, {
                extend: 'excel',
                className: 'btn btn-outline-success',
                text: 'excel',
                exportOptions: {
                    columns: 'th:not(:last-child)',
                }
            }, {
                extend: 'print',
                className: 'btn btn-outline-secondary',
                text: 'print',
                exportOptions: {
                    columns: 'th:not(:last-child)',
                }
            }, ],
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
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
        // for am chart
        function amChartUpdate(chart, detail) {
            // let color = getComputedStyle(document.documentElement).getPropertyValue('--dark');
            if (detail.dark) {
                // color = getComputedStyle(document.documentElement).getPropertyValue('--white');
                chart.stroke = am4core.color(getComputedStyle(document.documentElement).getPropertyValue('--white'));
            }
            chart.validateData();
        }
        /*---------------------------------------------------------------------
        Apex Charts
        -----------------------------------------------------------------------*/
        if (jQuery("#apex-bars").length) {
            options = {
                chart: {
                    height: 350,
                    type: "bar"
                },
                plotOptions: {
                    bar: {
                        horizontal: !0
                    }
                },
                dataLabels: {
                    enabled: !1
                },
                colors: ["#4788ff"],
                series: [{
                    data: {{ json_encode($data) }}
                }],
                xaxis: {
                    categories: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]
                }
            };
            (chart = new ApexCharts(document.querySelector("#apex-bars"), options)).render()
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
        
        if (jQuery("#layout-1-chart-01").length) {
            var options = {
                series: [70, 30],
                chart: {
                    height: 300,
                    type: 'radialBar',
                },
                plotOptions: {
                    radialBar: {
                        dataLabels: {
                            name: {
                                fontSize: '22px',
                            },
                            value: {
                                fontSize: '16px',
                            },
                            total: {
                                show: true,
                                label: 'Total',
                                formatter: function(w) {
                                    return 249
                                }
                            }
                        },
                        track: {
                            strokeWidth: '42%',
                        },
                    }
                },
                colors: ['#05bbc9', '#876cfe'],
                stroke: {
                    lineCap: "round",
                },
            };
            var chart = new ApexCharts(document.querySelector("#layout-1-chart-01"), options);
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
</script> @endsection