<!DOCTYPE html>
<html lang="en">

<head>
    <title>Đăng kí</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('login/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('login/css/style.css') }}">
    <!--===============================================================================================-->
</head>

<body>

    <main class="res-bg">
        <!-- Register Area Start -->
        <div class="register-form-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="register-form text-center mt-2">
                            <!-- Login Heading -->
                            <div class="register-heading">
                                <span>ĐĂNG KÍ</span>
                            </div>

                            <!-- Single Input Fields -->
                            <form class="validate-form" method="post" action="{{ URL::to('check-registration') }}">
                                @csrf
                                <div class="input-box">
                                    <div class="single-input-fields">
                                        <label>Tên người dùng</label>
                                        <input type="text" placeholder="Nhập họ và tên" name="name">
                                    </div>
                                    <div class="single-input-fields mt-4">
                                        <label>Email</label>
                                        <input type="email" placeholder="Nhập email" name="email">
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
                                    <div class="single-input-fields mt-4">
                                        <label>Nhập lại mật khẩu</label>
                                        <input type="password" placeholder="Nhập lại mật khẩu" name="re-password">
                                    </div>
                                    <div class="login-footer mt-4">
                                        <button class="submit-btn3">Đăng kí</button>
                                    </div>
                                </div>
                                <p> Bạn đã có tài khoản? <a href="{{ URL::to('login-customer') }}"> Đăng nhập</a></p>
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
    <script>
        $(document).ready(function() {
            $('.validate-form').validate({
                rules: {
                    email: {
                        required: true,
                    },
                    name: {
                        required: true,
                    },
                    pass: {
                        required: true,
                        minlength: 5
                    },
                    "re-password": {
                        equalTo: "#pass"
                    }
                },
                messages: {
                    email: {
                        required: "Bạn chưa nhập email",
                    },
                    name: {
                        required: "Bạn chưa nhập tên",
                    },
                    pass: {
                        required: "Bạn chưa nhập mật khẩu",
                        minlength: "Mật khẩu ít nhất 5 kí tự"
                    },
                    "re-password": {
                        equalTo: "Mật khẩu nhập lại không khớp với mật khẩu"
                    }
                }
            });
        });

    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('login/js/main.js') }}"></script>

</body>

</html>
