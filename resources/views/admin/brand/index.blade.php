@extends('admin.includes.admin_design')

@section('content')
    <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
        <div class="d-flex align-items-center justify-content-between">
            <h4 class="font-weight-bold">Brand</h4>
        </div>
        <div class="create-workform">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="modal-product-search d-flex">
                    <button type="button" id='add'
                        class="btn btn-primary position-relative d-flex align-items-center justify-content-between"
                        data-toggle="modal" data-target="#formModal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add New
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="formModal" class="modal fade" tabindex="-1" aria-labelledby="exampleModalCenteredScrollableTitle"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form enctype="multipart/form-data">
                    <div class="modal-body">
                        <div>
                            <div class="mb-3">
                                <input type="hidden" class="form-control" name="id" id="id">
                            </div>
                            <div class="mb-3">
                                <label for="branch_name" class="form-label">Branch Name</label>
                                <input type="text" class="form-control" name="branch_name" id="branch_name">
                            </div>
                            <div class="mb-3">
                                <label for="branch_code" class="form-label">Branch Code</label>
                                <input type="text" class="form-control" name="branch_code" id="branch_code">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label><br />
                                <div class="custom-control custom-switch custom-control-inline">
                                    <input type="hidden" name="status" value="0">
                                    <input type="checkbox" class="custom-control-input" id="status" name="status" value="1"
                                        checked="">
                                    <label class="custom-control-label" for="status"></label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="iq-edit-list-data">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Name</th>
                                                <th>Code</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>S. No.</th>
                                                <th>Name</th>
                                                <th>Code</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
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
        $(document).ready(function() {
                    $('#datatable').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('brand.get') }}",
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex'
                            },
                            {
                                data: 'brand_name',
                                name: 'brand_name'
                            },
                            {
                                data: 'brand_code',
                                name: 'brand_code'
                            },
                            {
                                data: 'image',
                                name: 'image'
                            },
                            {
                                data: 'status',
                                name: 'status'
                            },
                            {
                                data: 'action',
                                name: 'action'
                            },
                        ],
                    });
                })
    </script>
@endsection