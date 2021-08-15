@php
$details = \App\Models\Details::where('id', '=', 1)->first();
@endphp

<div class="iq-sidebar  sidebar-default  ">
    <div class="iq-sidebar-logo d-flex align-items-end justify-content-between">
        <a href="{{ route('adminDashboard') }}" class="header-logo">
            <img src="{{ asset('public/backend/assets/images/' . $details->logo) }}"
                class="img-fluid rounded-normal light-logo" alt="logo">
            <img src="{{ asset('public/backend/assets/images/logo-dark.png') }}"
                class="img-fluid rounded-normal d-none sidebar-light-img" alt="logo">
            <span>{{ $details->name }}</span>
        </a>
        <div class="side-menu-bt-sidebar-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="text-light wrapper-menu" width="30" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>
    </div>
    <div class="data-scrollbar" data-scroll="1">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="side-menu">
                <li class="{{ Session::get('admin_page') == 'dashboard' ? 'active' : '' }} sidebar-layout">
                    <a href="{{ route('adminDashboard') }}" class="svg-icon">
                        <i class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </i>
                        <span class="ml-2">Dashboard</span>
                    </a>
                </li>
                <li class=" {{ Session::get('admin_page') == 'product' ? 'active' : '' }} sidebar-layout">
                    <a href="#product" class="collapsed svg-icon" data-toggle="collapse" aria-expanded="false">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                        </i>
                        <span class="ml-2">Product</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon iq-arrow-right arrow-active" width="15"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                    <ul id="product" class="submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li class=" {{ Session::get('admin_page') == 'category' ? 'active' : '' }} sidebar-layout">
                            <a href="{{ route('category.index') }}" class="svg-icon ">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                                        </path>
                                    </svg>
                                </i>
                                <span class="ml-2">Category</span>
                            </a>
                        </li>
                        <li class="sidebar-layout">
                            <a href="{{ route('product.index') }}" class="svg-icon ">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2}
                                            d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                    </svg>
                                </i>
                                <span class="ml-2">Product List</span>
                            </a>
                        </li>
                        <li class="sidebar-layout">
                            <a href="{{ route('product.add') }}" class="svg-icon ">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </i>
                                <span class="ml-2">Add Product</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-layout">
                    <a href="#app2" class="collapsed svg-icon" data-toggle="collapse" aria-expanded="false">
                        <i>
                            <svg class="svg-icon mr-0 text-secondary" id="h-03-p" width="20"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </i>
                        <span class="ml-2">Setting</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon iq-arrow-right arrow-active" width="15"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                    <ul id="app2" class="submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li class=" {{ Session::get('admin_page') == 'brand' ? 'active' : '' }} sidebar-layout">
                            <a href="{{ route('brand.index') }}" class="svg-icon ">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                                    </svg>
                                </i>
                                <span class="ml-2">Brand</span>
                            </a>
                        </li>
                        <li class=" {{ Session::get('admin_page') == 'unit' ? 'active' : '' }} sidebar-layout">
                            <a href="{{ route('unit.index') }}" class="svg-icon ">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                                    </svg>
                                </i>
                                <span class="ml-2">Unit</span>
                            </a>
                        </li>
                        <li class=" {{ Session::get('admin_page') == 'wareHouse' ? 'active' : '' }} sidebar-layout">
                            <a href="{{ route('wareHouse.index') }}" class="svg-icon ">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </i>
                                <span class="ml-2">Ware House</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div class="pt-5 pb-5"></div>
    </div>
</div>
