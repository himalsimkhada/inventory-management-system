@extends('admin.includes.admin_design')

@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
        <div class="d-flex align-items-center justify-content-between">
            <h4 class="font-weight-bold">Yearly Expense Report of {{ $year }}</h4>
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
                                                <th>Month</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach ($row as $value)
                                                <tr>
                                                    <td>{{ $value['month'] }}</td>
                                                    <td>{{ $value['quantity'] }}</td>
                                                    <td>{{ $value['amount'] }}</td>
                                                    @php
                                                        $total = $total + (int) $value['amount'];
                                                    @endphp
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Total</th>
                                                <th></th>
                                                <th>{{ $total }}</th>
                                            </tr>
                                        </tfoot>
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
                                <form action="{{ route('report.sale.yearly') }}" method="get">
                                    <button type="button" class="btn btn-block btn-success mb-2">Print Report</button>
                                    <div class="form-group">
                                        <select name="year" id="year" class="form-control mb-2">
                                            <option value="2021">2021</option>
                                            <option value="2020">2020</option>
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
