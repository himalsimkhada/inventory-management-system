@extends('admin.includes.admin_design')

@section('content')
<div class="col-lg-12">
    <div class="card">
        <div class="card-body" id="dropzone">
            <h5 class="font-weight-bold mb-3">Expense Category Information</h5>
            <form class=" row g-3" method="post" action="{{ request()->expense_category ? route('expense.update', [request()->expense_category]) : route('expense.store') }}"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="id" name="id" value="">
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label font-weight-bold text-muted text-uppercase">Code</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{ isset($category) ? $category->code : '' }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone_number" class="form-label font-weight-bold text-muted text-uppercase">Name</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                        value="{{ isset($category) ? $category->name : '' }}">
                </div>
                <div class="col-md-12 mb-3">
                    <button type="submit" class="btn btn-primary" id="submitForm">
                        @if (request()->id)
                            Edit Customer Detail
                        @else
                            Update Customer
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
