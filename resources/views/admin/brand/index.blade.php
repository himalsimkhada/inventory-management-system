@extends('admin.includes.admin_design')

@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
        <div class="d-flex align-items-center justify-content-between">
            <h4 class="font-weight-bold">Brand</h4>
        </div>
        <div class="create-workform">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="modal-product-search d-flex">
                    <button type="button" id='add'
                        class="btn btn-primary position-relative d-flex align-items-center justify-content-between"
                        data-toggle="modal" data-target="#brandModal">
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

    <div class="modal fade" id="brandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id" id="id">
                        </div>
                        <div class="form-group">
                            <label for="brand_name" class="form-label">Branch Name</label>
                            <input type="text" class="form-control" name="brand_name" id="brand_name">
                        </div>
                        <div class="form-group">
                            <label for="brand_code" class="form-label">Branch Code</label>
                            <input type="text" class="form-control" name="brand_code" id="brand_code">
                        </div>
                        <div class="form-group">
                            <label for="image" class="form-label">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" value="">
                                <label class="custom-file-label" for="image">Choose Image</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <img id="selectedImage" src="{{ asset('public/uploads/no-image.jpg') }}"
                                    class="img-fluid rounded" alt="#">
                            </div>
                            <div id="removeDiv" class="card" hidden="hidden">
                                <button type="button" class="btn btn-danger" id="removeImage">Remove Image</button>
                            </div>
                        </div>
                        <input type="hidden" name="status" value="0" readonly>
                        <div
                            class="custom-control custom-switch custom-switch-text custom-switch-color custom-control-inline">
                            <div class="custom-switch-inner">
                                <p class="mb-0"> Status </p>
                                <input type="checkbox" class="custom-control-input bg-success" id="status" name="status"
                                    value="1" checked="checked">
                                <label class="custom-control-label" for="status" data-on-label="Active"
                                    data-off-label="Inactive">
                                </label>
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
                                                <th>Code</th>
                                                <th>Image</th>
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

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('brand.get') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'brand_name',
                        name: 'brand_name'
                    },
                    {
                        data: 'brand_code',
                        name: 'brand_code'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
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
                    url: "{{ route('brand.store') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response == true) {
                            $('#brandModal').modal('hide');
                            $('#datatable').DataTable().ajax.reload();
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                })
            });

            $(document).on('click', '#edit', function() {
                var id = $(this).data('id');
                $.ajax({
                    method: "post",
                    url: "{{ route('brand.get') }}",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response) {
                            $('#id').val(response.id);
                            $('#brand_code').val(response.brand_code);
                            $('#brand_name').val(response.brand_name);
                            if (response.image == '') {
                                $('#selectedImage').prop('src',
                                    '{{ asset('public/uploads/no-image.jpg') }}');
                                $('#image').val('');
                                $('#image').next().text('Choose Image');
                                $('#removeDiv').prop('hidden', true);
                            } else {
                                $('#selectedImage').prop('src',
                                    '{{ asset('public/uploads/brand') }}/' + response
                                    .image);
                                $('#image').next().text(response.image);
                                $('#removeDiv').prop('hidden', false);
                            }
                            if (response.status == 0) {
                                $('#status').prop('checked', false);
                            }
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
                            url: "{{ route('brand.destroy') }}",
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

            $("#image").on('change', function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#selectedImage').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
                $('#removeDiv').prop('hidden', false);
            });

            $('#removeImage').on('click', function() {
                $('#image').val('');
                $('#image').next().text('Choose Image');
                $('#selectedImage').attr('src', '{{ asset('public/uploads/no-image.jpg') }}');
                $('#removeDiv').prop('hidden', true);
            });

            $('#add').on('click', function() {
                $('#id').val('');
                $('#brand_name').val('');
                $('#brand_code').val('');
                $('#image').val('');
                $('#image').next().text('Choose Image');
                $('#selectedImage').attr('src', '{{ asset('public/uploads/no-image.jpg') }}');
                $('#removeDiv').prop('hidden', true);
                $('#status').prop('checked', true);
            });
        })
    </script>
@endsection
