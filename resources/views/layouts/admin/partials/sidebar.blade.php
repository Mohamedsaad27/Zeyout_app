<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-simplebar>
        <div class="d-flex mb-4 align-items-center justify-content-between">
            <a href="index.html" class="text-nowrap logo-img ms-0 ms-md-1">
                <img src="../assets/images/logos/dark-logo.svg" width="180" alt="">
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="mb-4 pb-2">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-5"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link primary-hover-bg {{ request()->routeIs('dashboard.index') ? 'active' : '' }}"
                        href="{{ route('dashboard.index') }}" aria-expanded="false">
                        <span class="aside-icon p-2 bg-light-primary rounded-3">
                            <i class="ti ti-layout-dashboard fs-7 text-primary"></i>
                        </span>
                        <span class="hide-menu ms-2 ps-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-5"></i>
                    <span class="hide-menu">Control</span>
                </li>
            

                <li class="sidebar-item">
                    <a class="dropdown-toggle justify-content-between pe-4 sidebar-link sidebar-link primary-hover-bg {{ request()->routeIs('categories.*') ? 'primary-bg' : '' }}"
                        data-bs-toggle="collapse" data-bs-target="#employeeSubmenu" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="aside-icon p-2 bg-light-primary rounded-3">
                                <i class="ti ti-category fs-7 text-warning"></i>
                            </span>
                            <span class="hide-menu ms-2 ps-1">Categories</span>
                        </div>
                    </a>
                    <ul class="submenu collapse list-unstyled ms-21 me-5" id="employeeSubmenu">
                        <li class="py-2 mb-1">
                            <a class="text-dark p-2" href="{{ route('categories.create') }}">Add Category</a>
                        </li>
                        <li class="py-2 mb-1">
                            <a class="text-dark p-2" href="{{ route('categories.index') }}">Category List</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="dropdown-toggle justify-content-between pe-4 sidebar-link sidebar-link primary-hover-bg {{ request()->routeIs('products.*') ? 'primary-bg' : '' }}"
                        data-bs-toggle="collapse" data-bs-target="#patientsSubmenu" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="aside-icon p-2 bg-light-primary rounded-3">
                                <i class="ti ti-shopping-cart fs-7 text-warning"></i>
                            </span>
                            <span class="hide-menu ms-2 ps-1">Products</span>
                        </div>
                    </a>
                    <ul class="submenu collapse list-unstyled ms-21 me-5" id="patientsSubmenu">
                        <li class="py-2 mb-1">
                            <a class="text-dark p-2" href="{{ route('products.create') }}">Add Product</a>
                        </li>
                        <li class="py-2 mb-1">
                            <a class="text-dark p-2" href="{{ route('products.index') }}">Product List</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item">
                    <a class="dropdown-toggle justify-content-between pe-4 sidebar-link sidebar-link primary-hover-bg {{ request()->routeIs('brands.*') ? 'primary-bg' : '' }}"
                        data-bs-toggle="collapse" data-bs-target="#brandsSubmenu" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="aside-icon p-2 bg-light-primary rounded-3">
                                <i class="ti ti-building-store fs-7 text-warning"></i>
                            </span>
                            <span class="hide-menu ms-2 ps-1">Brands</span>
                        </div>
                    </a>
                    <ul class="submenu collapse list-unstyled ms-21 me-5" id="brandsSubmenu">
                        <li class="py-2 mb-1">
                            <a class="text-dark p-2" href="{{ route('brands.create') }}">Add Brand</a>
                        </li>
                        <li class="py-2 mb-1">
                            <a class="text-dark p-2" href="{{ route('brands.index') }}">Brand List</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="dropdown-toggle justify-content-between pe-4 sidebar-link sidebar-link primary-hover-bg {{ request()->routeIs('users.*') ? 'primary-bg' : '' }}"
                        data-bs-toggle="collapse" data-bs-target="#usersSubmenu" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="aside-icon p-2 bg-light-primary rounded-3">
                                <i class="ti ti-users fs-7 text-warning"></i>
                            </span>
                            <span class="hide-menu ms-2 ps-1">Traders</span>
                        </div>
                    </a>
                    <ul class="submenu collapse list-unstyled ms-21 me-5" id="usersSubmenu">
                        <li class="py-2 mb-1">
                            <a class="text-dark p-2" href="{{ route('traders.create') }}">Add Trader</a>
                        </li>
                        <li class="py-2 mb-1">
                            <a class="text-dark p-2" href="{{ route('traders.index') }}">Trader List</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="dropdown-toggle justify-content-between pe-4 sidebar-link sidebar-link primary-hover-bg {{ request()->routeIs('banners.*') ? 'primary-bg' : '' }}"
                        data-bs-toggle="collapse" data-bs-target="#bannersSubmenu" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="aside-icon p-2 bg-light-primary rounded-3">
                                <i class="ti ti-flag fs-7 text-warning"></i>
                            </span>
                            <span class="hide-menu ms-2 ps-1">Banners</span>
                        </div>
                    </a>
                    <ul class="submenu collapse list-unstyled ms-21 me-5" id="bannersSubmenu">
                        <li class="py-2 mb-1">
                            <a class="text-dark p-2" href="{{ route('banners.create') }}">Add Banner</a>
                        </li>
                        <li class="py-2 mb-1">
                            <a class="text-dark p-2" href="{{ route('banners.index') }}">Banner List</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="dropdown-toggle justify-content-between pe-4 sidebar-link sidebar-link primary-hover-bg {{ request()->routeIs('governates.*') ? 'primary-bg' : '' }}"
                        data-bs-toggle="collapse" data-bs-target="#governatesSubmenu" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <span class="aside-icon p-2 bg-light-primary rounded-3">
                                <i class="ti ti-map fs-7 text-warning"></i>
                            </span>
                            <span class="hide-menu ms-2 ps-1">Governates</span>
                        </div>
                    </a>
                    <ul class="submenu collapse list-unstyled ms-21 me-5" id="governatesSubmenu">
                        <li class="py-2 mb-1">
                            <a class="text-dark p-2" href="{{ route('governates.create') }}">Add Governate</a>
                        </li>
                        <li class="py-2 mb-1">
                            <a class="text-dark p-2" href="{{ route('governates.index') }}">Governate List</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
