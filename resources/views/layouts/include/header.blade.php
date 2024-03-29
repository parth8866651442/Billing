<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toatr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <!-- <link rel="stylesheet" href="{{ asset('assets/plugins/icons/feather/feather.css') }}" /> -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css'); }}" />
    @stack('style')

    <style>
    .page-header .breadcrumb {
        float: left;
    }

    .page-header .btn-back {
        float: right;
    }
    i.fa.fa-calendar.glyphicon.glyphicon-calendar{
        display: none;
    }
    .form-group .error{
        color: red;
        margin-top: 5px;
    }
    .form-group .asterisk{
        color: red;
    }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <div class="header header-one">
            <div class="header-left header-left-one">
                <a href="{{ url('/home') }}" class="logo"><img src="{{ asset('assets/img/logo.png') }}" alt="Logo"></a>
                <a href="{{ url('/home') }}" class="white-logo"><img src="{{ asset('assets/img/logo-white.png') }}"
                        alt="Logo"></a>
                <a href="{{ url('/home') }}" class="logo logo-small"><img src="{{ asset('assets/img/logo-small.png') }}"
                        alt="Logo" width="30" height="30"></a>
            </div>

            <a href="javascript:void(0);" id="toggle_btn">
                <i class="fas fa-bars"></i>
            </a>

            <div class="top-nav-search">
                <form>
                    <input type="text" class="form-control" placeholder="Search here" />
                    <button class="btn" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <a class="mobile_btn" id="mobile_btn">
                <i class="fas fa-bars"></i>
            </a>

            <ul class="nav nav-tabs user-menu">
                <li class="nav-item">
                    <button type="button" class="btn btn-white text-info mt-2" onClick="ReceivePayment();"><i class="fas fa-credit-card me-1"></i>Receive Payment</button>
                </li>
                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            <img src="{{ imageUrl(auth()->user()->image, 'user','no_image.jpg','thumbnail') }}"
                                alt="" />
                            <span class="status online"></span>
                        </span>
                        <span>{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('profile')}}"><i data-feather="user" class="me-1"></i>
                            Profile</a>
                        <a class="dropdown-item" href="{{route('settingForm')}}"><i data-feather="settings" class="me-1"></i> Settings</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                data-feather="log-out" class="me-1"></i> Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>

        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title"><span>Main</span></li>
                        <li class="{{ (request()->routeIs('home')) ? 'active' : '' }}">
                            <a href="{{route('home')}}"><i class="fas fa-home"></i> <span>Dashboard</span></a>
                        </li>

                        <!-- Users -->
                        @if(Helper::check_user_assess('view',USER_MODULE))
                        <li class="submenu {{ (request()->routeIs('userList') || request()->routeIs('addUser')) ? 'active' : '' }}">
                            <a href="{{route('userList')}}"
                                class="{{ (request()->routeIs('userList') || request()->routeIs('addUser')) ? 'active' : '' }}"><i
                                    class="fa fa-users"></i><span>Users</span><span class="menu-arrow"></span></a>
                            <ul>
                                @if(Helper::check_user_assess('add',USER_MODULE))
                                <li><a href="{{route('addUser')}}" class="{{ (request()->routeIs('addUser')) ? 'active' : '' }}">Add Users</a></li>
                                @endif
                                <li><a href="{{route('userList')}}" class="{{ (request()->routeIs('userList')) ? 'active' : '' }}">Users List</a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        <!-- Clients -->
                        @if(Helper::check_user_assess('view',CLIENTS_MODULE))
                        <li class="submenu {{ (request()->routeIs('clientList') || request()->routeIs('addClient')) ? 'active' : '' }}">
                            <a href="{{route('clientList')}}"
                                class="{{ (request()->routeIs('clientList') || request()->routeIs('addClient')) ? 'active' : '' }}"><i class="fas fa-user-secret"></i><span>Clients</span><span class="menu-arrow"></span></a>
                            <ul>
                                @if(Helper::check_user_assess('add',CLIENTS_MODULE))
                                <li><a href="{{route('addClient')}}" class="{{ (request()->routeIs('addClient')) ? 'active' : '' }}">Add Client</a>
                                </li>
                                @endif
                                <li><a href="{{route('clientList')}}" class="{{ (request()->routeIs('clientList')) ? 'active' : '' }}">Client List</a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        <!-- Category -->
                        @if(Helper::check_user_assess('view',CATEGORY_MODULE))
                        <li class="submenu {{ (request()->routeIs('categoryList') || request()->routeIs('addCategory')) ? 'active' : '' }}">
                            <a href="{{route('categoryList')}}" class="{{ (request()->routeIs('categoryList') || request()->routeIs('addCategory')) ? 'active' : '' }} "><i class="fas fa-th-list"></i><span>Category</span><span class="menu-arrow"></span></a>
                            <ul>
                                @if(Helper::check_user_assess('add',CATEGORY_MODULE))
                                <li><a href="{{route('addCategory')}}" class="{{ (request()->routeIs('addCategory')) ? 'active' : '' }}">Add Category</a></li>
                                @endif
                                <li><a href="{{route('categoryList')}}" class="{{ (request()->routeIs('categoryList')) ? 'active' : '' }}">Category List</a></li>
                            </ul>
                        </li>
                        @endif

                        <!-- Product -->
                        @if(Helper::check_user_assess('view',PRODUCT_MODULE))
                        <li class="submenu {{ (request()->routeIs('productList') || request()->routeIs('addProduct')) ? 'active' : '' }}">
                            <a href="{{route('productList')}}" class="{{ (request()->routeIs('productList') || request()->routeIs('addProduct')) ? 'active' : '' }}"><i class="fab fa-product-hunt"></i><span>Product</span><span class="menu-arrow"></span></a>
                            <ul>
                                @if(Helper::check_user_assess('add',PRODUCT_MODULE))
                                <li><a href="{{route('addProduct')}}" class="{{ (request()->routeIs('addProduct')) ? 'active' : '' }}">Add Product</a>
                                </li>
                                @endif
                                <li><a href="{{route('productList')}}" class="{{ (request()->routeIs('productList')) ? 'active' : '' }}">Product List</a></li>
                            </ul>
                        </li>
                        @endif

                        <!-- Order -->
                        @if(Helper::check_user_assess('view',ORDER_MODULE))
                        <li class="submenu {{ (request()->routeIs('orderList') || request()->routeIs('addOrder')) ? 'active' : '' }}">
                            <a href="{{route('orderList')}}" class="{{ (request()->routeIs('orderList') || request()->routeIs('addOrder')) ? 'active' : '' }}"><i class="fas fa-box-open"></i><span>Order</span><span class="menu-arrow"></span></a>
                            <ul>
                                @if(Helper::check_user_assess('add',ORDER_MODULE))    
                                <li><a href="{{route('addOrder')}}" class="{{ (request()->routeIs('addOrder')) ? 'active' : '' }}">Add Orders</a>
                                </li>
                                @endif
                                <li><a href="{{route('orderList')}}" class="{{ (request()->routeIs('orderList')) ? 'active' : '' }}">Orders List</a>
                                </li>
                            </ul>
                        </li>
                        @endif

                        <!-- Estimates -->
                        @if(Helper::check_user_assess('view',ESTIMATES_MODULE))
                        <li class="submenu {{ (request()->routeIs('estimateList') || request()->routeIs('addEstimate')) ? 'active' : '' }}">
                            <a href="{{route('estimateList')}}" class="{{ (request()->routeIs('estimateList') || request()->routeIs('addEstimate')) ? 'active' : '' }}"><i class="fas fa-boxes"></i><span>Estimates</span><span class="menu-arrow"></span></a>
                            <ul>
                                @if(Helper::check_user_assess('add',ORDER_MODULE))  
                                <li><a href="{{route('addEstimate')}}" class="{{ (request()->routeIs('addEstimate')) ? 'active' : '' }}">Add Estimates</a></li>
                                @endif
                                <li><a href="{{route('estimateList')}}" class="{{ (request()->routeIs('estimateList')) ? 'active' : '' }}">Estimates List</a></li>
                            </ul>
                        </li>
                        @endif

                        @if(Helper::check_user_assess('view',PERMISSIONS_MODULE))
                        <li class="submenu {{ (request()->routeIs('assignModuleForm') || request()->routeIs('moduleMasterList') || request()->routeIs('panelMasterList')) ? 'active' : '' }}">
                            <a href="{{route('assignModuleForm')}}" class="{{ (request()->routeIs('assignModuleForm') || request()->routeIs('moduleMasterList') || request()->routeIs('panelMasterList')) ? 'active' : '' }}"><i class="fas fa-cogs"></i><span>Permissions</span><span class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{route('assignModuleForm')}}" class="{{ request()->routeIs('assignModuleForm') ? 'active' : '' }}">Permissions Setting</a></li>
                                
                                @if(auth()->user()->role == 'superadmin')
                                <li><a href="{{route('panelMasterList')}}" class="{{ (request()->routeIs('panelMasterList')) ? 'active' : '' }}">Main Menus List</a></li>

                                <li><a href="{{route('moduleMasterList')}}" class="{{ (request()->routeIs('moduleMasterList')) ? 'active' : '' }}">Sub Menu List</a></li>
                                @endif
                            </ul>
                        </li>
                        @endif

                        <li class="{{ (request()->routeIs('paymentsList')) ? 'active' : '' }}">
                            <a href="{{route('paymentsList')}}"><i class="fas fa-file-invoice-dollar"></i> <span>Payments History</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="page-wrapper">