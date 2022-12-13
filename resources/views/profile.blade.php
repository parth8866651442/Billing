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
                    <li class="breadcrumb-item active">Profile</li>
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
                    <h5 class="card-title">Profile</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('updateProfile')}}" id="userProfileForm"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row form-group">
                            <label for="name" class="col-sm-3 col-form-label input-label"></label>
                            <div class="col-sm-9">
                                <div class="d-flex align-items-center">
                                    <label class="avatar avatar-xxl profile-cover-avatar m-0" for="image_preview">
                                        <img id="imgPreview" class="avatar-img"
                                            src="{{ imageUrl(auth()->user()->image, 'user','no_image.jpg','thumbnail') }}"
                                            alt="Profile Image" />
                                        <input type="file" accept="image/*" name="image" id="image_preview" />
                                        <span class="avatar-edit">
                                            <i data-feather="edit-2" class="avatar-uploader-icon shadow-soft"></i>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="name" class="col-sm-3 col-form-label input-label">Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Your Name"
                                    value="{{auth()->user()->name}}" />
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="email" class="col-sm-3 col-form-label input-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                                    value="{{auth()->user()->email}}" readonly />
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="phone" class="col-sm-3 col-form-label input-label">Phone</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="phone_no" id="phone_no"
                                    placeholder="xxxxxxxxxx" value="{{auth()->user()->phone_no}}" />
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
    var userForm = $("#userProfileForm");

    var validator = userForm.validate({
        rules: {
            name: {
                required: true
            },
            phone_no: {
                required: true,
                phoneUS: true,
                number: true,
                minlength: 10,
                remote: {
                    url: "{{route('checkUserPhoneNoRepeat')}}",
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        action: '{{isset(auth()->user()->id) ? "edit" :"add"}}',
                        id: '{{isset(auth()->user()->id) ? auth()->user()->id :""}}'
                    }
                }
            },
            email: {
                required: true
            },
        },
        messages: {
            name: {
                required: "This field is required"
            },
            phone_no: {
                required: "This field is required",
                number: "Please enter numbers only",
                minlength: "Please enter min 10 digit number",
                remote: "Phone No already taken"
            },
            email: {
                required: "This field is required"
            },
        }
    });
});

$(document).ready(() => {
    $('#image_preview').change(function() {
        const file = this.files[0];
        const uploadMaxSize = 5 * 1024 * 1024;
        const validExtension = ['jpg', 'jpeg', 'png'];

        if (file) {
            let reader = new FileReader();
            reader.onload = function(event) {
                $('#imgPreview').attr('src', event.target.result);
                $('#file_name').text(file.name);
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