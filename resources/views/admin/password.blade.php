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
                                    <h4 class="card-title">Change Password</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="form-group">
                                        <label for="cpass">Current Password:</label>
                                        <a href="javascripe:void();" class="float-right">Forgot Password</a>
                                        <input type="Password" class="form-control" id="cpass" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="npass">New Password:</label>
                                        <input type="Password" class="form-control" id="npass" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="vpass">Verify Password:</label>
                                        <input type="Password" class="form-control" id="vpass" value="">
                                    </div>
                                    <button type="reset" class="btn btn-outline-primary mr-2">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
