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

        .cursor {
            cursor: pointer;
        }

    </style>
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="d-flex align-items-center justify-content-between">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0 mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Products</a></li>
                            <li class="breadcrumb-item active" aria-current="page">POS</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mb-3 d-flex justify-content-between">
            <h4 class="font-weight-bold d-flex align-items-center">POS</h4>
        </div>
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="refrenceNumber" class="form-label text-muted">Refrence Number</label>
                            <input type="text" id="refrenceNumber" class="form-control" name="refrenceNumber"
                                autocomplete="off">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="wareHouse" class="form-label text-muted">Ware House</label>
                            <select class="form-control" name="wareHouse" id="wareHouse">
                                <option selected value="">Select Ware House</option>
                                @foreach ($wareHouse as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="name" class="form-label text-muted">Customer</label>
                            <div class="input-group">
                                <select class="form-control d-inline-block" name="customer" id="sel_customer" aria-describedby="basic-add">
                                    <option default value="">Select Customer</option>
                                    @foreach ($customer as $value)
                                        <option value="{{ $value->id }}"
                                            data-name="{{ $value->firstname }} {{ $value->lastname }}">
                                            {{ $value->firstname }} {{ $value->lastname }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <a href="{{ route('customer.add') }}" class="btn btn-primary btn-sm" id="basic-add" style="vertical-align: center"> +
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="name" class="form-label text-muted">Product Name</label>
                            <input type="text" id="productSearch" class="form-control" name="name" autocomplete="off">
                            <div class="searchBox" id="searchBox" hidden="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <table class="table"
                            style="height: 300px; overflow: hidden; overflow-y: scroll; display:block;">
                            <thead>
                                <tr>
                                    <th>Name</th>
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
                    <div class="col-md-12 mb-3">
                        <table class="table">
                            <tr>
                                <td>
                                    <label for="itemTotal" class="form-label font-weight-bold">Items: </label>
                                    <input type="text" id="itemTotal" class="form-control font-weight-bold" name="itemTotal"
                                        autocomplete="off" readonly>
                                </td>
                                <td>
                                    <label for="tax" class="form-label font-weight-bold">Tax: </label>
                                    <input type="text" id="tax" class="form-control font-weight-bold onlyNumber" name="tax"
                                        autocomplete="off" value="0">
                                </td>
                                <td>
                                    <label for="discount" class="form-label font-weight-bold">Discount: </label>
                                    <input type="text" id="discount" class="form-control font-weight-bold onlyNumber"
                                        name="discount" autocomplete="off" value="0">
                                </td>
                                <td>
                                    <label for="grandTotal" class="form-label font-weight-bold">Total: </label>
                                    <input type="text" id="grandTotal" class="form-control font-weight-bold onlyNumber"
                                        name="grandTotal" autocomplete="off" readonly>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="button" class="btn btn-primary" id="cash">
                            Cash
                        </button>
                        <div class="modal fade show" id="cashModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog modal-xl" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Cash</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <div class="col-md-12 mb-3">
                                                    <label for="recievedAmount" class="form-label text-muted">Recieved
                                                        Amount</label>
                                                    <input type="text" id="recievedAmount" class="form-control"
                                                        name="recievedAmount" autocomplete="off">
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="change" class="form-label text-muted">Change</label>
                                                    <input type="text" id="change" class="form-control" name="change"
                                                        autocomplete="off" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="col-md-12 mb-3">
                                                    <label for="paymentAmount" class="form-label text-muted">Payment
                                                        Amount</label>
                                                    <input type="text" id="paymentAmount" class="form-control"
                                                        name="paymentAmount" autocomplete="off" readonly>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label for="paidBy" class="form-label text-muted">Paid By</label>
                                                    <select name="paidBy" class="form-control" id="paidBy">
                                                        <option value="cash" selected>Cash</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <button type="button" class="btn btn-primary btn-block cash" value="10">
                                                    10
                                                </button>
                                                <button type="button" class="btn btn-primary btn-block cash" value="20">
                                                    20
                                                </button>
                                                <button type="button" class="btn btn-primary btn-block cash" value="50">
                                                    50
                                                </button>
                                                <button type="button" class="btn btn-primary btn-block cash" value="100">
                                                    100
                                                </button>
                                                <button type="button" class="btn btn-primary btn-block cash" value="500">
                                                    500
                                                </button>
                                                <button type="button" class="btn btn-primary btn-block cash" value="1000">
                                                    1000
                                                </button>
                                                <button type="button" class="btn btn-danger btn-block" id="cashClear">
                                                    Clear
                                                </button>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="col-md-12 mb-3">
                                                    <button type="button" class="btn btn-primary" id="submit">
                                                        Submit
                                                    </button>
                                                </div>
                                                <div class="col-md-12" hidden>
                                                    <div id="print">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-2"></div>
                                                                    <div class="col-md-8">
                                                                        <div class="text-center">
                                                                            <p>
                                                                                <img src="https://www.techcoderznepal.com/public/storage/static/logo.png"
                                                                                    height="50px" />
                                                                            </p>
                                                                            <p>Address: Shantinagar, Kathmandu</p>
                                                                            <p>Phone: 987456321</p>
                                                                        </div>
                                                                        <div>
                                                                            <p>Date: {{ date('Y-m-d') }}</p>
                                                                            <p>Reference: <span id="pRefNum"></span></p>
                                                                            <p>Customer: <span id="pCustomer"></span></p>
                                                                            <br />
                                                                            <table class="table table-borderless">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th colspan="2"
                                                                                            class="text-left">Product
                                                                                        </th>
                                                                                        <th class="text-right">Price
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody id="print_tbody">
                                                                                </tbody>
                                                                                <tfoot>
                                                                                    <tr>
                                                                                        <th colspan="2"
                                                                                            class="text-left">Total
                                                                                        </th>
                                                                                        <th class="text-right"
                                                                                            id="total_print">
                                                                                        </th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th colspan="3"
                                                                                            class="text-center">
                                                                                            In Words: Five Hundred Eighty
                                                                                            Four
                                                                                        </th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td class="text-left">Paid By:
                                                                                            Cash</td>
                                                                                        <td class="text-center">Amount:
                                                                                            584.00</td>
                                                                                        <td class="text-right">Change:
                                                                                            <span id="print_change"></span>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="3"
                                                                                            class="text-center">Thank You
                                                                                            For Shopping With Us. Please
                                                                                            Come Again</td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="3"
                                                                                            class="text-center"
                                                                                            id="refrenceBarcode"></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td colspan="3"
                                                                                            class="text-center"
                                                                                            id="refrenceQR"></td>
                                                                                    </tr>
                                                                                </tfoot>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2"></div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label text-muted">Category</label>
                            <select class="form-control" name="category" id="category">
                                <option selected value="">Select Category</option>
                                @foreach ($category as $value)
                                    <option value="{{ $value->id }}">{{ $value->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label text-muted">Brand</label>
                            <select class="form-control" name="brand" id="brand">
                                <option selected value="">Select Brand</option>
                                @foreach ($brand as $value)
                                    <option value="{{ $value->id }}">{{ $value->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <ul class="list-unstyled p-0 m-0 row" id="productList"
                            style="overflow: hidden; overflow-y:scroll;">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // for modal validation
        $(document).on('click', '#cash', function(e) {

            var customer = $('#sel_customer').val();
            var wareHouse = $('#wareHouse').val();
            var skuType = $('.sku').val();
            if (customer == "") {
                alert('Please Select Customer!');
            } else if (wareHouse == "") {
                alert('Please, Select Ware House!');
            } else if ($('#tbody tr').length == 0) {
                alert('Please select atleast one product');
            } else if (skuType == "") {
                alert('You must select sku for the product');
            } else {
                $('#cashModal').modal('show');
            }
        });

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
                                results +=
                                    '<a class="searchResult dismiss" data-id="' +
                                    e.id + '" data-code="' + e.code +
                                    '" data-price="' +
                                    e.price + '" data-sku="' + e.sku +
                                    '">' + e.name +
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

            // var rowBefore;
            $(document).on('click', '.searchResult', function() {
                // rowBefore = $('#tbody').children();
                // if(rowBefore){
                //     $.each(rowBefore, function(){
                //         if($(this).children().eq(2).children().val() == ''){
                //             $(this).children().eq(2).children().focus();
                //             alert('Select the SKU of previous product');
                //             exit;
                //         }
                //     })
                // }
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
                                '" data-quantity="' + this.quantity + '">' +
                                this.sku +
                                '(' + this.size + '/ ' + this.color +
                                ')</option>';
                        });
                        var row = '<tr id="' + product.data('id') + '">' +
                            '<td>' + product.html() + '<br />(' + product.data(
                                'code') +
                            ')</td>' +
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
                        var totalrow = $('#tbody tr').length;

                        $('#itemTotal').val(totalrow);
                        grandTotal();
                    }
                });
            });

            $(document).on('click', '.minus', function() {
                $(this).parent().parent().remove();
                var totalrow = $('#tbody tr').length;

                $('#itemTotal').val(totalrow);
                grandTotal();
            });

            $(document).on('change', '.quantity', function() {
                var quantity = $(this).val();
                var thisPrice = $(this).parent().next().html();
                var total = parseInt(quantity) * parseInt(thisPrice);
                var thisTotal = $(this).parent().next().next().html(total);
                grandTotal();
            });

            $(document).on('click', '.dismiss', function() {
                $('#searchBox').prop('hidden', true);
            });

            $(document).on('change', '.sku', function() {
                var currentSku = $(this);
                var quantity = $(this).find('option:selected').data('quantity');
                $(this).closest('td').next('td').find('input[type="number"]').val(1);
                $(this).closest('td').next('td').find('input[type="number"]').prop('max',
                    quantity);
                $(this).closest('td').next('td').next('td').next('td').html($(this).closest(
                        'td').next('td')
                    .next('td').html());
                var sku = $(this).val();
                var skuName = $('option:selected', this).data('skuname');
                console.log(skuName);

                grandTotal();
            });
            // getting the selected sku value data
            // $(document).ready(function(){
            //     $()
            // })

            $(document).on('change', '.quantity', function() {
                var sku = $(this).closest('td').prev('td').find('select').val();
                if (sku == '') {
                    $(this).closest('td').prev('td').find('select').focus();
                    alert('Please select SKU');
                    $(this).val(1);
                }
                grandTotal();
            });

            $(document).on('change', '#category, #brand', function() {
                var id = $(this).val();
                var url;
                if ($(this).attr('id') == 'category') {
                    url = '{{ route('pos.category.get') }}';
                    $('#brand').val('');
                } else {
                    url = '{{ route('pos.brand.get') }}';
                    $('#category').val('');
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    dataType: 'json',
                    method: 'post',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        if (response) {
                            var li = '';
                            $.each(response, function() {
                                var image;
                                if (this.image == '') {
                                    var image =
                                        '<img src="{{ asset('public/uploads/no-image.jpg') }}" class="img-thumbnail w-100 img-fluid rounded" alt="no-image" height="100px">';
                                } else {
                                    var image =
                                        '<img src="{{ asset('public/uploads/product') }}/' +
                                        this.image +
                                        '" class="img-thumbnail w-100 img-fluid rounded" alt="' +
                                        this.name + '" height="100px">';
                                }
                                li +=
                                    '<li class="col-lg-4 col-md-6 col-sm-6 mt-2 cursor dropSearchProduct" data-id="' +
                                    this.id + '" data-code="' + this.code +
                                    '" data-price="' + this.price + '">' +
                                    image +
                                    '<div class="text-center">' +
                                    '<p class="form-label text-muted text-center">' +
                                    this.name +
                                    '</p>' +
                                    '</div>' +
                                    '</li>';
                            });
                            $('#productList').html(li);
                        }
                    }
                })
            });

            $(document).on('click', '.dropSearchProduct', function() {
                // rowBefore = $('#tbody').children();
                // if(rowBefore){
                //     $.each(rowBefore, function(){
                //         if($(this).children().eq(2).children().val() == ''){
                //             $(this).children().eq(2).children().focus();
                //             alert('Select the SKU of previous product');
                //             exit;
                //         }
                //     })
                // }
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
                        console.log(response);
                        var option = '<option value="">Select</option>';
                        $.each(response, function() {
                            option += '<option value="' + this.id +
                                '" data-quantity="' + this.quantity + '">' +
                                this.sku +
                                '(' + this.size + '/ ' + this.color +
                                ')</option>';
                        });
                        var row = '<tr id="' + product.data('id') + '">' +
                            '<td>' + product.children('div').children('p').html() +
                            '<br />(' +
                            product.data('code') + ')</td>' +
                            '<td class="not_req">' +
                            '<select class="form-control sku" name="sku" required>' +
                            option +
                            '</select>' +
                            '</td>' +
                            '<td class="not_req">' +
                            '<input class="form-control quantity" type="number" name="quantity" value="1" min="1" max="5">' +
                            '</td>' +
                            '<td class="not_req">' + product.data('price') +
                            '</td>' +
                            '<td>' + product.data('price') + '</td>' +
                            '<td class="not_req"><button type="button" class="btn btn-danger btn-sm minus">-</button></td>' +
                            '</tr>';
                        $('#tbody').append(row);
                        $('#productSearch').val('');
                        var totalrow = $('#tbody tr').length;

                        $('#itemTotal').val(totalrow);
                        grandTotal();
                    }
                });
            });

            var reference_num = 'posr-' + (Math.random() + 1).toString(25).substring(9) + (Math
                    .random() + 1)
                .toString(25).substring(9) + (Math.random() + 1).toString(25).substring(9);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('pos.barcode') }}',
                dataType: 'json',
                method: 'post',
                data: {
                    refrenceNumber: reference_num
                },
                success: function(response) {
                    $('#refrenceBarcode').html('<img src="data:image/png;base64,' + response
                        .barcode +
                        '" />');
                    $('#refrenceQR').html('<img src="data:image/png;base64,' + response.QR +
                        '" />');
                }
            });


            $('#refrenceNumber').val(reference_num);

            //all data for printing
            $('#pRefNum').html(reference_num);

            //getcustomer
            var customer = '';
            $('#sel_customer').on('change', function() {
                customer = $('option:selected', this).data('name');
                $('#pCustomer').html(customer);
            });

            //product
            // var rows = document.getElementsByTagName("tbody")[0].rows;
            // for (var i = 0; i < rows.length; i++) {
            //     var td = rows[i].getElementsByTagName("td")[i];
            //     console.log(td)
            // }

            $(document).on('click', '#cash', function() {
                $('#print_tbody').html('');
                $('#tbody > tr').each(function(i, o) {
                    var self = $(this);
                    var name = self.find("td:eq(0)").text();
                    var price = self.find("td:eq(4)").text();
                    var quantity = self.find("td:eq(2)").children().val();
                    var row = '<tr>';
                    row += '<td colspan="2" class="text-left">' + name + '(X' +
                        quantity + ')</td>';
                    row += '<td class="text-right">' + price + '</td>';
                    row += '</tr>';
                    $('#print_tbody').append(row);
                });
            });

            $(document).on('click', '.svgEdit', function() {
                $(this).next('span').attr('contentEditable', true).focus();
            }).blur(function() {
                $(this).next('span').attr('contentEditable', false);
            });

            $(document).on('keyup', '#tax, #discount', function() {
                grandTotal();
            });

            function grandTotal() {
                var total = 0;
                $.each($('#tbody').children(), function() {
                    total += parseInt($(this).children().eq(4).html());
                });
                var tax = $('#tax').val() ? total * parseInt($('#tax').val()) / 100 : 0;
                var discount = $('#discount').val() ? parseInt($('#discount').val()) : 0;
                total = total + tax - discount;
                $('#grandTotal').val(total);

                $('#total_print').html(total);
            }

            $(document).on('click', '#cash, #cashClear', function() {
                $('#recievedAmount').val(0);
                $('#paymentAmount').val($('#grandTotal').val());
                $('#change').val(-$('#grandTotal').val());
            });

            $(document).on('click', '.cash', function() {
                var recieve = $('#recievedAmount').val() ? parseInt($('#recievedAmount')
                    .val()) : parseInt(
                    0);
                $('#recievedAmount').val(recieve + parseInt($(this).val()));
                $('#change').val(parseInt($('#change').val()) + parseInt($(this).val()));

                $('#print_change').html(parseInt($('#change').val()) + parseInt($(this).val()));
            });

            $(document).on('change', '#recievedAmount', function() {
                $('#change').val(parseInt($('#change').val()) + parseInt($(this).val()));
            });

            $(document).on('click', '#submit', function() {
                var printContent = document.getElementById('print').innerHTML;
                var windowObject = window.open('', '');
                windowObject.document.write(
                    '<link rel="stylesheet" href="{{ asset('public/backend//assets/css/backend-v=1.0.0.css') }} ">'
                );
                windowObject.document.write(printContent);
                windowObject.document.close();
                windowObject.focus();
                windowObject.print();
                var data = {
                    'refrenceNumber': $('#refrenceNumber').val(),
                    'wareHouseId': $('#wareHouse').val(),
                    'customerId': $('#sel_customer').val(),
                    'item': $('#itemTotal').val(),
                    'tax': $('#tax').val(),
                    'discount': $('#discount').val(),
                    'total': $('#grandTotal').val(),
                    'recievedAmount': $('#recievedAmount').val(),
                    'change': $('#change').val(),
                    'paidBy': $('#paidBy').val(),
                };
                var items = {};
                $.each($('#tbody').children(), function(i, e) {
                    items[i] = {
                        productId: $(this).attr('id'),
                        skuId: $(this).children().eq(1).children().val(),
                        quantity: $(this).children().eq(2).children().val(),
                    };
                });
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route('pos.store') }}',
                    dataType: 'json',
                    method: 'post',
                    data: {
                        data: data,
                        items: items,
                    },
                    success: function(response) {
                        if (response == 'successful') {
                            location.reload();
                            alert('process saved');
                        }
                    }
                })
            });
        })
    </script>
@endsection
