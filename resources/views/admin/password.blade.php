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
                                        <p id="correctPassword"></p>
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
        $('#cpass').on('keyup', function (){
            console.log($('#cpass').val());
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
                },
                method: 'post',
                url: '{{ route('checkPassword') }}',
                data: {
                    currentPassword : $('#cpass').val(),
                },
                success : function(response){
                    if(response == true){
                        alert('asd');
                        $('#correctPassword').html("Current Password match").css('color', 'green');
                    }else if(response == false){
                        $('#correctPassword').html("Current Password doesnot match").css('color', 'red');
                    }
                },
                error: function (){
                    // alert('error');
                }
            })
        })
    </script>
@endsection
