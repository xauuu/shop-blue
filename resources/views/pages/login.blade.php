<!DOCTYPE html>
<html lang="en">

<head>
    <title>Đăng nhập</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
</head>

<body>

    <main class="login-bg">
        <!-- Register Area Start -->
        <div class="register-form-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="register-form text-center mt-3">
                            <!-- Login Heading -->
                            <div class="register-heading">
                                <span>ĐĂNG NHẬP</span>
                            </div>
                            <!-- Single Input Fields -->
                            <form method="post" action="{{ URL::to('check-login') }}">
                                @csrf
                                <div class="input-box">
                                    <div class="single-input-fields">
                                        <label>Email</label>
                                        <input type="email" placeholder="Nhập email" name="email" value="{{ old('email') }}">
                                        @if (session('error'))
                                            <label class="error">
                                                {{ session('error') }}
                                            </label>
                                        @endif
                                    </div>
                                    <div class="single-input-fields mt-4">
                                        <label>Mât khẩu</label>
                                        <input id="pass" type="password" placeholder="Nhâp mật khẩu của bạn"
                                            name="pass">
                                    </div>
                                    <div class="single-input-fields login-check">
                                        <input type="checkbox" id="fruit1" name="keep-log">
                                        <a href="#" class="f-right">Quên mật khẩu?</a>
                                    </div>
                                    <div class="login-footer mt-4">
                                        <button class="submit-btn3">Đăng nhập</button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div>HOẶC</div>
                                    <div>
                                        <a class="fb" href="{{ URL::to('/login-facebook') }}"><i
                                                class="fa fa-facebook-f"></i></a>
                                        <a class="gg" href="{{ URL::to('/login-google') }}"><i
                                                class="fa fa-google"></i></i></a>
                                    </div>
                                </div>
                                <p>Bạn chưa có tài khoản? <a href="{{ URL::to('registration') }}">Đăng kí</a> ngay</p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Register Area End -->
    </main>

    <!--===============================================================================================-->
    <script src="{{ asset('login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('login/js/jquery-validate.js') }}"></script>

</body>

</html>
