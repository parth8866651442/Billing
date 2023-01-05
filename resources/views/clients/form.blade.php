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
                        <a href="#">Clients</a>
                    </li>
                    <li class="breadcrumb-item active">Add Client</li>
                </ul>

                <div class="btn-back">
                    <a href="{{route('clientList')}}"><button class="btn btn-primary btn-sm" type="button"><i
                                class="fas fa-chevron-left"></i> Back</button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Clients</h4>
                    <form method="POST"
                        action="{{(isset($item)) ? route('updateClient',['id'=>$item->id]) :route('storeClient')}}"
                        id="clientsForm" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name<span class="asterisk">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name"
                                        value="@isset($item->name){{$item->name}}@endisset" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Phone No<span class="asterisk">*</span></label>
                                    <input type="text" class="form-control" name="phone_no" id="phone_no"
                                        placeholder="Phone No"
                                        value="@isset($item->phone_no){{$item->phone_no}}@endisset" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email<span class="asterisk">*</span></label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                                        value="@isset($item->email){{$item->email}}@endisset" @if(isset($item)) readonly
                                        @endif>
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password @if(!isset($item))<span class="asterisk">*</span>@endif</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Password" value="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirm Password @if(!isset($item))<span
                                            class="asterisk">*</span>@endif</label>
                                    <input type="password" class="form-control" name="confirmpassword"
                                        id="confirmpassword" placeholder="Confirm Password" value="" />
                                </div>
                            </div> -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>PAN Card No</label>
                                    <input type="text" class="form-control" name="pan_card_no" id="pan_card_no"
                                        placeholder="PAN Card No Ex: ABCDE1234F" onkeyup="checkValidation()"
                                        value="@isset($item->pan_card_no){{$item->pan_card_no}}@endisset" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Aadhaar Card No</label>
                                    <input type="text" class="form-control" name="aadhaar_card_no" id="aadhaar_card_no"
                                        placeholder="Aadhaar Card No Ex: 1234 5678 9012" onkeyup="checkValidation()"
                                        value="@isset($item->aadhaar_card_no){{$item->aadhaar_card_no}}@endisset" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" name="address"
                                        id="address">@isset($item->address){{$item->address}}@endisset</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" class="form-control" name="city" id="city"
                                        value="@isset($item->city){{$item->city}}@endisset" />
                                </div>
                            </div>
                        </div>
                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary">
                            {{isset($item) ? 'Update' : 'Add'}} Client
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
<!-- <script src="{{asset('assets/js/validate/jquery.validate.js'); }}" type="text/javascript"></script>
<script src="{{asset('assets/js/validate/additional-methods.min.js'); }}" type="text/javascript"></script>
<script src="{{asset('assets/js/validate/validation.js'); }}" type="text/javascript"></script> -->
<script>
$(document).ready(function() {
    var addClientsForm = $("#clientsForm");
    var validator = addClientsForm.validate({
        rules: {
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
                    url: "{{route('checkClientEmailRepeat')}}",
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        action: '{{isset($item->id) ? "edit" :"add"}}',
                        id: '{{isset($item->id) ? $item->id :""}}'
                    }
                }
            },
            /* password: {
                required: <?php isset($item) ? print('false') : print('true')  ?>,
                minlength: 6,
                pwcheck: <?php isset($item) ? print('false') : print('true')  ?>
            },
            confirmpassword: {
                required: <?php isset($item) ? print('false') : print('true')  ?>,
                equalTo: "#password"
            } */
        },
        messages: {
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
            /* password: {
                required: "This field is required",
                minlength: "Please enter min 6 digit Password",
                pwcheck: "Invalid Password,Min 1 uppercase and lowercase letter. Min 1 special character. Min 1 number."
            },
            confirmpassword: {
                required: "This field is required",
                equalTo: "Confirm password doesn't match New password"
            } */
        }
    });
    /* $.validator.addMethod("pwcheck", function(value) {
        return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{6,30}$/.test(value)
    }); */
    $.validator.addMethod("pndcheck", function(value) {
        return /([A-Z]){5}([0-9]){4}([A-Z]){1}$/.test(value)
    });
    $.validator.addMethod("aadharcheck", function(value) {
        return /^([0-9]{4}[0-9]{4}[0-9]{4}$)|([0-9]{4}\s[0-9]{4}\s[0-9]{4}$)|([0-9]{4}-[0-9]{4}-[0-9]{4}$)/
            .test(value)
    });
});

function debounce(func, timeout = 300) {
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => {
            func.apply(this, args);
        }, timeout);
    };
}

const checkValidation = debounce(() => {
    if ($('#pan_card_no').val()) {
        $("#pan_card_no").rules("add", {
            pndcheck: true,
            messages: {
                pndcheck: "Invalid Pan Card Number"
            }
        });
    } else if ($('#aadhaar_card_no').val()) {
        $("#aadhaar_card_no").rules("add", {
            aadharcheck: true,
            messages: {
                aadharcheck: "Invalid Aadhaar Card Number"
            }
        });
    } else {
        $("#pan_card_no").rules("remove");
        $("#aadhaar_card_no").rules("remove");
    }
});
</script>
@endpush