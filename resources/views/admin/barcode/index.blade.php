@extends('admin.includes.admin_design')

@section('content')
    <style>
        .searchBox {
            min-width: 10rem;
            padding: .5rem;
            margin: .125rem 0 0;
            font-size: 1rem;
            box-shadow: 0 16px 24px rgb(96 97 112 / 10%), 0 32px 48px rgb(0 0 0 / 15%);
            position: absolute;
            z-index: 1000;
            background-color: #fff;
            color: #324253;
            border: 1px solid rgba(0, 0, 0, .15);
            border-radius: 5px;
            word-wrap: normal;
        }

        .searchResult {
            display: block;
            width: 100%;
            padding: .5rem 1rem;
            clear: both;
            font-weight: 400;
            color: #212529;
            text-align: inherit;
            background-color: transparent;
            border: 0;
        }

        .searchResult:hover {
            background-color: #f8f9fa;
            border-radius: 5px;
            color: #212529;
        }

    </style>
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="d-flex align-items-center justify-content-between">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0 mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Products</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Print Barcode</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mb-3 d-flex justify-content-between">
            <h4 class="font-weight-bold d-flex align-items-center">Barcode</h4>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" id="dropzone">
                    <p>Provide Product Information.</p>
                    <form class=" row g-3">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label font-weight-bold text-muted text-uppercase">Product
                                Name</label>
                            <input type="text" id="productSearch" class="form-control" name="name" autocomplete="off">
                            <div class=" searchBox" id="searchBox" hidden="">
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="button" class="btn btn-primary" id="submitForm">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" role="dialog" id="modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h5 class="modal-title" id="print">Print</h5> --}}
                    <button type="button" class="btn btn-outline-secondary" id="print">Print</button>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="barcode_mat">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });

            $(document).on('keyup', '#productSearch', function(e) {
                var name = $(this).val();
                $.ajax({
                    url: '{{ route('product.search') }}',
                    dataType: 'json',
                    method: 'post',
                    data: {
                        name: name
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.length > 0) {
                            $('#searchBox').html('');
                            var results =
                                '<div class="col-lg-12"><a type="button" class="close dismiss"><span aria-hidden="true">&times;</span></a></div>';
                            $.each(response, function(i, e) {
                                results += '<a class="searchResult dismiss" data-id="' +
                                    e.id + '" data-code="' + e.code + '" data-price="' +
                                    e.price + '">' + e.name + '</a>';
                            });
                            $('#searchBox').html(results);
                            $('#searchBox').prop('hidden', false);
                        } else {
                            $('#searchBox').html('');
                            $('#searchBox').prop('hidden', true);
                        }
                        if (e.key === "Escape" || e.key === "Esc") {
                            $('#searchBox').prop('hidden', true);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })
            });

            $(document).on('click', '.searchResult', function() {
                var product = $(this);
                var row = '<tr>' +
                    '<td id="' + product.data('id') + '" class="id" hidden>' + product.data('id') +
                    '</td>' +
                    '<td id="name">' + product.html() + '</td>' +
                    '<td id="code">' + product.data('code') + '</td>' +
                    '<td id="count">' +
                    '<input class="form-control" type="number" type="number" name="quantity" id="quantity" value="1" min="0">' +
                    '</td>' +
                    '<td id="price">' + product.data('price') + '</td>' +
                    '<td id="total">' + product.data('price') + '</td>' +
                    '<td><button type="button" class="btn btn-danger btn-sm">-</button></td>' +
                    '</tr>';
                $('tbody').append(row);

            })

            $(document).on('click', '#submitForm', function() {
                var id = [];

                $('.id').each(function(i, v) {
                    // console.log(v.id);
                    id[i] = v.id;

                    // $('#barcode_mat').append('q');
                })

                $.ajax({
                    url: '{{ route('product.barcode') }}',
                    dataType: 'json',
                    method: 'get',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        // console.log(response);
                        $('#barcode_mat').append(response);
                    }
                })

                $('#modal').modal('show');

                $('#print').on('click', function() {
                    var divtoprint = document.getElementById('barcode_mat');
                    newWin = window.open("");
                    newWin.document.write(divtoprint.outerHTML);
                    newWin.print();
                    newWin.close();
                })

            });

            $(document).on('click', '.dismiss', function() {
                $('#searchBox').prop('hidden', true);
            });
        })
    </script>
@endsection
