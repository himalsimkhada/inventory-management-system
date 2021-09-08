@extends('admin.includes.admin_design')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body" id="dropzone">
                <h5 class="font-weight-bold mb-3">Account Information</h5>
                <form class=" row g-3" method="post"
                    action="{{ request()->account ? route('account.update', [request()->account]) : route('account.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6 mb-3">
                        <label for="account_no" class="form-label font-weight-bold text-muted text-uppercase">Account
                            Number</label>
                        <input type="text" name="account_no" id="account_no" class="form-control"
                            value="{{ isset($account) ? $account->account_no : '' }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label font-weight-bold text-muted text-uppercase">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ isset($account) ? $account->name : '' }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="initial_balance"
                            class="form-label font-weight-bold text-muted text-uppercase">Initial Balance</label>
                        <input type="text" class="form-control" id="initial_balance" name="initial_balance"
                            value="{{ isset($account) ? $account->initial_balance : '' }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="note"
                            class="form-label font-weight-bold text-muted text-uppercase">Note</label>
                          <textarea class="form-control" name="note" id="note" rows="3">{{ isset($account) ? $account->note : '' }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary" id="submitForm">
                            @if (request()->account)
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
@endsection
