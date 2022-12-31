@extends('layouts.app')

@section('content')
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
                        <a href="#">Users</a>
                    </li>
                    <li class="breadcrumb-item active">Add Users</li>
                </ul>

                <div class="btn-back">
                    <a href="{{route('userList')}}"><button class="btn btn-primary btn-sm" type="button"><i
                                class="fas fa-chevron-left"></i> Back</button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Users</h4>
                    <form method="POST"
                        action="{{(isset($item)) ? route('updateUser',['id'=>$item->id]) : route('storeUser')}}"
                        id="userForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Type<span class="asterisk">*</span></label>
                                    <select class="select select2" name="role" id="role">
                                        <option value="">Select User Type</option>
                                        <option value="admin"
                                            {{isset($item->role) && $item->role === 'admin' ? 'selected' :''  }}>Admin
                                        </option>
                                        <option value="employee"
                                            {{isset($item->role) && $item->role === 'employee' ? 'selected' :''  }}>
                                            Employee</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Name<span class="asterisk">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                                        value="@isset($item->name){{$item->name}}@endisset" />
                                </div>
                                <div class="form-group">
                                    <label>Phone No<span class="asterisk">*</span></label>
                                    <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="Phone No" value="@isset($item->phone_no){{$item->phone_no}}@endisset" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email<span class="asterisk">*</span></label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="@isset($item->email){{$item->email}}@endisset" @if(isset($item)) readonly @endif>
                                </div>
                                <div class="form-group">
                                    <label>Password @if(!isset($item))<span class="asterisk">*</span>@endif</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="" />
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password @if(!isset($item))<span class="asterisk">*</span>@endif</label>
                                    <input type="password" class="form-control" name="confirmpassword" id="confirmpassword"
                                        placeholder="Confirm Password" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="custom-file-container" data-upload-id="myFirstImage">
                                        <label>Upload (Single File) <a href="javascript:void(0)" class="custom-file-container__image-clear" id="imgRemove" title="Clear Image">x</a> </label>
                                        <label class="custom-file-container__custom-file">
                                            <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*" name="image" id="image_preview">
                                            <span class="custom-file-container__custom-file__custom-file-control" id="imgName">Choose file...<span class="custom-file-container__custom-file__custom-file-control__button"> Browse </span></span>
                                        </label>
                                        <div class="custom-file-container__image-preview" id="imgPreview" style="background-image:url('{{ imageUrl(isset($item->image) ? $item->image : '', 'user','no_image.jpg','thumbnail') }}')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                Add Customer
                            </button>
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
    var addUserForm = $("#userForm");
    //alert('hi');
    var validator = addUserForm.validate({
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.form-control').removeClass('has-success').addClass('has-error');     
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.form-control').removeClass('has-error').addClass('has-success');
        },
        errorPlacement: function (error, element) {
            if(element.hasClass('select2') && element.next('.select2-container').length) {
                error.insertAfter(element.next('.select2-container'));
            } else if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            }
            else {
                error.insertAfter(element);
            }
        },
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
                maxlength: 10
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
                        id: '{{isset($item->id) ? $item->id :""}}'
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
                phoneUS: "Please enter numbers only",
                maxlength: "Please enter max 10 digit number"
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
            confirmpassword: {
                required: "This field is required",
                equalTo: "Confirm password doesn't match New password"
            },
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
                $('#imgPreview').css('background-image', "url(" +event.target.result + ")");
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
                $('#imgName').html(file.name+'<span class="custom-file-container__custom-file__custom-file-control__button"> Browse </span>');
            }
        }
    });
    
    $('#imgRemove').click(function() {
        $('#image_preview').val('');

        $('#imgName').html('Choose file... <span class="custom-file-container__custom-file__custom-file-control__button"> Browse </span>');
        $('#imgPreview').css('background-image', "url('{{ imageUrl('', '','no_image.jpg') }}')");
    });
});
</script>
@endpush