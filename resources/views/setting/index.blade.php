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
                    <li class="breadcrumb-item active">Settings</li>
                </ul>

                <div class="btn-back">
                    <a href="{{route('home')}}"><button class="btn btn-primary btn-sm" type="button"><i class="fas fa-chevron-left"></i> Back</button></a>
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
                            <i class="fas fa-cog"></i> <span>Settings</span>
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
                    <h5 class="card-title">Settings</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('updateSetting')}}" id="settingForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row form-group">
                            <label for="logo_img" class="col-sm-3 col-form-label input-label">Logo</label>
                            <div class="col-sm-9">
                                <div class="d-flex align-items-center">
                                    <label class="avatar avatar-xxl profile-cover-avatar m-0" for="logo_preview">
                                        <img id="logoPreview" class="avatar-img"
                                            src="{{ imageUrl(isset($settings->logo_img) ? $settings->logo_img : '', 'setting','no_image.jpg','thumbnail') }}"
                                            alt="Profile Image" />
                                        <input type="file" accept="image/*" name="logo_img" id="logo_preview" />
                                        <span class="avatar-edit">
                                            <i data-feather="edit-2" class="avatar-uploader-icon shadow-soft"></i>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="favicon_img" class="col-sm-3 col-form-label input-label">Favicon Icon</label>
                            <div class="col-sm-9">
                                <div class="d-flex align-items-center">
                                    <label class="avatar avatar-xxl profile-cover-avatar m-0" for="favicon_icon_preview">
                                        <img id="faviconIconPreview" class="avatar-img"
                                            src="{{ imageUrl(isset($settings->favicon_img) ? $settings->favicon_img : '', 'setting','no_image.jpg','thumbnail') }}"
                                            alt="Profile Image" />
                                        <input type="file" accept="image/*" name="favicon_img" id="favicon_icon_preview" />
                                        <span class="avatar-edit">
                                            <i data-feather="edit-2" class="avatar-uploader-icon shadow-soft"></i>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="prefix_name_invoice" class="col-sm-3 col-form-label input-label">Prefix Name Invoice</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="prefix_name_invoice" id="prefix_name_invoice" placeholder="Prefix Name Invoice" value="{{isset($settings->prefix_name_invoice) ? $settings->prefix_name_invoice : ''}}" />
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="name" class="col-sm-3 col-form-label input-label">Account Holder Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="holdare_name" id="holdare_name" placeholder="Account Holder Name" value="{{isset($settings->bd_holdare_name) ? $settings->bd_holdare_name : ''}}" />
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="bank_name" class="col-sm-3 col-form-label input-label">Bank Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Bank Name" value="{{isset($settings->bd_bank_name) ? $settings->bd_bank_name : ''}}" />
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="ifsc_code" class="col-sm-3 col-form-label input-label">IFSC Code</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="ifsc_code" id="ifsc_code" placeholder="IFSC Code" value="{{isset($settings->bd_ifsc_code) ? $settings->bd_ifsc_code : ''}}" />
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="account_no" class="col-sm-3 col-form-label input-label">Account Number</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="account_no" id="account_no" placeholder="Account Number" value="{{isset($settings->bd_account_no) ? $settings->bd_account_no : ''}}" />
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="phone_no" class="col-sm-3 col-form-label input-label">Phone No</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="Phone No" value="{{isset($settings->phone_no) ? $settings->phone_no : ''}}" />
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="email_id" class="col-sm-3 col-form-label input-label">Email Address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="email_id" id="email_id" placeholder="Email Address" value="{{isset($settings->email_id) ? $settings->email_id : ''}}" />
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="address" class="col-sm-3 col-form-label input-label">Address</label>
                            <div class="col-sm-9">
                                <textarea name="address" id="address" class="form-control" rows="2" placeholder="Address">{{isset($settings->address) ? $settings->address : ''}}</textarea>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="terms_conditions" class="col-sm-3 col-form-label input-label">Terms Conditions</label>
                            <div class="col-sm-9">
                                <textarea name="terms_conditions" id="terms_conditions" class="form-control" rows="2" placeholder="Terms Conditions">{{isset($settings->terms_conditions) ? $settings->terms_conditions : ''}}</textarea>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="sign_img" class="col-sm-3 col-form-label input-label">Sign</label>
                            <div class="col-sm-9">
                                <div class="d-flex align-items-center">
                                    <label class="avatar avatar-xxl profile-cover-avatar m-0" for="sign_preview">
                                        <img id="signPreview" class="avatar-img"
                                            src="{{ imageUrl(isset($settings->sign_img) ? $settings->sign_img : '', 'setting','no_image.jpg','thumbnail') }}"
                                            alt="Profile Image" />
                                        <input type="file" accept="image/*" name="sign_img" id="sign_preview" />
                                        <span class="avatar-edit">
                                            <i data-feather="edit-2" class="avatar-uploader-icon shadow-soft"></i>
                                        </span>
                                    </label>
                                </div>
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
    var settingForm = $("#settingForm");

    var validator = settingForm.validate({
        rules: {
            prefix_name_invoice: {
                required: true
            },
            holdare_name: {
                required: true
            },
            bank_name: {
                required: true
            },
            ifsc_code: {
                required: true
            },
            account_no: {
                required: true
            },
            email_id: {
                required: true,
                email: true
            },
            phone_no: {
                required: true
            },
            address: {
                required: true
            },
            terms_conditions: {
                required: true
            }
        },
        messages: {
            prefix_name_invoice: {
                required: "This field is required"
            },
            holdare_name: {
                required: "This field is required"
            },
            bank_name: {
                required: "This field is required"
            },
            ifsc_code: {
                required: "This field is required"
            },
            account_no: {
                required: "This field is required"
            },
            email_id: {
                required: "This field is required",
                email:"Please enter valid email address"
            },
            phone_no: {
                required: "This field is required"
            },
            address: {
                required: "This field is required"
            },
            terms_conditions: {
                required: "This field is required"
            }
        }
    });
});

$(document).ready(() => {
    $('#logo_preview').change(function() {
        const file = this.files[0];
        const uploadMaxSize = 5 * 1024 * 1024;
        const validExtension = ['jpg', 'jpeg', 'png'];

        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                $('#logoPreview').attr('src', event.target.result);
            }
            let fileExtension = file.name.split('.').pop() || '';

            if (!validExtension.includes(fileExtension)) {
                // reset input
                event.target.value = '';

                toastr.error("jpg, jpeg, png allow only");
                return;
            } else if (file.size > uploadMaxSize) {
                // reset input
                event.target.value = '';

                toastr.error("Maximum allowable size is 5 mb per upload");
                return;
            } else {
                reader.readAsDataURL(file);
            }
        }
    });

    $('#favicon_icon_preview').change(function() {
        const file = this.files[0];
        const uploadMaxSize = 5 * 1024 * 1024;
        const validExtension = ['jpg', 'jpeg', 'png'];

        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                $('#faviconIconPreview').attr('src', event.target.result);
            }
            let fileExtension = file.name.split('.').pop() || '';

            if (!validExtension.includes(fileExtension)) {
                // reset input
                event.target.value = '';

                toastr.error("jpg, jpeg, png allow only");
                return;
            } else if (file.size > uploadMaxSize) {
                // reset input
                event.target.value = '';

                toastr.error("Maximum allowable size is 5 mb per upload");
                return;
            } else {
                reader.readAsDataURL(file);
            }
        }
    });

    $('#sign_preview').change(function() {
        const file = this.files[0];
        const uploadMaxSize = 5 * 1024 * 1024;
        const validExtension = ['jpg', 'jpeg', 'png'];

        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                $('#signPreview').attr('src', event.target.result);
            }
            let fileExtension = file.name.split('.').pop() || '';

            if (!validExtension.includes(fileExtension)) {
                // reset input
                event.target.value = '';

                toastr.error("jpg, jpeg, png allow only");
                return;
            } else if (file.size > uploadMaxSize) {
                // reset input
                event.target.value = '';

                toastr.error("Maximum allowable size is 5 mb per upload");
                return;
            } else {
                reader.readAsDataURL(file);
            }
        }
    });
});
</script>
@endpush