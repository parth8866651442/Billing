<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg'); }}" type="image/x-icon" />
    <title>Reset Password</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css'); }}" />
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/lineicons.css'); }}" /> -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/materialdesignicons.min.css'); }}" /> -->
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/fullcalendar.css'); }}" /> -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css'); }}" />
</head>

<body>

    <!-- ========== signin-section start ========== -->
    <section class="signin-section m-5">
        <div class="container-fluid">
            <div class="row g-0 auth-row">
                <div class="col-lg-6">
                    <div class="auth-cover-wrapper bg-primary-100">
                        <div class="auth-cover">
                            <div class="title text-center">
                                <h1 class="text-primary mb-10">Welcome Back</h1>
                                <p class="text-medium">
                                    Sign in to your Existing account to continue
                                </p>
                            </div>
                            <div class="cover-image">
                                <img src="{{ asset('assets/images/auth/signin-image.svg'); }}" alt="" />
                            </div>
                            <div class="shape-image">
                                <img src="{{ asset('assets/images/auth/shape.svg'); }}" alt="" />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-lg-6">
                    <div class="signin-wrapper">
                        <div class="form-wrapper">
                            <h6 class="mb-15">{{ __('Reset Password') }}</h6>
                            <p class="text-sm mb-25">
                                
                            </p>
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Email Address</label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!-- end col -->
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Password</label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!-- end col -->
                                    <div class="col-12">
                                        <div class="input-style-1">
                                            <label>Confirm Password</label>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-xxl-6 col-lg-12 col-md-6">
                                        <!-- <div class="form-check checkbox-style mb-30">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">
                                                Remember me next time</label>
                                        </div> -->
                                    </div>
                                    <!-- end col -->
                                    <div class="col-xxl-6 col-lg-12 col-md-6">
                                        <div class=" text-start text-md-end text-lg-start text-xxl-end mb-30">
                                            @if (Route::has('password.request'))
                                                <a class="hover-underline" href="{{ route('password.request') }}">Forgot Your Password?</a>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-12">
                                        <div class="button-group d-flex justify-content-center flex-wrap">
                                            <button type="submit" class="main-btn primary-btn btn-hover w-100 text-center">
                                                Reset Password
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->
                            </form>
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </section>
    <!-- ========== signin-section end ========== -->


    <!-- ========= All Javascript files linkup ======== -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js'); }}"></script>
</body>

</html>