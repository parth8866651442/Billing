@extends('layouts.app')

@section('content')
@push('style')
<style>
    .form-lable{
        margin-bottom:8px;
        font-weight: 400;
        color: #1e2022;
    }
    .form-value {
        display: block;
        padding: 2px 10px;
        font-size: .875rem;
    }
</style>
@endpush
<div class="content container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <!-- <h3 class="page-title">Users</h3> -->
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Clients</a>
                    </li>
                    <li class="breadcrumb-item active">View Client</li>
                </ul>

                <div class="btn-back">
                    <a href="{{route('clientList')}}"><button class="btn btn-primary btn-sm" type="button"><i class="fas fa-chevron-left"></i> Back</button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">View Clients</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-lable">
                                <span>Name</span>
                                <span class="form-value">Raj Bhai B k</span>
                            </div>
                            <div class="form-lable">
                                <span>Name</span>
                                <span class="form-value">Raj Bhai B k</span>
                            </div>
                            <div class="form-lable">
                                <span>Name</span>
                                <span class="form-value">Raj Bhai B k</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-lable">
                                <span>Name</span>
                                <span class="form-value">Raj Bhai B k</span>
                            </div>
                            <div class="form-lable">
                                <span>Name</span>
                                <span class="form-value">Raj Bhai B k</span>
                            </div>
                            <div class="form-lable">
                                <span>Name</span>
                                <span class="form-value">Raj Bhai B k</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection