@extends('admin.includes.admin_design')

@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
        <div class="d-flex align-items-center justify-content-between">
            <h4 class="font-weight-bold">Product</h4>
        </div>
        <div class="create-workform">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="modal-product-search d-flex">
                    <a href="{{ route('product.add') }}" type="button" id='add'
                        class="btn btn-primary position-relative d-flex align-items-center justify-content-between">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
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
                                                <th>S. No.</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Code</th>
                                                <th>Category</th>
                                                <th>Brand</th>
                                                <th>Unit</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
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

    <div class="modal fade" id="productDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Product Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-5 col-lg-5">
                            <div class="card-body">
                                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                    <ol class="carousel-indicators" id="indicators">
                                    </ol>
                                    <div class="carousel-inner" id="carouselItem">
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7 col-lg-7">
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Product Name</th>
                                        <td id="productName"></td>
                                    </tr>
                                    <tr>
                                        <th>Product Code</th>
                                        <td id="productCode"></td>
                                    </tr>
                                    <tr>
                                        <th>Category</th>
                                        <td id="productCategory"></td>
                                    </tr>
                                    <tr>
                                        <th>Brand</th>
                                        <td id="productBrand"></td>
                                    </tr>
                                    <tr>
                                        <th>Unit</th>
                                        <td id="productUnit"></td>
                                    </tr>
                                    <tr>
                                        <th>Price</th>
                                        <td id="productPrice"></td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td id="productDescription"></td>
                                    </tr>
                                </table>
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
                dom: 'Bfrtip',
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
                processing: true,
                serverSide: true,
                ajax: "{{ route('product.get') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'category_id',
                        name: 'category_id'
                    },
                    {
                        data: 'brand_id',
                        name: 'brand_id'
                    },
                    {
                        data: 'unit_id',
                        name: 'unit_id'
                    },
                    {
                        data: 'price',
                        name: 'price',
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
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
                            url: "{{ route('product.destroy') }}",
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

            $(document).on('click', '#datatable tbody tr td:not(:last-child)', function() {
                var carouselItem = '';
                var indicators = '';
                var id = $(this).parent().find("td:eq(1)").children().eq(0).attr('id');
                $('#productDetail').modal('show');
                $.ajax({
                    method: "post",
                    url: "{{ route('product.detail') }}",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.image.length > 0) {
                            $.each(response.image, function(i, e) {
                                var active = (i == 0) ? 'active' : '';
                                var src = '{{ asset('public/uploads/product') }}/' + e
                                    .image;
                                carouselItem += '<div class="carousel-item ' + active +
                                    '"><img src="' + src +
                                    '" class="d-block w-100" alt="' + e.image +
                                    '"></div>';
                                indicators +=
                                    '<li data-target="#carouselExampleIndicators" data-slide-to="' +
                                    i + '" class="' + active + '"></li>';
                            })
                        } else {
                            carouselItem +=
                                '<div class="carousel-item active"><img src="{{ asset('public/uploads/no-image.jpg') }}" class="d-block w-100" alt="no-image.jpg"></div>';
                            indicators +=
                                '<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>';
                        }
                        $('#carouselItem').html(carouselItem);
                        $('#indicators').html(indicators);
                        if (response.product) {
                            var data = response.product;
                            console.log(data);
                            $('#productName').html(data.name);
                            $('#productCode').html(data.code);
                            $('#productCategory').html(data.category.category_name);
                            $('#productBrand').html(data.brand.brand_name);
                            $('#productUnit').html(data.unit.name);
                            $('#productPrice').html(data.price);
                            $('#productDescription').html(data.description);
                        } else {
                            var data = response.product[0];
                            $('#productName').html('n/a');
                            $('#productCode').html('n/a');
                            $('#productCategory').html('n/a');
                            $('#productBrand').html('n/a');
                            $('#productUnit').html('n/a');
                            $('#productPrice').html('n/a');
                            $('#productDescription').html('n/a');
                        }
                    },
                    error: function(response) {
                        $('#carouselItem').html(
                            '<div class="carousel-item active"><img src="{{ asset('public/uploads/no-image.jpg') }}" class="d-block w-100" alt="no-image.jpg"></div>'
                        );
                        $('#indicators').html(
                            '<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>'
                        );
                        $('#productName').html('n/a');
                        $('#productCode').html('n/a');
                        $('#productCategory').html('n/a');
                        $('#productBrand').html('n/a');
                        $('#productUnit').html('n/a');
                        $('#productPrice').html('n/a');
                        $('#productDescription').html('n/a');
                    }
                })
            })
        });
    </script>
@endsection
