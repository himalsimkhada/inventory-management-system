@extends('admin.includes.admin_design')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="d-flex align-items-center justify-content-between">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0 mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Products</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Product</li>
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
            <h4 class="font-weight-bold d-flex align-items-center">New Product</h4>
        </div>
        @include('admin.includes._message')
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" id="dropzone">
                    <h5 class="font-weight-bold mb-3">Product Information</h5>
                    <form class=" row g-3" method="post" action="{{ route('product.store') }}"
                        enctype="multipart/form-data">
                        {{-- @csrf --}}
                        <input type="hidden" id="id" name="id" value="{{ isset($editData) ? $editData->id : '' }}">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label font-weight-bold text-muted text-uppercase">Product
                                Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ isset($editData) ? $editData->name : '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="code" class="form-label font-weight-bold text-muted text-uppercase">Product
                                Code</label>
                            <input type="text" class="form-control" id="code" name="code"
                                value="{{ isset($editData) ? $editData->code : '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category"
                                class="form-label font-weight-bold text-muted text-uppercase">Category</label>
                            <select id="category" class="form-select form-control choicesjs" name="category_id">
                                <option selected value="">Select Category</option>
                                @foreach ($category as $value)
                                    <option value="{{ $value->id }}"
                                        {{ isset($editData) ? ($editData->category_id == $value->id ? 'selected' : '') : '' }}>
                                        {{ $value->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="brand" class="form-label font-weight-bold text-muted text-uppercase">Brand</label>
                            <select id="brand" class="form-select form-control choicesjs" name="brand_id">
                                <option selected value="">Select Brand</option>
                                @foreach ($brand as $value)
                                    <option value="{{ $value->id }}"
                                        {{ isset($editData) ? ($editData->brand_id == $value->id ? 'selected' : '') : '' }}>
                                        {{ $value->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="unit" class="form-label font-weight-bold text-muted text-uppercase">Unit</label>
                            <select id="unit" class="form-select form-control choicesjs" name="unit_id">
                                <option value="">Select Unit</option>
                                @foreach ($unit as $value)
                                    <option value="{{ $value->id }}"
                                        {{ isset($editData) ? ($editData->unit_id == $value->id ? 'selected' : '') : '' }}>
                                        {{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tax" class="form-label font-weight-bold text-muted text-uppercase">Tax</label>
                            <select id="tax" class="form-select form-control choicesjs" name="tax_id">
                                <option selected value="">Select Tax</option>
                                @foreach ($tax as $value)
                                    <option value="{{ $value->id }}"
                                        {{ isset($editData) ? ($editData->tax_type_id == $value->id ? 'selected' : '') : '' }}>
                                        {{ $value->type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="price" class="form-label font-weight-bold text-muted text-uppercase">Price</label>
                            <input type="text" name="price" class="form-control onlyNumber" id="price"
                                value="{{ isset($editData) ? $editData->price : '' }}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="image" class="form-label font-weight-bold text-muted text-uppercase">Image</label>
                            <div class="dropzone border" id="image"></div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="description"
                                class="form-label font-weight-bold text-muted text-uppercase">Description</label>
                            <textarea class="form-control" id="description" row="3"
                                name="description">{{ isset($editData) ? $editData->description : '' }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="variant"
                                class="form-label font-weight-bold text-muted text-uppercase">Variant</label>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th><label class="form-label text-muted text-uppercase">Size</label></th>
                                        <th><label class="form-label text-muted text-uppercase">Color</label></th>
                                        <th><label class="form-label text-muted text-uppercase">Quantity</label></th>
                                        <th><label class="form-label text-muted text-uppercase">Price</label></th>
                                        <th><label class="form-label text-muted text-uppercase">Barcode</label></th>
                                        <th><button type="button" class="btn btn-success btn-sm mr-2 addAttr">+</button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="attrBody">
                                    @if (isset($variant) && !empty($variant))
                                        @foreach ($variant as $value)
                                            <tr>
                                                <td><input type="hidden" name="attrId[]" value={{ $value->id }}><input
                                                        type="text" class="form-control size" name="size[]"
                                                        value={{ $value->size }}></td>
                                                <td><input type="text" class="form-control color" name="color[]"
                                                        value={{ $value->color }}></td>
                                                <td><input type="text" class="form-control quantity" name="quantity[]"
                                                        value={{ $value->quantity }}></td>
                                                <td><input type="text" class="form-control price" name="additionalPrice[]"
                                                        value={{ $value->additional_price }}></td>
                                                <td><img src="{{ $value->barcode }}"></td>
                                                <td><button type="button" id="{{ $value->id }}"
                                                        class="btn btn-danger btn-sm mr-2 removeAttr">-</button></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td><input type="hidden" name="attrId[]"><input type="text"
                                                    class="form-control size" name="size[]"></td>
                                            <td><input type="text" class="form-control color" name="color[]"></td>
                                            <td><input type="text" class="form-control quantity" name="quantity[]"></td>
                                            <td><input type="text" class="form-control price" name="additionalPrice[]"></td>
                                            <td><button type="button"
                                                    class="btn btn-danger btn-sm mr-2 removeAttr">-</button></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary" id="submitForm">
                                @if (request()->id)
                                    Edit Product
                                @else
                                    Create Product
                                @endif
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection