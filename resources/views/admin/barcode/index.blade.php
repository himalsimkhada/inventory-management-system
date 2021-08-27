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

        .barcodePreview {
            padding: 1.3rem;
            /* border: 1px solid rgba(0,0,0,.15); */
            /* border-radius: 5px; */
            /* width: auto; */
        }

        #barcodeTable td {
            text-align: center;
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
                <div class="card-body">
                    <p>Provide Product Information.</p>
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
                                    <th>SKU</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="paper_size" class="form-label font-weight-bold text-muted text-uppercase">Paper
                            Size</label>
                        <select name="size" id="paper_size" class="form-control">
                            <option value="">Select Size</option>
                            <option value="1">76mm x 36mm </option>
                            <option value="2">40mm x 24mm</option>
                            <option value="3">30mm x 18mm</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="button" class="btn btn-primary" id="create" data-toggle="modal"
                            data-target="#barcode">
                            Create
                        </button>
                    </div>
                    <div class="modal fade" id="barcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn btn-primary" id="print">Print</button>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="row" id="printable">
                                            <table class="table table-borderless" id="barcodeTable">
                                            </table>
                                        </div>
                                        >>>>>>> 01ba3f0780f60c876ab558ae0ab40a651b92dc43
                                    </div>
                                </div>
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
            $(document).on('keyup', '#productSearch', function(e) {
                var name = $(this).val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('product.search') }}',
                    dataType: 'json',
                    method: 'post',
                    data: {
                        name: name
                    },
                    success: function(response) {
                        if (response.length > 0) {
                            $('#searchBox').html('');
                            var results =
                                '<div class="col-lg-12"><a type="button" class="close dismiss"><span aria-hidden="true">&times;</span></a></div>';
                            $.each(response, function(i, e) {
                                results += '<a class="searchResult dismiss" data-id="' +
                                    e.id + '" data-code="' + e.code + '" data-price="' +
                                    e.price + '" data-sku="' + e.sku + '">' + e.name +
                                    '</a>';
                            });
                            $('#searchBox').html(results);
                            $('#searchBox').prop('hidden', false);
                            if (e.key === "Escape") {
                                $('#searchBox').prop('hidden', true);
                            }
                        } else {
                            $('#searchBox').html('');
                            $('#searchBox').prop('hidden', true);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                })

            });

            var rowBefore;
            $(document).on('click', '.searchResult', function() {
                rowBefore = $('#tbody').children();
                if (rowBefore) {
                    $.each(rowBefore, function() {
                        if ($(this).children().eq(2).children().val() == '') {
                            $(this).children().eq(2).children().focus();
                            alert('Select the SKU of previous product');
                            exit;
                        }
                    })
                }
                var product = $(this);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('product.sku.search') }}',
                    dataType: 'json',
                    method: 'post',
                    data: {
                        id: product.data('id')
                    },
                    success: function(response) {
                        var option = '<option value="">Select</option>';
                        $.each(response, function() {
                            option += '<option value="' + this.id +
                                '" data-quantity="' + this.quantity + '">' + this.sku +
                                '(' + this.size + '/ ' + this.color + ')</option>';
                        });
                        var row = '<tr id="' + product.data('id') + '">' +
                            '<td>' + product.html() + '</td>' +
                            '<td>' + product.data('code') + '</td>' +
                            '<td>' +
                            '<select class="form-control sku" name="sku" required>' +
                            option +
                            '</select>' +
                            '</td>' +
                            '<td>' +
                            '<input class="form-control quantity" type="number" name="quantity" value="1" min="1" max="5">' +
                            '</td>' +
                            '<td>' + product.data('price') + '</td>' +
                            '<td>' + product.data('price') + '</td>' +
                            '<td><button type="button" class="btn btn-danger btn-sm minus">-</button></td>' +
                            '</tr>';
                        $('#tbody').append(row);
                        $('#productSearch').val('');
                    }
                });
            });

            $(document).on('click', '.minus', function() {
                $(this).parent().parent().remove();
            });

            $(document).on('change', '.quantity', function() {
                var quantity = $(this).val();
                var thisPrice = $(this).parent().next().html();
                var total = parseInt(quantity) * parseInt(thisPrice);
                var thisTotal = $(this).parent().next().next().html(total);
            });

            $(document).on('click', '.dismiss', function() {
                $('#searchBox').prop('hidden', true);
            });

            $(document).on('change', '.sku', function() {
                var currentSku = $(this);
                var quantity = $(this).find('option:selected').data('quantity');
                $(this).closest('td').next('td').find('input[type="number"]').val(1);
                $(this).closest('td').next('td').find('input[type="number"]').prop('max', quantity);
                $(this).closest('td').next('td').next('td').next('td').html($(this).closest('td').next('td')
                    .next('td').html());
                var sku = $(this).val();

            });

            $(document).on('change', '.quantity', function() {
                var sku = $(this).closest('td').prev('td').find('select').val();
                if (sku == '') {
                    $(this).closest('td').prev('td').find('select').focus();
                    alert('Please select SKU');
                    $(this).val(1);
                }
            });

            $(document).on('click', '#create', function() {
                var id = [];
                var quantity = [];
                $.each($('#tbody').children(), function() {
                    id.push($(this).find('.sku').val());
                    quantity.push($(this).find('.quantity').val());
                });
                console.log(quantity);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('barcode.get') }}',
                    dataType: 'json',
                    method: 'post',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        console.log(response);
                        if (response) {
                            var row = '';
                            $.each(response, function(i, e) {
                                for (var j = 0; j < quantity[i]; j++) {
                                    row += '<tr>' +
                                        '<td>' +
                                        '<div class="text-center">' +
                                        '<img class="img_size" src="' + e.barcode +
                                        '">' +
                                        '</div>' +
                                        '<div class="text-center text_size">' +
                                        e.sku +
                                        '</div>' +
                                        '</td>' +
                                        '</tr>';
                                }
                            });
                            $('#barcodeTable').html(row);
                            if ($('#paper_size').val() == 1) {
                                $('.img_size').css({
                                    "width": "76mm",
                                    "height": "36mm"
                                });
                                $('.text_size').css("font-size", "4mm");
                            } else if ($('#paper_size').val() == 2) {
                                $('.img_size').css({
                                    "width": "40mm",
                                    "height": "24mm"
                                });
                                $('.text_size').css("font-size", "3mm");
                            } else if ($('#paper_size').val() == 3) {
                                $('.img_size').css({
                                    "width": "30mm",
                                    "height": "18mm"
                                });
                                $('.text_size').css("font-size", "2mm");
                            }
                        }
                    }
                })
            });
            $(document).on('click', '#print', function() {
                var divtoprint = document.getElementById('printable');
                newWin = window.open("");
                newWin.document.write(divtoprint.outerHTML);
                newWin.print();
                newWin.close();
            })
        })
    </script>
@endsection
