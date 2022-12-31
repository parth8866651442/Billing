<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <title>Sign In</title>

    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toatr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
</head>

<body>
    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <img class="img-fluid logo-dark mb-2" src="{{ asset('assets/img/logo.png'); }}" alt="Logo" />
                <div class="loginbox">
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Login</h1>
                            <!-- <p class="account-subtitle">Access to our dashboard</p> -->
                            <form method="POST" action="{{ route('login') }}" id="loginForm">
                                @csrf
                                <div class="form-group">
                                    <label class="form-control-label">Email Address</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                        required autocomplete="email" autofocus />
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label">Password</label>
                                    <div class="pass-group">
                                        <input type="password" class="form-control pass-input" name="password" required
                                            autocomplete="current-password" />
                                        <i class="fas fa-eye toggle-password"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cb1" />
                                                <label class="custom-control-label" for="cb1">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="col-6 text-end">
                                            @if (Route::has('password.request'))
                                            <a class="forgot-link" href="{{ route('password.request') }}">Forgot
                                                Password ?</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-lg btn-block btn-primary w-100" type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/toastr/toastr.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/script.js') }}"></script> -->
    <script src="{{asset('assets/js/validate/jquery.validate.js'); }}" type="text/javascript"></script>
    <script src="{{asset('assets/js/validate/additional-methods.min.js'); }}" type="text/javascript"></script>
    <script src="{{asset('assets/js/validate/validation.js'); }}" type="text/javascript"></script>
    <script>
    // Password Show
    if ($('.toggle-password').length > 0) {
        $(document).on('click', '.toggle-password', function() {
            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $(".pass-input");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    }

    $(document).ready(function() {
        $("#loginForm").validate({
            highlight: function(element, errorClass, validClass) {
                $(element).parents('.form-control').removeClass('has-success').addClass(
                    'has-error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.form-control').removeClass('has-error').addClass(
                    'has-success');
            },
            errorPlacement: function(error, element) {
                if (element.hasClass('select2') && element.next('.select2-container').length) {
                    error.insertAfter(element.next('.select2-container'));
                } else if (element.parent('.pass-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                email: {
                    required: "This field is required",
                    email: "Please enter valid email address"
                },
                password: {
                    required: "This field is required",
                    minlength: "Please enter min 6 digit Password"
                }
            }
        });
    });
    </script>

    @if(Session::has('success'))
    <script>
    toastr.success("{{ Session::get('success') }}")
    </script>
    @elseif(Session::has('status'))
    <script>
    toastr.success("{{ Session::get('status') }}")
    </script>
    @elseif(Session::has('error'))
    <script>
    toastr.error("{{ Session::get('error') }}")
    </script>
    @endif
</body>

</html>