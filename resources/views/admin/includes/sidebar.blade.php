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
                @if (Session::get('admin_page') == 'dashboard')
                    @php
                        $active = 'active';
                    @endphp
                @else
                    @php
                        $active = '';
                    @endphp
                @endif
                <li class="{{ $active }} sidebar-layout">
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
                @if (Session::get('admin_page') == 'category')
                    @php
                        $active = 'active';
                    @endphp
                @else
                    @php
                        $active = '';
                    @endphp
                @endif
                <li class=" {{ $active }} sidebar-layout">
                    <a href="{{ route('categoryView') }}" class="svg-icon ">
                        <i class="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                                </path>
                            </svg>
                        </i>
                        <span class="ml-2">Category</span>
                    </a>
                </li>
                @if (Session::get('admin_page') == 'brand')
                    @php
                        $active = 'active';
                    @endphp
                @else
                    @php
                        $active = '';
                    @endphp
                @endif
                <li class=" {{ $active }} sidebar-layout">
                    <a href="{{ route('brand.index') }}" class="svg-icon ">
                        <i class="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                                </path>
                            </svg>
                        </i>
                        <span class="ml-2">Brand</span>
                    </a>
                </li>
                @if (Session::get('admin_page') == 'unit')
                    @php
                        $active = 'active';
                    @endphp
                @else
                    @php
                        $active = '';
                    @endphp
                @endif
                <li class=" {{ $active }} sidebar-layout">
                    <a href="{{ route('unit.index') }}" class="svg-icon ">
                        <i class="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                                </path>
                            </svg>
                        </i>
                        <span class="ml-2">Unit</span>
                @if(Session::get('admin_page') == 'wareHouse')
                    @php
                        $active = "active"
                    @endphp
                @else
                    @php
                        $active = ""
                    @endphp
                @endif
                <li class=" {{ $active }} sidebar-layout">
                    <a href="{{ route('wareHouse.index') }}" class="svg-icon ">
                        <i class="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                        </i>
                        <span class="ml-2">Ware House</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="pt-5 pb-5"></div>
    </div>
</div>
