@extends('admin.includes.admin_design')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="iq-edit-list-data">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Add Category</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('admin.includes._message')
                            <form action="{{ route('categoryCreate') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group col-sm-6">
                                    <label for="user_name">Category Name</label>
                                    <input type="text" class="form-control" id="user_name" name="category_name" value="">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="port">Category Code</label>
                                    <input type="text" class="form-control" id="port" name="category_code" value="">
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="mail_enc">Status</label>
                                        <select name="category_status" id="mail_enc" class="custom-select mb-3">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                         </select>
                                </div>

                                <button type="reset" class="btn btn-outline-primary mr-2">Cancel</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection