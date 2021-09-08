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
                    <h5 class="font-weight-bold mb-3">Expenses Information</h5>
                    <form class=" row g-3" method="post"
                        action="{{ request()->expense ? route('expense.update', [request()->expense]) : route('expense.store') }}">
                        @csrf
                        @if (request()->expense)
                            @method('PUT')
                        @endif
                        <div class="col-md-6 mb-3">
                            <label for="expense_category_id">Category ID</label>
                            <select id="expense_category_id" class="form-select form-control choicesjs"
                                name="expense_category_id">
                                @if (request()->expense)
                                    <option value="{{ isset($expense) ? $expense->expense_category_id : '' }}" selected>
                                        {{ isset($expense) ? $expense->expense_category->name : '' }}</option>
                                    @foreach ($categories as $val)
                                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                                    @endforeach
                                @else
                                    @foreach ($categories as $val)
                                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="warehouse_id">Warehouse</label>
                            <select id="warehouse_id" class="form-select form-control choicesjs" name="warehouse_id">
                                @if (request()->expense)
                                    <option value="{{ isset($expense) ? $expense->warehouse_id : '' }}" selected>
                                        {{ isset($expense) ? $expense->warehouse->name : '' }}</option>
                                    @foreach ($warehouse as $val)
                                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                                    @endforeach
                                @else
                                    @foreach ($warehouse as $val)
                                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="amount" class="form-label font-weight-bold text-muted text-uppercase">Amount</label>
                            <input type="text" class="form-control" id="amount" name="amount"
                                value="{{ isset($expense) ? $expense->amount : old('amount') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="account_id">Account</label>
                            <select id="account_id" class="form-select form-control choicesjs" name="account_id">
                                @if (request()->expense)
                                    <option value="{{ isset($expense) ? $expense->account_id : '' }}" selected>
                                        {{ isset($expense) ? $expense->account->name : '' }}</option>
                                    @foreach ($accounts as $val)
                                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                                    @endforeach
                                @else
                                    @foreach ($accounts as $val)
                                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="note" class="form-label font-weight-bold text-muted text-uppercase">Note</label>
                            <textarea class="form-control" name="note" id="note"
                                rows="3">{{ isset($expense) ? $expense->note : old('note') }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary" id="submitForm">
                                {{ request()->expense ? 'Edit' : 'Create' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
