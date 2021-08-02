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
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li style="list-style: none;">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="card-body">
                                <form method="post" action="{{ route('changePassword') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="cpass">Current Password:</label>
                                        <a href="javascripe:void();" class="float-right">Forgot Password</a>
                                        <input type="Password" class="form-control" id="current_password" name="c_password" value="">
                                        <p id="correct_password"></p>
                                    </div>
                                    <div class="form-group">
                                        <label for="npass">New Password:</label>
                                        <input type="Password" class="form-control" id="npass" name="new_password" value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="vpass">Verify Password:</label>
                                        <input type="Password" class="form-control" id="vpass" name="password_con" value="">
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
        //  password check
        $("#current_password").keyup(function (){
            var current_password = $("#current_password").val();
            $.ajax({
                headers:{
                    'X-CSRF-Token' :$('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                url: '{{ route("checkUserPassword") }}',
                data: {
                    current_password:current_password
                },
                success: function(resp){
                    if(resp=="true"){
                    $("#correct_password").text("Current Password matches").css("color", "green");
                    }
                    else if(resp=="false") {
                        $("#correct_password").text("Current Password did not match").css("color", "red");
                    }
                },
                error:function (resp){
                    alert("Error");
                }

            });
        });
      
    </script>
@endsection
