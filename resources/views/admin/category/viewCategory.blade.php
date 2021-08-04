@extends('admin.includes.admin_design')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="iq-edit-list-data">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                        <div class="col-lg-12">
                            <div class="d-flex flex-wrap align-items-center justify-content-between my-schedule mb-4">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h4 class="font-weight-bold">Categories</h4>
                                </div>
                                <div class="create-workform">
                                    <div class="d-flex flex-wrap align-items-center justify-content-between">
                                        <div class="modal-product-search d-flex">
                                            <form class="mr-3 position-relative">
                                                <div class="form-group mb-0">
                                                    <input type="text" class="form-control" id="exampleInputText"
                                                        placeholder="Search Product">
                                                    <a class="search-link" href="product.html#">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="" width="20"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </form>
                                            <a href="{{ route('categoryCreate') }}"
                                                class="btn btn-primary position-relative d-flex align-items-center justify-content-between">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="20" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                                </svg>
                                                Add Categories
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container">
                                <div class="row" style="margin-top: 45px">
                                    <div class="col-md-8">
                      
                                      <input type="text" name="searchfor" id="" class="form-control">
                                          <div class="card">
                                              <div class="card-header">Countries</div>
                                              <div class="card-body">
                                                  <table class="table table-hover table-condensed" id="categories-table">
                                                      <thead>
                                                          <th>#</th>
                                                          <th>Category Name</th>
                                                          <th>Category Code</th>
                                                          <th>Slug</th>
                                                          <th>Status</th>
                                                          {{-- <th>Actions <button class="btn btn-sm btn-danger d-none" id="deleteAllBtn">Delete All</button></th> --}}
                                                      </thead>
                                                      <tfoot>
                                                        <th>#</th>
                                                        <th>Category Name</th>
                                                        <th>Category Code</th>
                                                        <th>Slug</th>
                                                        <th>Status</th>
                                                      </tfoot>
                                                  </table>
                                              </div>
                                          </div>
                                    </div>
                                    {{-- <div class="col-md-4">
                                          <div class="card">
                                              <div class="card-header">Add new Country</div>
                                              <div class="card-body">
                                                  <form action="" method="post" id="add-country-form" autocomplete="off">
                                                      @csrf
                                                      <div class="form-group">
                                                          <label for="">Country name</label>
                                                          <input type="text" class="form-control" name="country_name" placeholder="Enter country name">
                                                          <span class="text-danger error-text country_name_error"></span>
                                                      </div>
                                                      <div class="form-group">
                                                          <label for="">Capital city</label>
                                                          <input type="text" class="form-control" name="capital_city" placeholder="Enter capital city">
                                                          <span class="text-danger error-text capital_city_error"></span>
                                                      </div>
                                                      <div class="form-group">
                                                          <button type="submit" class="btn btn-block btn-success">SAVE</button>
                                                      </div>
                                                  </form>
                                              </div>
                                          </div>
                                    </div> --}}
                                </div>
                      
                          </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <script>
            // get all countries
            $('#categories-table').DataTable({
                processing:true,
                info:true,
                serverSide: true,
                ajax:"{{ route('get.categories.list') }}",
                columns:[
                    {data:'DT_RowIndex', name:'DT_RowIndex' },
                    {data:'category_name', name:'cateory_name'},
                    {data:'category_code', name:'category_code'},
                    {data:'status', name:'status'},
                    {data:'slug', name:'slug'},

                ]
            })
        </script>
    @endsection
    
