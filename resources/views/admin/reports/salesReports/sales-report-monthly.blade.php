@extends('admin.includes.admin_design')

@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
        <div class="d-flex align-items-center justify-content-between">
            <h4 class="font-weight-bold">Monthly Sales Report of
                {{ DateTime::createFromFormat('!m', $month)->format('F') }}, {{ $year }}</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="iq-edit-list-data">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Day</th>
                                                <th>Quantity</th>
                                                <th>Tax</th>
                                                <th>Discount</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($row as $value)
                                                <tr>
                                                    <td>{{ $value['day'] }}</td>
                                                    <td>{{ $value['quantity'] }}</td>
                                                    <td>{{ $value['tax'] }}</td>
                                                    <td>{{ $value['discount'] }}</td>
                                                    <td> {{ $value['total'] }}</td>
                                                    @php
                                                        $total = $total + (int) $value['total'];
                                                    @endphp

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="iq-edit-list-data">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('report.sale.monthly') }}" method="get">
                                    <button type="button" class="btn btn-block btn-success mb-2">Print Report</button>
                                    <div class="form-group">
                                        <select name="month" id="month" class="form-control mb-2">
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                        <button type="submit" class="btn btn-block btn-info">Show Report</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            var table = $('#datatable').DataTable({
                dom: 'Bfrtipl',
                pageLength: 12,
                buttons: [{
                        extend: 'pdf',
                        className: 'btn btn-outline-danger',
                        text: 'pdf',
                    },
                    {
                        extend: 'excel',
                        className: 'btn btn-outline-success',
                        text: 'excel',
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-outline-secondary',
                        text: 'print',
                    },
                ],
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
@endsection
