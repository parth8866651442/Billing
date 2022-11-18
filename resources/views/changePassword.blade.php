@extends('layouts.app')

@section('content')
<!-- ========== section start ========== -->
<section class="section">
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6 col-sm-6 col-6">
                    <div class="breadcrumb-wrapper mb-30">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{route('home')}}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-md-6 col-sm-6 col-6">
                    <div class="title mb-30">
                        <a href="{{route('home')}}"><button class="btn primary-btn">Back</button></a>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- ========== title-wrapper end ========== -->
         <!-- ========== form-layout-wrapper start ========== -->
         <div class="form-layout-wrapper">
            <div class="row">
                <div class="col-xxl-6 col-lg-6">
                    <div class="card-style mb-30">
                        <h6 class="mb-25">Change Password</h6>
                        <form method="POST" action="{{route('passwordUpdate')}}" id="changePasswordForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Current Password</label>
                                        <input type="password" name="current_password" id="current_password">
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>New Password</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation">
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Confirm New Password</label>
                                        <input type="password" name="password" id="password">
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-12">
                                    <div class="button-group d-flex justify-content-center flex-wrap">
                                        <button type="submit" class="main-btn primary-btn btn-hover m-2">Save</button>
                                        <a href="{{route('home')}}" class="main-btn danger-btn-outline m-2">Cancel</a>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
                        </form>
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- ========== form-layout-wrapper end ========== -->
    </div>
    <!-- end container -->
</section>
<!-- ========== section end ========== -->
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
            password_confirmation: {
                required: true,
                minlength: 6
            },
            password: {
                required: true,
                equalTo: "#password_confirmation"
            },
        },
        messages: {
            current_password: {
                required: "This field is required",
                remote: "Current Password not match"
            },
            password_confirmation: {
                required: "This field is required",
                minlength: "Please enter min 6 digit password"
            },
            password: {
                required: "This field is required",
                equalTo: "Confirm password doesn't match New password"
            },
        }
    });
});
</script>
@endpush