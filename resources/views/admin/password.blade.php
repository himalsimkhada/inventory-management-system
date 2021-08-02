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
                                @include('admin.includes._message')
                                <form method="post" action="{{ route('changePassword') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="cpass">Current Password:</label>
                                        <input type="Password" class="form-control" id="cpass" name="cpass" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="npass">New Password:</label>
                                        <input type="Password" class="form-control" id="npass" name="npass" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="vpass">Verify Password:</label>
                                        <input type="Password" class="form-control" id="vpass" name="vpass" value="">
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

@section('js')
    <script>
        $('#cpass').on('change', function (){
            $.ajax({
                method: 'post',
                url: '/checkPassword',
                data: {
                    _token: $("#csrf").val(),
                    
                }
            })
        })
    </script>
@endsection
