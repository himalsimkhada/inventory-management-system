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
                                    <h4 class="card-title">Mail Settings</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('admin.includes._message')
                                <form action="{{ route('mailSetting') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group col-sm-6">
                                        <label for="user_name">SMTP Username</label>
                                        <input type="text" class="form-control" id="user_name" name="mail_username" value="{{ env('MAIL_USERNAME')}}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="port">SMTP PORT</label>
                                        <input type="text" class="form-control" id="port" name="mail_port"value="{{ env('MAIL_PORT') }}">
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label for="password">SMTP Password</label>
                                        <input type="text" class="form-control" id="password" name="mail_password"
                                            value="{{ env('MAIL_PASSWORD') }}">
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label for="mail_enc">SMTP Protocol</label>
                                            <select name="mail_encryption" id="mail_enc" class="custom-select mb-3">
                                                <option selected>{{ env('MAIL_ENCRYPTION') }}</option>
                                                <option value="tls">TLS</option>
                                                <option value="ssl">SSL</option>
                                                <option value="null">None</option>
                                             </select>
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label for="email">SMTP Email</label>
                                        <input type="text" class="form-control" id="email" name="mail_host"
                                            value="{{ env('MAIL_HOST') }}">
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
