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

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card card-block card-stretch">
                                        <div class="card-body p-0">
                                            <div class="d-flex justify-content-between align-items-center p-3">
                                                <h5 class="font-weight-bold">Products List</h5>
                                                <button class="btn btn-secondary btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-1" width="20"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                    </svg>
                                                    Export
                                                </button>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table data-table mb-0">
                                                    <thead class="table-color-heading">
                                                        <tr class="text-light">
                                                            <th scope="col">
                                                                <label class="text-muted m-0">Category Name</label>
                                                            </th>
                                                            <th scope="col">
                                                                <label class="text-muted mb-0">Category Code</label>
                                                            </th>
                                                            <th scope="col" class="text-right">
                                                                <label class="text-muted mb-0">Slug</label>
                                                            </th>
                                                            <th scope="col">
                                                                <label class="text-muted mb-0">Status</label>
                                                            </th>
                                                            <th scope="col" class="text-right">
                                                                <span class="text-muted">Action</span>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($categories as $category)
                                                            <tr class="table-data">
                                                                <td>{{ $category->category_name }}</td>
                                                                <td>{{ $category->category_code }}</td>
                                                                <td>{{ $category->slug }}</td>
                                                                <td>{{ $category->status }}</td>
                                                                <td>
                                                                    <div
                                                                        class="d-flex justify-content-end align-items-center">
                                                                        <a class="" data-toggle="tooltip"
                                                                            data-placement="top" title=""
                                                                            data-original-title="Edit" href="product.html#">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                class="text-secondary mx-4" width="20"
                                                                                fill="none" viewBox="0 0 24 24"
                                                                                stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                                            </svg>
                                                                        </a>
                                                                        <a class="badge bg-danger" data-toggle="tooltip"
                                                                            data-placement="top" title=""
                                                                            data-original-title="Delete"
                                                                            href="product.html#">
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="20" fill="none" viewBox="0 0 24 24"
                                                                                stroke="currentColor">
                                                                                <path stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                            </svg>
                                                                        </a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @empty
                                                            Not data
                                                        @endforelse
                                                    </tbody>
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
    
