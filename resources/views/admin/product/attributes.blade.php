@extends('admin.includes.admin_design')

@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
        <div class="d-flex align-items-center justify-content-between">
            <h4 class="font-weight-bold">Product Attributes</h4>
        </div>
        <div class="create-workform">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="modal-product-search d-flex">
                    <button type="button" id='add'
                        class="btn btn-primary position-relative d-flex align-items-center justify-content-between"
                        data-toggle="modal" data-target="#attributesModal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="attributesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add/Edit Product Attribute</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @include('admin.includes._message')
                <form method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div id="errors"></div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id" id="id">
                        </div>
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="p_id" id="p_id" value="{{ request()->id }}">
                        </div>
                        <div class="form-group">
                            <label for="size" class="form-label">Size</label>
                            <input type="text" class="form-control" name="size" id="size">
                        </div>
                        <div class="form-group">
                            <label for="color" class="form-label">Color</label>
                            <input type="text" class="form-control" name="color" id="color">
                        </div>
                        <div class="form-group">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" class="form-control" name="price" id="price">
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
                                                <th>Size</th>
                                                <th>Color</th>
                                                <th>Price</th>
                                                <th>SKU</th>
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
            var product_id = "{{ request()->id }}";
            console.log(id);
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('product.attr.get', ['id' => 'productId']) }}".replace('productId',
                    product_id),
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'size',
                        name: 'size'
                    },
                    {
                        data: 'color',
                        name: 'color'
                    },
                    {
                        data: 'additional_price',
                        name: 'additional_price'
                    },
                    {
                        data: 'sku',
                        name: 'sku'
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
                    url: "{{ route('product.attr.store') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response == true) {
                            $('#attributesModal').modal('hide');
                            $('#datatable').DataTable().ajax.reload();
                        }
                    },
                    error: function(response) {
                        var error = '<div class="alert alert-danger"><ul>';
                        $.each(response.responseJSON.errors, function(e, i) {
                            error += '<li style="list-style-type: none">' + i + '</li>'
                        })
                        error += '</ul></div>'
                        $('#errors').html(error);
                    }
                })
            });

            $(document).on('click', '#edit', function() {
                var id = $(this).data('id');
                var product_id = "{{ request()->id }}";
                $.ajax({
                    method: "post",
                    url: "{{ route('product.attr.get', ['id' => 'productId']) }}".replace(
                        'productId', product_id),
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response) {
                            $('#id').val(response.id);
                            $('#size').val(response.size);
                            $('#color').val(response.color);
                            $('#price').val(response.price);
                        }
                    },
                    error: function(response) {
                        var error = '<div class="alert alert-danger"><ul>';
                        $.each(response.responseJSON.errors, function(key, value) {
                            error += '<li style="list-style-type: none">' + value +
                                '</li>'
                        })
                        error += '</ul></div>'
                        $('#errors').html(error);
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
                            method: "post",
                            url: "{{ route('product.attr.destroy') }}",
                            data: {
                                id: id
                            },
                            dataType: "json",
                            success: function(response) {
                                if (response == 1) {
                                    Swal.fire(
                                        'Deleted!',
                                        'A product has been deleted.',
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
            });

            $('#add').on('click', function() {
                $('#id').val('');
                $('#size').val('');
                $('#color').val('');
                $('#price').val('');
                $('#errors').html('');
            });
        });
    </script>
@endsection
