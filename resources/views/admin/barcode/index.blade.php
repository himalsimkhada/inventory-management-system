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

        .searchResult a{
            text-decoration: none;
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
                    <form class=" row g-3" method="post" action="{{ route('product.store') }}"
                        enctype="multipart/form-data">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label font-weight-bold text-muted text-uppercase">Product Name</label>
                            <input type="text" id="productSearch" class="form-control searchBox" name="name" autocomplete="off" >
                            <div class="col-md-12 searchBox" id="searchBox">
                                <div class="col-lg-12">
                                    <a type="button" class="close qwe">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>
                                <a class="dropdown-item qwe" href="#">asdasdasdasdasdasdasdasdasdasd asd asd asd asd as das das das das das das das das das dasd asd as dasd asd as dasd asd as das dasdasd link</a>
                                <a class="searchResult qwe" href="#">Dropasdasdasdasdasddown link</a>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary" id="submitForm">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $(document).on('keyup', '#productSearch', function(){
            $('#searchResult').prop('hidden', false);

        });
        
        $(document).on('click', '.qwe', function(){
            console.log('qwe class clicked');
            $('#searchResult').prop('hidden', true);
        });

        console.log($('.qwe'));
    })  
</script>
@endsection