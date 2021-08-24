@extends('admin.includes.admin_design')

@section('content')
    <style>
        .searchBox{
            min-width: 10rem;
            padding: .5rem;
            margin: .125rem 0 0;
            font-size: 1rem;
            box-shadow: 0 16px 24px rgb(96 97 112 / 10%), 0 32px 48px rgb(0 0 0 / 15%);
            position: absolute;
            z-index: 1000;
            background-color: #fff;
            color: #324253;
            border: 1px solid rgba(0,0,0,.15); 
            border-radius: 5px;
            word-wrap: normal;
        }
        .searchResult{
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
        .searchResult:hover{
            background-color: #f8f9fa;
            border-radius: 5px;
            color: #212529;
        }
        .barcodePreview{
            padding: 1.3rem;
            /* border: 1px solid rgba(0,0,0,.15); */
            /* border-radius: 5px; */
            /* width: auto; */
        }
        #barcodeTable td{
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
                <div class="card-body" id="dropzone">
                    <p>Provide Product Information.</p>
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label font-weight-bold text-muted text-uppercase">Product Name</label>
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="button" class="btn btn-primary" id="create" data-toggle="modal" data-target="#barcode">
                            Create
                        </button>
                    </div>
                    <div class="modal fade" id="barcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
                        aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn btn-primary">Print</button>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card-body">
                                        <div class="row">
                                            <table class="table table-borderless" id="barcodeTable">
                                                <tr>
                                                    <td>
                                                        <div class="text-center">
                                                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOAAAAAhAQMAAAD6VzWzAAAABlBMVEX///8AAABVwtN+AAAAAXRSTlMAQObYZgAAAAlwSFlzAAAOxAAADsQBlSsOGwAAADFJREFUKJFj6N6169ErvXeLut6t63u96NWjrne79Hb1vdLrXte9i2FUclRyVHLQSgIAxKltc+8zx7UAAAAASUVORK5CYII=">
                                                        </div>
                                                        <div class="text-center">
                                                            SAM-NOR-BLA
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-center">
                                                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOAAAAAhAQMAAAD6VzWzAAAABlBMVEX///8AAABVwtN+AAAAAXRSTlMAQObYZgAAAAlwSFlzAAAOxAAADsQBlSsOGwAAADFJREFUKJFj6N6169ErvXeLut6t63u96NWjrne79Hb1vdLrXte9i2FUclRyVHLQSgIAxKltc+8zx7UAAAAASUVORK5CYII=">
                                                        </div>
                                                        <div class="text-center">
                                                            SAM-NOR-BLA
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="text-center">
                                                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOAAAAAhAQMAAAD6VzWzAAAABlBMVEX///8AAABVwtN+AAAAAXRSTlMAQObYZgAAAAlwSFlzAAAOxAAADsQBlSsOGwAAADFJREFUKJFj6N6169ErvXeLut6t63u96NWjrne79Hb1vdLrXte9i2FUclRyVHLQSgIAxKltc+8zx7UAAAAASUVORK5CYII=">
                                                        </div>
                                                        <div class="text-center">
                                                            SAM-NOR-BLA
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-center">
                                                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOAAAAAhAQMAAAD6VzWzAAAABlBMVEX///8AAABVwtN+AAAAAXRSTlMAQObYZgAAAAlwSFlzAAAOxAAADsQBlSsOGwAAADFJREFUKJFj6N6169ErvXeLut6t63u96NWjrne79Hb1vdLrXte9i2FUclRyVHLQSgIAxKltc+8zx7UAAAAASUVORK5CYII=">
                                                        </div>
                                                        <div class="text-center">
                                                            SAM-NOR-BLA
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="text-center">
                                                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOAAAAAhAQMAAAD6VzWzAAAABlBMVEX///8AAABVwtN+AAAAAXRSTlMAQObYZgAAAAlwSFlzAAAOxAAADsQBlSsOGwAAADFJREFUKJFj6N6169ErvXeLut6t63u96NWjrne79Hb1vdLrXte9i2FUclRyVHLQSgIAxKltc+8zx7UAAAAASUVORK5CYII=">
                                                        </div>
                                                        <div class="text-center">
                                                            SAM-NOR-BLA
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-center">
                                                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOAAAAAhAQMAAAD6VzWzAAAABlBMVEX///8AAABVwtN+AAAAAXRSTlMAQObYZgAAAAlwSFlzAAAOxAAADsQBlSsOGwAAADFJREFUKJFj6N6169ErvXeLut6t63u96NWjrne79Hb1vdLrXte9i2FUclRyVHLQSgIAxKltc+8zx7UAAAAASUVORK5CYII=">
                                                        </div>
                                                        <div class="text-center">
                                                            SAM-NOR-BLA
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="text-center">
                                                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOAAAAAhAQMAAAD6VzWzAAAABlBMVEX///8AAABVwtN+AAAAAXRSTlMAQObYZgAAAAlwSFlzAAAOxAAADsQBlSsOGwAAADFJREFUKJFj6N6169ErvXeLut6t63u96NWjrne79Hb1vdLrXte9i2FUclRyVHLQSgIAxKltc+8zx7UAAAAASUVORK5CYII=">
                                                        </div>
                                                        <div class="text-center">
                                                            SAM-NOR-BLA
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="text-center">
                                                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOAAAAAhAQMAAAD6VzWzAAAABlBMVEX///8AAABVwtN+AAAAAXRSTlMAQObYZgAAAAlwSFlzAAAOxAAADsQBlSsOGwAAADFJREFUKJFj6N6169ErvXeLut6t63u96NWjrne79Hb1vdLrXte9i2FUclRyVHLQSgIAxKltc+8zx7UAAAAASUVORK5CYII=">
                                                        </div>
                                                        <div class="text-center">
                                                            SAM-NOR-BLA
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
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
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });

        $(document).on('keyup', '#productSearch', function(e){
            var name = $(this).val();
            $.ajax({
                url: '{{ route('product.search') }}',
                dataType: 'json',
                method: 'post',
                data: {
                    name: name
                },
                success: function(response) {
                    if(response.length > 0){
                        $('#searchBox').html('');
                        var results = '<div class="col-lg-12"><a type="button" class="close dismiss"><span aria-hidden="true">&times;</span></a></div>';
                        $.each(response, function(i, e){
                            results += '<a class="searchResult dismiss" data-id="' + e.id + '" data-code="' + e.code + '" data-price="' + e.price + '" data-sku="' + e.sku + '">' + e.name + '</a>';
                        });
                        $('#searchBox').html(results);
                        $('#searchBox').prop('hidden', false);
                        if(e.key === "Escape"){
                            $('#searchBox').prop('hidden', true);
                        }
                    }else{
                        $('#searchBox').html('');
                        $('#searchBox').prop('hidden', true);
                    }
                },
                error: function(error){
                    console.log(error);
                }
            })
            
        });

        $(document).on('click', '.searchResult', function(){
            var product = $(this);
            var error = false;
            $.each($('#tbody').children(), function(){
                if(product.data('id') == $(this).attr('id')){
                    error = true;
                }
            });
            if(error == false){
                var row = '<tr id="' + product.data('id') + '">' +
                    '<td id="name">' + product.html() + '</td>' +
                    '<td id="code">' + product.data('code') + '</td>' +
                    '<td id="count">' +
                        '<input class="form-control quantity" type="number" type="number" name="quantity" value="1">' +
                    '</td>' +
                    '<td id="price">' + product.data('price') +'</td>' +
                    '<td id="total">' + product.data('price') +'</td>' +
                    '<td><button type="button" class="btn btn-danger btn-sm minus">-</button></td>' +
                '</tr>';
                $('#tbody').append(row);
                $('#productSearch').val('');
            }else{
                alert('duplicate input is not allowed!');
            }
        });

        $(document).on('click', '.minus', function(){
            $(this).parent().parent().remove();
        });

        $(document).on('change', '.quantity', function(){
            var quantity = $(this).val();
            var thisPrice = $(this).parent().next().html();
            var total = parseInt(quantity) * parseInt(thisPrice);
            var thisTotal = $(this).parent().next().next().html(total);
        })

        $(document).on('click', '#create', function(){
            $.each($('#tbody').children(), function(i, e){
                console.log(i);
                console.log(e);
            })
        })
        
        $(document).on('click', '.dismiss', function(){
            $('#searchBox').prop('hidden', true);
        });
    })  
</script>
@endsection