@extends('admin.includes.admin_design')

@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
        <div class="d-flex align-items-center justify-content-between">
            <h4 class="font-weight-bold">Yearly Sales Report of {{ $year }}</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="iq-edit-list-data">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th hidden></th>
                                                <th>Month</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($row as $value)
                                                <tr>
                                                    <th hidden></th>
                                                    <td>{{ $value['month'] }}</td>
                                                    <td>{{ $value['quantity'] }}</td>
                                                    <td>{{ $value['amount'] }}</td>
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
