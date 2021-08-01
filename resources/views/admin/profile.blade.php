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
                                                <h4 class="card-title">Manage Your Profile</h4>
                                            </div>


                                        </div>

                                        <div class="card-body">

                                            @include('admin.includes._message')

                                            <form method="post" action="{{ route('profileUpdate', $admin->id) }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class=" row align-items-center">
                                                    <div class="form-group col-sm-6">
                                                        <label for="name" >Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}">
                                                    </div>

                                                    <div class="form-group col-sm-6">
                                                        <label for="email">E-Mail Address</label>
                                                        <input type="email" class="form-control" id="email" name="email" value="{{ $admin->email }}" disabled>
                                                    </div>

                                                    <div class="form-group col-sm-6">
                                                        <label for="phone" >Phone Number</label>
                                                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $admin->phone }}">
                                                    </div>

                                                    <div class="form-group col-sm-6">
                                                        <label for="address" >Address</label>
                                                        <input type="text" class="form-control" id="address" name="address" value="{{ $admin->address }}">
                                                    </div>

                                                    <div class="form-group col-sm-6">
                                                        <label for="image" >Image</label>
                                                        <input type="hidden" name="current_image" value="{{ $admin->image }}">
                                                        <div class="form-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="customFile" name="image" accept="image/*" onchange="readURL(this)">
                                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                                            </div>
                                                        </div>

                                                        <img src="{{ asset('public/uploads/profile/'.$admin->image) }}" id="one" width="100px">
                                                    </div>

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
        function readURL(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function (e){
                    $("#one").attr('src', e.target.result).width(100);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
