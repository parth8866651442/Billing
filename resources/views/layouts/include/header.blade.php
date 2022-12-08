<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg'); }}" type="image/x-icon" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css'); }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/lineicons.css'); }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css'); }}" />
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('plugins/toastr/toastr.min.css'); }}">
</head>

<body>
    <!-- ======== sidebar-nav start =========== -->
    <aside class="sidebar-nav-wrapper">
        <div class="navbar-logo">
            <a href="{{ url('/home') }}">
                <img src="{{ asset('assets/images/logo/logo.svg'); }}" alt="logo" />
            </a>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li class="nav-item {{ (request()->routeIs('home')) ? 'active' : '' }}">
                    <a href="{{route('home')}}">
                        <span class="icon">
                            <i class="lni lni-dashboard"></i>
                        </span>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item nav-item-has-children">
                    <a href="#0" data-bs-toggle="collapse" data-bs-target="#userMenu" aria-controls="userMenu"
                        aria-expanded="{{ (request()->routeIs('userList') || request()->routeIs('addUser')) ? true : false }}" aria-label="Toggle navigation" class="{{ (request()->routeIs('userList') || request()->routeIs('addUser')) ? '' : 'collapsed' }}">
                        <span class="icon">
                            <i class="lni lni-users"></i>
                        </span>
                        <span class="text">Users</span>
                    </a>
                    <!-- hide dropdown-nav collapse -->
                    <ul id="userMenu" class="collapse dropdown-nav {{ (request()->routeIs('userList') || request()->routeIs('addUser')) ? 'show' : 'hide' }}">
                      <li><a href="{{route('addUser')}}" class="{{ request()->routeIs('addUser') ? 'active' : '' }}"> Add user </a></li>
                        <li><a href="{{route('userList')}}" class="{{ request()->routeIs('userList') ? 'active' : '' }}"> users List </a></li>
                    </ul>
                </li>
                <li class="nav-item nav-item-has-children">
                    <a href="#0" data-bs-toggle="collapse" data-bs-target="#clientMenu" aria-controls="clientMenu"
                        aria-expanded="{{ (request()->routeIs('clientList') || request()->routeIs('addClient')) ? true : false }}" aria-label="Toggle navigation" class="{{ (request()->routeIs('clientList') || request()->routeIs('addClient')) ? '' : 'collapsed' }}">
                        <span class="icon">
                            <i class="lni lni-network"></i>
                        </span>
                        <span class="text">Clients</span>
                    </a>
                    <!-- hide dropdown-nav collapse -->
                    <ul id="clientMenu" class="collapse dropdown-nav {{ (request()->routeIs('clientList') || request()->routeIs('addClient')) ? 'show' : 'hide' }}">
                      <li><a href="{{route('addClient')}}" class="{{ request()->routeIs('addClient') ? 'active' : '' }}"> Add Client </a></li>
                        <li><a href="{{route('clientList')}}" class="{{ request()->routeIs('clientList') ? 'active' : '' }}"> Clients List </a></li>
                    </ul>
                </li>
                <li class="nav-item nav-item-has-children">
                    <a href="#0" data-bs-toggle="collapse" data-bs-target="#categoryMenu" aria-controls="categoryMenu"
                        aria-expanded="{{ (request()->routeIs('categoryList') || request()->routeIs('addCategory')) ? true : false }}" aria-label="Toggle navigation" class="{{ (request()->routeIs('categoryList') || request()->routeIs('addCategory')) ? '' : 'collapsed' }}">
                        <span class="icon">
                            <i class="lni lni-page-break"></i>
                        </span>
                        <span class="text">Category</span>
                    </a>
                    <!-- hide dropdown-nav collapse -->
                    <ul id="categoryMenu" class="collapse dropdown-nav {{ (request()->routeIs('categoryList') || request()->routeIs('addCategory')) ? 'show' : 'hide' }}">
                      <li><a href="{{route('addCategory')}}" class="{{ request()->routeIs('addCategory') ? 'active' : '' }}"> Add Category </a></li>
                        <li><a href="{{route('categoryList')}}" class="{{ request()->routeIs('categoryList') ? 'active' : '' }}"> Categories List </a></li>
                    </ul>
                </li>
                <li class="nav-item nav-item-has-children">
                    <a href="#0" data-bs-toggle="collapse" data-bs-target="#productMenu" aria-controls="productMenu"
                        aria-expanded="{{ (request()->routeIs('productList') || request()->routeIs('addProduct')) ? true : false }}" aria-label="Toggle navigation" class="{{ (request()->routeIs('productList') || request()->routeIs('addProduct')) ? '' : 'collapsed' }}">
                        <span class="icon">
                            <i class="lni lni-cart-full"></i>
                        </span>
                        <span class="text">Product</span>
                    </a>
                    <!-- hide dropdown-nav collapse -->
                    <ul id="productMenu" class="collapse dropdown-nav {{ (request()->routeIs('productList') || request()->routeIs('addProduct')) ? 'show' : 'hide' }}">
                        <li><a href="{{route('addProduct')}}" class="{{ request()->routeIs('addProduct') ? 'active' : '' }}"> Add Product </a></li>
                        <li><a href="{{route('productList')}}" class="{{ request()->routeIs('productList') ? 'active' : '' }}"> Products List </a></li>
                    </ul>
                </li>

                <li class="nav-item nav-item-has-children">
                    <a href="#0" data-bs-toggle="collapse" data-bs-target="#orderMenu" aria-controls="orderMenu"
                        aria-expanded="{{ (request()->routeIs('orderList') || request()->routeIs('addOrder')) ? true : false }}" aria-label="Toggle navigation" class="{{ (request()->routeIs('orderList') || request()->routeIs('addOrder')) ? '' : 'collapsed' }}">
                        <span class="icon">
                            <i class="lni lni-cart-full"></i>
                        </span>
                        <span class="text">Order</span>
                    </a>
                    <!-- hide dropdown-nav collapse -->
                    <ul id="orderMenu" class="collapse dropdown-nav {{ (request()->routeIs('orderList') || request()->routeIs('addOrder')) ? 'show' : 'hide' }}">
                        <li><a href="{{route('addOrder')}}" class="{{ request()->routeIs('addOrder') ? 'active' : '' }}"> Add Orders </a></li>
                        <li><a href="{{route('orderList')}}" class="{{ request()->routeIs('orderList') ? 'active' : '' }}"> Orders List </a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </aside>
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
        <!-- ========== header start ========== -->
        <header class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-6">
                        <div class="header-left d-flex align-items-center">
                            <div class="menu-toggle-btn mr-20">
                                <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                                    <i class="lni lni-chevron-left me-2"></i> Menu
                                </button>
                            </div>
                            <div class="header-search d-none">
                                <form action="#">
                                    <input type="text" placeholder="Search..." />
                                    <button><i class="lni lni-search-alt"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-6">
                        <div class="header-right">
                            <!-- profile start -->
                            <div class="profile-box ml-15">
                                <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="profile-info">
                                        <div class="info">
                                            <h6>{{ Auth::user()->name }}</h6>
                                            <div class="image">
                                                <img src="{{ imageUrl(auth()->user()->image, 'user','no_image.jpg','thumbnail') }}"
                                                    alt="" />
                                                <span class="status"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <i class="lni lni-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                                    <li>
                                        <a href="{{route('profile')}}"><i class="lni lni-user"></i> Profile</a>
                                    </li>
                                    <li>
                                        <a href="#0"> <i class="lni lni-cog"></i> Settings </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="lni lni-exit"></i> Sign Out </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <!-- profile end -->
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- ========== header end ========== -->