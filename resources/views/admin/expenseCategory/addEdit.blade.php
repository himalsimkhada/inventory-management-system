@extends('admin.includes.admin_design')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="d-flex align-items-center justify-content-between">
                </div>
                <a href="{{ route('expense.index') }}"
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
        @include('admin.includes._message')
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" id="dropzone">
                    <h5 class="font-weight-bold mb-3">Expense Category Information</h5>
                    <form class=" row g-3" method="post"
                        action="{{ request()->expense_category ? route('expense_category.update', [request()->expense_category]) : route('expense_category.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @if (request()->expense_category)
                            @method('PUT')
                        @endif
                        <div class="col-md-12">
                            <label for="code" class="form-label font-weight-bold text-muted text-uppercase">Code</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="code" id="code"
                                    aria-describedby="basic-addon2" value="{{ isset($category) ? $category->code : '' }}">
                                @if (!request()->expense_category)
                                    <div class=" input-group-append">
                                        <button type="button" class="input-group-text" id="generate_code">Generate</button>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="Name" class="form-label font-weight-bold text-muted text-uppercase">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ isset($category) ? $category->name : '' }}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary" id="submitForm">
                                @if (request()->expense_category)
                                    Edit
                                @else
                                    Add
                                @endif
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
        $('#generate_code').on('click', function() {
            random_code = Math.floor(100000 + Math.random() * 900000);
            $('#code').val(random_code);
        })
    </script>
@endsection
