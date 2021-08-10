@extends('admin.includes.admin_design')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="d-flex align-items-center justify-content-between">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0 mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('product.view') }}">Products</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                        </ol>
                    </nav>
                </div>
                <a href="{{ route('product.view') }}" class="btn btn-primary btn-sm d-flex align-items-center justify-content-between ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-2">Back</span>
                </a>
            </div>
        </div>
        <div class="col-lg-12 mb-3 d-flex justify-content-between">
            <h4 class="font-weight-bold d-flex align-items-center">New Product</h4>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="font-weight-bold mb-3">Basic Information</h5>
                    <form class="row g-3">
                        <div class="col-md-6 mb-3">
                            <label for="Text1" class="form-label font-weight-bold text-muted text-uppercase">Product Name</label>
                            <input type="text" class="form-control" id="Text1" placeholder="Enter Product Name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="inputState" class="form-label font-weight-bold text-muted text-uppercase">Category</label>
                            <select id="inputState" class="form-select form-control choicesjs">
                                <option value="selected">Select Category</option>
                                <option value="Electronics">Electronics</option>
                                <option value="Applications">Applications</option>
                                <option value="Gadgets">Gadgets</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="Text2" class="form-label font-weight-bold text-muted text-uppercase">Product Code</label>
                            <input type="text" class="form-control" id="Text2" placeholder="Enter Product Code">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="Text3" class="form-label font-weight-bold text-muted text-uppercase">Product Sku</label>
                            <input type="text" class="form-control" id="Text3" placeholder="Enter Product SKU">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="Text4" class="form-label font-weight-bold text-muted text-uppercase">manufacturer</label>
                            <input type="text" class="form-control" id="Text4" placeholder="Enter Manufacturer">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="Text5" class="form-label font-weight-bold text-muted text-uppercase">Quantity</label>
                            <input type="text" class="form-control" id="Text5" placeholder="Enter Quantity">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="Text6" class="form-label font-weight-bold text-muted text-uppercase">Price</label>
                            <input type="text" class="form-control" id="Text6" placeholder="Enter Price">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="Text7" class="form-label font-weight-bold text-muted text-uppercase">Tax</label>
                            <input type="text" class="form-control" id="Text7" placeholder="Enter Tax">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="Text9" class="form-label font-weight-bold text-muted text-uppercase">Description</label>
                            <textarea class="form-control" id="Text9" rows="2" placeholder="Enter Description"></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


