@extends('admin.includes.admin_design')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            <div class="d-flex align-items-center justify-content-between">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('product.index') }}"
                class="btn btn-primary btn-sm d-flex align-items-center justify-content-between ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                        clip-rule="evenodd" />
                </svg>
                <span class="ml-2">Back</span>
            </a>
        </div>
    </div>
    <div class="col-lg-12 mb-3 d-flex justify-content-between">
        <h4 class="font-weight-bold d-flex align-items-center">Product Detail</h4>
    </div>
    @include('admin.includes._message')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-5 col-lg-5">
                        <div class="card-body">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators" id="indicators">
                                    @foreach($detail['image'] as $key => $value)
                                        @php $active = ($key == 0) ? 'active' : '';@endphp
                                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $key }}" class="{{ $active }}"></li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner" id="carouselItem">
                                    @foreach($detail['image'] as $key => $value)
                                        @php $active = ($key == 0) ? 'active' : '';@endphp
                                        <div class="carousel-item {{ $active }}">
                                            <img src="{{ asset("public/uploads/product") }}/{{ $value->image }}" class="d-block w-100" alt="{{ $value->image }}">
                                        </div>
                                    @endforeach
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
                                    <td id="productName">{{ $detail['product']->name }}</td>
                                </tr>
                                <tr>
                                    <th>Product Code</th>
                                    <td id="productCode">{{ $detail['product']->code }}</td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td id="productCategory">{{ $detail['product']->name }}</td>
                                </tr>
                                <tr>
                                    <th>Brand</th>
                                    <td id="productBrand">{{ $detail['product']->name }}</td>
                                </tr>
                                <tr>
                                    <th>Unit</th>
                                    <td id="productUnit">{{ $detail['product']->name }}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td id="productPrice">{{ $detail['product']->price }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td id="productDescription">{{ strip_tags($detail['product']->description) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <table class="table table-borderless">
                            <tr><th>Description</th></tr>
                            <tr><td>{{ strip_tags($detail['product']->description) }}</td></tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-lg-12">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Size</th>
                                    <th>Color</th>
                                    <th>Quantity</th>
                                    <th>Additional Price</th>
                                    <th>Barcode</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detail['variant'] as $value)
                                <tr>
                                    <td>{{ $value->size }}</td>
                                    <td>{{ $value->color }}</td>
                                    <td>{{ $value->quantity }}</td>
                                    <td>{{ $value->additional_price }}</td>
                                    <td><img src="{{ $value->barcode }}"></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection