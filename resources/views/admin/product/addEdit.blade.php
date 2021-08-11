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
                <a href="{{ route('product.index') }}" class="btn btn-primary btn-sm d-flex align-items-center justify-content-between ml-2">
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
                    <form class="row g-3" method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="text" id="id" name="id" value="{{ isset($editData) }}">
                        <div class="col-md-6 mb-3">
                            <label for="product_name" class="form-label font-weight-bold text-muted text-uppercase">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="product_code" class="form-label font-weight-bold text-muted text-uppercase">Product Code</label>
                            <input type="text" class="form-control" id="product_code" name="product_code">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label font-weight-bold text-muted text-uppercase">Category</label>
                            <select id="category" class="form-select form-control choicesjs" name="category_id">
                                <option value="selected">Select Category</option>
                                @foreach($category as $value)
                                    <option value="{{ $value->id }}">{{ $value->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="brand" class="form-label font-weight-bold text-muted text-uppercase">Brand</label>
                            <select id="brand" class="form-select form-control choicesjs" name="brand_id">
                                <option value="selected">Select Brand</option>
                                @foreach($brand as $value)
                                    <option value="{{ $value->id }}">{{ $value->brand_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="unit" class="form-label font-weight-bold text-muted text-uppercase">Unit</label>
                            <select id="unit" class="form-select form-control choicesjs" name="unit_id">
                                <option value="">Select Unit</option>
                                @foreach($unit as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tax" class="form-label font-weight-bold text-muted text-uppercase">Tax</label>
                            <select id="tax" class="form-select form-control choicesjs" name="tax_id">
                                <option value="selected">Select Tax</option>
                                @foreach($tax as $value)
                                    <option value="{{ $value->id }}">{{ $value->type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="image" class="form-label font-weight-bold text-muted text-uppercase">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image" value="">
                                <label class="custom-file-label" for="image">Choose Image</label>
                            </div>
                        </div>
                        <div class="col-md-3 mb3">
                            <div class="card">
                                <img id="selectedImage" src="{{ asset('public/uploads/no-image.jpg') }}"
                                     class="img-fluid rounded" alt="#">
                            </div>
                        </div>
                        <div class="col-md-3 mb3">
                            <div id="removeDiv" class="card" hidden="hidden">
                                <button type="button" class="btn btn-danger" id="removeImage">Remove Image</button>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label font-weight-bold text-muted text-uppercase">Description</label>
                            <textarea class="form-control" id="description" rows="2" name="description"></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary">
                                Create Product
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
            $("#image").on('change', function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#selectedImage').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                }
                $('#removeDiv').prop('hidden', false);
            });

            $('#removeImage').on('click', function() {
                $('#image').val('');
                $('#image').next().text('Choose Image');
                $('#selectedImage').attr('src', '{{ asset('public/uploads/no-image.jpg') }}');
                $('#removeDiv').prop('hidden', true);
            });
        })
    </script>
@endsection


