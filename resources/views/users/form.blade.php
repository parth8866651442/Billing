@extends('layouts.app')

@section('content')
<style>
.holder img {
    max-width: 100px;
    max-height: 100px;
    min-width: 100px;
    min-height: 100px;
}
</style>
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
                                <li class="breadcrumb-item active" aria-current="page">
                                    Users Form
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-md-6 col-sm-6 col-6">
                    <div class="title mb-30">
                        <a href="{{route('userList')}}"><button class="btn primary-btn">Back</button></a>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- ========== title-wrapper end ========== -->

        <!-- ========== form-layout-wrapper start ========== -->
        <div class="form-layout-wrapper">
            <div class="card-style mb-30">
                <h6 class="mb-25">User</h6>
                @if(isset($item))
                <form method="POST" action="{{route('updateUser',['id'=>$item->id])}}" id="userForm" enctype="multipart/form-data">
                    @else
                    <form method="POST" action="{{route('storeUser')}}" id="userForm" enctype="multipart/form-data">
                        @endif
                        <div class="row">
                            @csrf
                            <input type="hidden" name="id" value="@isset($item->id){{$item->id}}@endisset">
                            <!-- sub -->
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="select-style-1">
                                    <label>User Type<span class="asterisk">*</span></label>
                                    <div class="select-position">
                                    <select name="role" id="role">
                                        <option value="">Select User Type</option>
                                        <option value="admin" {{isset($item->role) && $item->role === 'admin' ? 'selected' :''  }}>Admin</option>
                                        <option value="employee" {{isset($item->role) && $item->role === 'employee' ? 'selected' :''  }}>Employee</option>
                                    </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="input-style-1">
                                    <label for="name">Name<span class="asterisk">*</span></label>
                                    <input type="text" name="name" id="name" class="bg-transparent" placeholder="Name" value="@isset($item->name){{$item->name}}@endisset">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="input-style-1">
                                    <label for="phone_no">Phone No<span class="asterisk">*</span></label>
                                    <input type="text" name="phone_no" id="phone_no" class="bg-transparent" placeholder="Phone No" value="@isset($item->phone_no){{$item->phone_no}}@endisset">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="input-style-1">
                                    <label for="email">Email<span class="asterisk">*</span></label>
                                    @if(isset($item))
                                    <input type="text" name="email" id="email" class="bg-transparent" placeholder="Email"
                                        value="@isset($item->email){{$item->email}}@endisset" readonly>
                                    @else
                                    <input type="text" name="email" id="email" class="bg-transparent" placeholder="Email"
                                        value="">
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="input-style-1">
                                    <label for="password">Password @if(!isset($item))<span class="asterisk">*</span>
                                        @endif</label>
                                    <input type="password" name="password" id="password" class="bg-transparent"
                                        placeholder="Password" value="">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12">
                                <div class="input-style-1">
                                    <label for="confirmpassword">Confirm Password @if(!isset($item))<span class="asterisk">*</span>
                                        @endif</label>
                                    <input type="password" name="confirmpassword" id="confirmpassword" class="bg-transparent"
                                        placeholder="Confirm Password" value="">
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="input-style-1">
                                    <label for="image_preview">Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image" id="image_preview">
                                        </div>
                                    </div>
                                    <div class="holder mt-2">
                                        <img id="imgPreview" src="{{ imageUrl(isset($item->image) ? $item->image : '', 'user','no_image.jpg','thumbnail') }}" alt="pic" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="main-btn primary-btn btn-hover" type="submit">Save</button>
                                <a href="{{route('userList')}}"><button type="button" class="main-btn secondary-btn btn-hover">Cancel</button></a>
                            </div>
                        </div>
                        <!-- end row -->
                    </form>
            </div>
            <!-- end card -->
        </div>
        <!-- ========== form-layout-wrapper end ========== -->
    </div>
    <!-- end container -->
</section>
@endsection

@push('scripts')
<script src="{{asset('assets/js/validate/jquery.validate.js'); }}" type="text/javascript"></script>
<script src="{{asset('assets/js/validate/additional-methods.min.js'); }}" type="text/javascript"></script>
<script src="{{asset('assets/js/validate/validation.js'); }}" type="text/javascript"></script>
<script>
$(document).ready(function() {
    var addUserForm = $("#userForm");
    //alert('hi');
    var validator = addUserForm.validate({

        rules: {
            role: {
                required: true
            },
            name: {
                required: true
            },
            phone_no: {
                required: true,
                phoneUS: true,
                number: true,
                minlength: 10
            },
            email: {
                required: true,
                email: true,
                remote: {
                    url: "{{route('checkUserEmailRepeat')}}",
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        action: '{{isset($item->id) ? "edit" :"add"}}',
                        id:'{{isset($item->id) ? $item->id :""}}'
                    }
                }
            },
            password: {
                required: <?php isset($item) ? print('false') : print('true')  ?>,
                minlength: 6,
                pwcheck: <?php isset($item) ? print('false') : print('true')  ?>
            },
            confirmpassword: {
                required: <?php isset($item) ? print('false') : print('true')  ?>,
                equalTo: "#password"
            },
        },
        messages: {
            role: {
                required: "This field is required"
            },
            name: {
                required: "This field is required"
            },
            phone_no: {
                required: "This field is required",
                number: "Please enter numbers only",
                minlength: "Please enter min 10 digit number"
            },
            email: {
                required: "This field is required",
                email: "Please enter valid email address",
                remote: "Email already taken"
            },
            password: {
                required: "This field is required",
                minlength: "Please enter min 6 digit Password",
                pwcheck: "Invalid Password,Min 1 uppercase and lowercase letter. Min 1 special character. Min 1 number."
            },
            confirmpassword:{ required : "This field is required",equalTo:"Confirm password doesn't match New password"},
        }
    });
    $.validator.addMethod("pwcheck", function(value) {
       return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{6,30}$/.test(value)
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