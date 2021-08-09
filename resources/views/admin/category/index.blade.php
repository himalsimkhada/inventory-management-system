@extends('admin.includes.admin_design')

@section('content')

    <div class="col-lg-12">
        <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="font-weight-bold">All Categories</h4>
            </div>
            <div class="create-workform">
                <div class="d-flex flex-wrap align-items-center justify-content-between">
                    <div class="modal-product-search d-flex">
                        <a href="product-add.html" class="btn btn-primary position-relative d-flex align-items-center justify-content-between">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Add Category
                        </a>
                    </div>
                </div>
            </div>
        </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable-1" class="table data-table table-striped table-bordered" >
                                        <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>Category Name</th>
                                            <th>Category Code</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

    @endsection
