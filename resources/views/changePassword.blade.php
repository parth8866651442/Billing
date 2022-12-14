@extends('layouts.app')

@section('content')
<style>
.page-header .breadcrumb {
    float: left;
}

.page-header .btn-back {
    float: right;
}
</style>
<div class="content container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <!-- <h3 class="page-title">Users</h3> -->
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">Change Password</li>
                </ul>

                <div class="btn-back">
                    <a href="{{route('home')}}"><button class="btn btn-primary btn-sm" type="button"><i class="fas fa-chevron-left"></i>Back</button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-4">
            <div class="widget settings-menu">
                <ul>
                    <li class="nav-item">
                        <a href="{{route('profile')}}" class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                            <i class="far fa-user"></i> <span>Profile Settings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('settingForm')}}" class="nav-link {{ request()->routeIs('settingForm') ? 'active' : '' }}">
                            <i class="far fa-user"></i> <span>Settings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('passwordChange')}}" class="nav-link {{ request()->routeIs('passwordChange') ? 'active' : '' }}">
                            <i class="fas fa-unlock-alt"></i>
                            <span>Change Password</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-xl-9 col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Change Password</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('passwordUpdate')}}" id="changePasswordForm">
                        @csrf
                        <div class="row form-group">
                            <label for="current_password" class="col-sm-3 col-form-label input-label">Current Password</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="current_password" id="current_password" placeholder="Current Password" value="" />
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="password" class="col-sm-3 col-form-label input-label">New Password</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="password" id="password" placeholder="New Password" value="" />
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="password_confirmation" class="col-sm-3 col-form-label input-label">Confirm New Password</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm New Password" value="" />
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{asset('assets/js/validate/jquery.validate.js'); }}" type="text/javascript"></script>
<script src="{{asset('assets/js/validate/additional-methods.min.js'); }}" type="text/javascript"></script>
<script src="{{asset('assets/js/validate/validation.js'); }}" type="text/javascript"></script>
<script>
$(document).ready(function() {
    var addUserForm = $("#changePasswordForm");

    var validator = addUserForm.validate({
        rules: {
            current_password: {
                required: true,
                remote: {
                    url: "{{route('checkUserPassword')}}",
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        id: '{{auth()->user()->id}}'
                    }
                }
            },
            password: {
                required: true,
                minlength: 6
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            },
        },
        messages: {
            current_password: {
                required: "This field is required",
                remote: "Current Password not match"
            },
            password: {
                required: "This field is required",
                minlength: "Please enter min 6 digit password"
            },
            password_confirmation: {
                required: "This field is required",
                equalTo: "Confirm password doesn't match New password"
            },
        }
    });
});
</script>
@endpush