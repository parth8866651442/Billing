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
                                <li class="breadcrumb-item active" aria-current="page">Clients Form</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-md-6 col-sm-6 col-6">
                    <div class="title mb-30">
                        <a href="{{route('clientList')}}"><button class="btn primary-btn">Back</button></a>
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
                <h6 class="mb-25">Client</h6>
                <form method="POST"
                    action="{{(isset($item)) ? route('updateClient',['id'=>$item->id]) :route('storeClient') }}"
                    id="clientsForm" enctype="multipart/form-data">
                    <div class="row">
                        @csrf
                        <input type="hidden" name="id" value="@isset($item->id){{$item->id}}@endisset">
                        <!-- sub -->
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="input-style-1">
                                <label for="name">Name<span class="asterisk">*</span></label>
                                <input type="text" name="name" id="name" class="bg-transparent" placeholder="Name"
                                    value="@isset($item->name){{$item->name}}@endisset">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
                            <div class="input-style-1">
                                <label for="phone_no">Phone No<span class="asterisk">*</span></label>
                                <input type="text" name="phone_no" id="phone_no" class="bg-transparent"
                                    placeholder="Phone No" value="@isset($item->phone_no){{$item->phone_no}}@endisset">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12 col-12">
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
                                <label for="confirmpassword">Confirm Password @if(!isset($item))<span
                                        class="asterisk">*</span>
                                    @endif</label>
                                <input type="password" name="confirmpassword" id="confirmpassword"
                                    class="bg-transparent" placeholder="Confirm Password" value="">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-12">
                            <div class="input-style-1">
                                <label for="pan_card_no">PAN Card No</label>
                                <input type="text" name="pan_card_no" id="pan_card_no" class="bg-transparent"
                                    onkeyup="checkValidation()" placeholder="PAN Card No Ex: ABCDE1234F"
                                    value="@isset($item->pan_card_no) {{$item->pan_card_no}}@endisset">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-12">
                            <div class="input-style-1">
                                <label for="aadhaar_card_no">Aadhaar Card No</label>
                                <input type="text" name="aadhaar_card_no" id="aadhaar_card_no" class="bg-transparent"
                                    onkeyup="checkValidation()" placeholder="Aadhaar Card No Ex: 1234 5678 9012"
                                    value="@isset($item->aadhaar_card_no){{$item->aadhaar_card_no}}@endisset">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-12">
                            <div class="input-style-1">
                                <label>Address</label>
                                <textarea placeholder="Address" rows="2" name="address"
                                    id="address">@isset($item->address){{$item->address}}@endisset</textarea>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-12">
                            <div class="input-style-1">
                                <label for="city">City</label>
                                <input type="text" name="city" id="city" class="bg-transparent" placeholder="City"
                                    value="@isset($item->city){{$item->city}}@endisset">
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="main-btn primary-btn btn-hover" type="submit">Save</button>
                            <a href="{{route('clientList')}}"><button type="button"
                                    class="main-btn secondary-btn btn-hover">Cancel</button></a>
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
            password: {
                required: <?php isset($item) ? print('false') : print('true')  ?>,
                minlength: 6,
                pwcheck: <?php isset($item) ? print('false') : print('true')  ?>
            },
            confirmpassword: {
                required: <?php isset($item) ? print('false') : print('true')  ?>,
                equalTo: "#password"
            }
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
            password: {
                required: "This field is required",
                minlength: "Please enter min 6 digit Password",
                pwcheck: "Invalid Password,Min 1 uppercase and lowercase letter. Min 1 special character. Min 1 number."
            },
            confirmpassword: {
                required: "This field is required",
                equalTo: "Confirm password doesn't match New password"
            }
        }
    });
    $.validator.addMethod("pwcheck", function(value) {
        return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{6,30}$/.test(value)
    });
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