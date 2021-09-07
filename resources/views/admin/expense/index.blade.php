@extends('admin.includes.admin_design')

@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
        <div class="d-flex align-items-center justify-content-between">
            <h4 class="font-weight-bold">Customer Details</h4>
        </div>
        <div class="create-workform">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="modal-product-search d-flex">
                    <a href="{{ route('expense.create') }}" type="button" id='add'
                        class="btn btn-primary position-relative d-flex align-items-center justify-content-between">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add New
                    </a>
                </div>
            </div>
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
                                                <th>Date</th>
                                                <th>Reference Number</th>
                                                <th>Warehouse</th>
                                                <th>Category</th>
                                                <th>Amount</th>
                                                <th>Note</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($expense as $val)
                                                <tr>
                                                    <td>{{ $val->created_at }}</td>
                                                    <td>{{ $val->reference_number }}</td>
                                                    <td>{{ $val->warehouse_id }}</td>
                                                    <td>{{ $val->category_id }}</td>
                                                    <td>{{ $val->amount }}</td>
                                                    <td>Note</td>
                                                    <td>
                                                        <a class="btn btn-secondary mr-2"
                                                            href="{{ route('expense.show', [$val->id]) }}">Show</a>
                                                        <a class="btn btn-primary mr-2"
                                                            href="{{ route('expense.edit', [$val->id]) }}"
                                                            id="edit">Edit</a>
                                                        <form action="{{ route('expense.destroy', [$val->id]) }}"
                                                            method="POST">
                                                            @csrf

                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger mr-2">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                No data in table
                                            @endforelse
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
                buttons: [{
                        extend: 'pdf',
                        className: 'btn btn-outline-danger',
                        text: 'pdf',
                        exportOptions: {
                            columns: 'th:not(:last-child)',
                        }
                    },
                    {
                        extend: 'excel',
                        className: 'btn btn-outline-success',
                        text: 'excel',
                        exportOptions: {
                            columns: 'th:not(:last-child)',
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-outline-secondary',
                        text: 'print',
                        exportOptions: {
                            columns: 'th:not(:last-child)',
                        }
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
