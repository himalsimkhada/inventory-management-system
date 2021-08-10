@extends('admin.includes.admin_design')

@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
        <div class="d-flex align-items-center justify-content-between">
            <h4 class="font-weight-bold">Unit</h4>
        </div>
        <div class="create-workform">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="modal-product-search d-flex">
                    <button type="button" id='add'
                        class="btn btn-primary position-relative d-flex align-items-center justify-content-between"
                        data-toggle="modal" data-target="#unitModal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add New
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="unitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add/Edit Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @include('admin.includes._message')
                <form method="post">
                    <div class="modal-body">
                        <div id="errors"></div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id" id="id">
                        </div>
                        <div class="form-group">
                            <label for="name" class="form-label">Unit Name</label>
                            <input type="text" class="form-control" name="name" id="name">
                        </div>
                        <div class="form-group">
                            <label for="short_name" class="form-label">Unit Short Name</label>
                            <input type="text" class="form-control" name="short_name" id="short_name">
                        </div>
                        <div class="form-group">
                            <label for="base_unit" class="form-label">Base Unit</label>
                            <select class="form-control" name="base_unit" id="base_unit">
                                <option value="0" selected>None</option>
                                @foreach ($base_units as $unit)
                                    <option value="{{ $unit['id'] }}">{{ $unit['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="hidden-val" hidden>
                            <div class="form-group">
                                <label for="operator" class="form-label">Operator</label>
                                <div class="input-group">
                                    <select class="form-control" id="operator" name="operator">
                                        <option readonly value="">Choose...</option>
                                        <option value="*">Multiply</option>
                                        <option value="/">Divide</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="operation_value" class="form-label">Operation Value</label>
                                <input type="text" class="form-control" name="operation_value" id="operation_value">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
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
                                                <th>S. No.</th>
                                                <th>Name</th>
                                                <th>Short Name</th>
                                                <th>Base Unit</th>
                                                <th>Operator</th>
                                                <th>Operation Value</th>
                                                <th></th>
                                            </tr>
                                        </thead>
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
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('unit.get') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'short_name',
                        name: 'short_name'
                    },
                    {
                        data: 'base_unit',
                        name: 'base_unit'
                    },
                    {
                        data: 'operator',
                        name: 'operator'
                    },
                    {
                        data: 'operation_value',
                        name: 'operation_value'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ],
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('form').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    method: "post",
                    url: "{{ route('unit.store') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response == true) {
                            $('#unitModal').modal('hide');
                            $('#datatable').DataTable().ajax.reload();
                        }
                    },
                    error: function(response) {
                        var error = '<div class="alert alert-danger"><ul>';
                        $.each(response.responseJSON.errors, function(key, value){
                            error += '<li style="list-style-type: none">' + value + '</li>'
                        })
                        error += '</ul></div>'
                        $('#errors').html(error);
                    }
                })
            });

            $(document).on('click', '#edit', function() {
                var id = $(this).data('id');
                $.ajax({
                    method: "post",
                    url: "{{ route('unit.get') }}",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response) {
                            $('#id').val(response.id);
                            $('#name').val(response.name);
                            $('#short_name').val(response.short_name);
                            $('#base_unit').val(response.base_unit);
                            if (response.base_unit == '0') {
                                $('#hidden-val').prop('hidden', true);
                            } else {
                                $('#hidden-val').prop('hidden', false);
                            }
                            $('#operator').val(response.operator);
                            $('#operation_value').val(response.operation_value);
                        }
                    },
                    error: function(response) {
                        console.log('error');
                    }
                })
            });

            $(document).on('click', '#delete', function() {
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            method: "post",
                            url: "{{ route('unit.destroy') }}",
                            data: {
                                id: id
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response == 1) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your data has been deleted.',
                                        'success'
                                    )
                                    $('#datatable').DataTable().ajax.reload();
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'There has been error deleting the data.',
                                        'failed'
                                    )
                                }
                            },
                            error: function(response) {
                                console.log('error');
                            }

                        })
                    }
                })

            })

            $('#add').on('click', function() {
                $('#id').val('');
                $('#name').val('');
                $('#short_name').val('');
                $('#base_unit').val('0');
                $('#hidden-val').prop('hidden', true);
                $('#operator').val('');
                $('#operation_value').val('');
                $('#hidden-val').prop('hidden', true);
                $('#errors').html('');
            });

            $('#base_unit').on('change', function() {
                if ($(this).val() == "0") {
                    $('#hidden-val').prop('hidden', true);
                    $('#operator').val('');
                    $('#operator_value').val('');
                } else {
                    $('#hidden-val').prop('hidden', false);
                    $('#operator').val('');
                    $('#operation_value').val('');
                }
            })
        })
    </script>
@endsection
