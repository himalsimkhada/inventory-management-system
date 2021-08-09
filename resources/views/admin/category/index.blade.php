@extends('admin.includes.admin_design')

@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
        <div class="d-flex align-items-center justify-content-between">
            <h4 class="font-weight-bold">Category</h4>
        </div>
        <div class="create-workform">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="modal-product-search d-flex">
                    <button type="button" id='add'
                        class="btn btn-primary position-relative d-flex align-items-center justify-content-between"
                        data-toggle="modal" data-target="#editModal">
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

    <div class="row">
        <div class="col-lg-12">
            <div class="iq-edit-list-data">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Category</h4>
                                </div>
                            </div>

                            @include('admin.includes._message')

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Name</th>
                                                <th>Code</th>
                                                <th>Status</th>
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

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add/Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="id" id="id" aria-describedby="helpId"
                                placeholder="" hidden>
                        </div>
                        <div class="mb-3">
                            <label for="cat_name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="category_name" id="cat_name"
                                aria-describedby="cat_name_help" value="">
                            <small id="cat_name_help" class="form-text text-muted">Please insert new category name
                                here.</small>
                        </div>
                        <div class="mb-3">
                            <label for="cat_code" class="form-label">Category Code</label>
                            <input type="text" class="form-control" name="category_code" id="cat_code"
                                aria-describedby="cat_code_help" placeholder="">
                            <small id="cat_code_help" class="form-text text-muted">Please insert new category code
                                here.</small>
                        </div>
                        {{-- <div class="mb-3">
                                <label for="stat" class="form-label">Status</label>
                                <select class="form-control" name="status" id="stat">
                                    <option value="" selected readonly></option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div> --}}
                        <input type="hidden" name="status" value="0" readonly>
                        <div class="mb-3">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1" name="status"
                                    id="stat" value="1">
                                <label class="custom-control-label" for="customSwitch1">Status</label>
                                <small id="status_help" class="form-text text-muted">ON is active and OFF is
                                    inactive.</small>
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
    </div>
@endsection

@section('js')

    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('getCategory') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'category_code',
                        name: 'category_code'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });


            $('form').on('submit', function(e) {
                e.preventDefault();
                var data = $('form').serialize();
                console.log(data);
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "post",
                    url: "{{ route('storeCategory') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        if (response == true) {
                            $('#editModal').modal('hide');
                            $('#datatable').DataTable().ajax.reload();
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }

                })
            })


            $(document).on('click', '#edit', function() {
                var id = $(this).data('id');
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "post",
                    url: "{{ route('getCategory') }}",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response) {
                            $('#id').val(response.id);
                            $('#cat_name').val(response.category_name);
                            $('#cat_code').val(response.category_code);
                            $('#stat').val(response.status);
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
                            url: "{{ route('category.destroy') }}",
                            data: {
                                id: id
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response == 1) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
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
                $('#cat_name').val('');
                $('#cat_code').val('');
                $('#stat').prop('selectedIndex', 0).val();
            })
        })
    </script>
@endsection
