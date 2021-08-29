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
            <h4 class="font-weight-bold d-flex align-items-center">
                @if (request()->id)
                    Update Product
                @else
                    New Product
                @endif
            </h4>
        </div>
        @include('admin.includes._message')
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" id="dropzone">
                    <h5 class="font-weight-bold mb-3">Customer Information</h5>
                    <form class=" row g-3" method="post" action="{{ route('product.store') }}"
                        enctype="multipart/form-data">
                        {{-- @csrf --}}
                        <input type="hidden" id="id" name="id" value="">
                        <div class="col-md-6 mb-3">
                            <label for="fname" class="form-label font-weight-bold text-muted text-uppercase">First Name</label>
                            <input type="text" class="form-control" id="fname" name="fname"
                                value="">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lname" class="form-label font-weight-bold text-muted text-uppercase">Last Name</label>
                            <input type="text" class="form-control" id="lname" name="lname"
                                value="">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone_number" class="form-label font-weight-bold text-muted text-uppercase">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                value="">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label font-weight-bold text-muted text-uppercase">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="group"
                                class="form-label font-weight-bold text-muted text-uppercase">Group</label>
                            <select id="group" class="form-select form-control choicesjs" name="group">
                                <option selected value="" disabled>Select Group</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary" id="submitForm">
                                @if (request()->id)
                                    Update Product
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
