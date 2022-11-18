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
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
                <div class="col-xxl-9 col-lg-8">
                    <div class="card-style mb-30">
                        <h6 class="mb-25">Profile</h6>
                        <form method="POST" action="{{route('updateProfile')}}" id="userProfileForm"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="profile-wrapper input-style-1">
                                        <div class="profile-photo">
                                            <div class="image">
                                                <img id="imgPreview" src="{{ imageUrl(auth()->user()->image, 'user','no_image.jpg','thumbnail') }}" alt="profile" />
                                                <div class="update-image">
                                                    <input type="file" accept="image/*" name="image" id="image_preview"/>
                                                    <label for=""><i class="lni lni-camera"></i></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Name</label>
                                        <input type="text" name="name" id="name" placeholder="Name" value="{{auth()->user()->name}}">
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Email</label>
                                        <input type="text" name="email" id="email" readonly placeholder="Email" value="{{auth()->user()->email}}">
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-12">
                                    <div class="input-style-1">
                                        <label>Phone No</label>
                                        <input type="text" name="phone_no" id="phone_no" placeholder="Phone No" value="{{auth()->user()->phone_no}}">
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