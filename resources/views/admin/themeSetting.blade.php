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
                                    <h4 class="card-title">Theme Settings</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('admin.includes._message')
                                <form action="{{ route('themeSetting') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group col-sm-6">
                                        <label for="brand_name">Company Name</label>
                                        <input type="text" class="form-control" id="brand_name" name="company_name"
                                            value="{{ $details->name }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="image">Fav Icon:</label>
                                        <input type="hidden" name="current_fav" value="">
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile" name="fav_icon"
                                                    accept="image/png" onchange="readICO(this)">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                        <img src="{{ asset('public/backend/assets/images/' . $details->fav_icon) }}"
                                            id="fav_ico" width="100px">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="image">Logo:</label>
                                        <input type="hidden" name="current_logo" value="">
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="customFile" name="logo"
                                                    accept="image/*" onchange="readLogo(this)">
                                                <label class="custom-file-label" for="customFile">Choose a logo</label>
                                            </div>
                                        </div>
                                        <img src="{{ asset('public/backend/assets/images/' . $details->logo) }}"
                                            id="com_logo" width="100px">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
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
        function readICO(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#fav_ico").attr('src', e.target.result).width(100);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function readLogo(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $("#com_logo").attr('src', e.target.result).width(100);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
