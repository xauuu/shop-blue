<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <title>XAU | Sign in</title>

    <link href="{{ asset('backend/css/app.css') }}" rel="stylesheet">
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">Welcome back, Xau</h1>
                            <p class="lead">
                                Đăng nhập vào tài khoản của bạn để tiếp tục
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <div class="text-center">
                                        <img src="{{ URL::to('uploads/xau.jpg') }}" alt="Charles Hall"
                                            class="img-fluid rounded-circle" width="132" height="132" />
                                    </div>
                                    <form action="{{ URL::to('admin/checklogin') }}" method="post">
                                        {{ csrf_field() }}
                                        <div>
                                            <label class="form-label">Email</label>
                                            <input class="form-control form-control-lg" type="email" name="email"
                                                placeholder="Nhập email của bạn" value="{{ old('email') }}"/>
                                        </div>
                                        @php
                                            $err = Session::get('error');
                                            if ($err) {
                                                echo '<span style="color: red">'.$err.'</span>';
                                            }
                                        @endphp
                                        <div class="mt-3 mb-3">
                                            <label class="form-label">Mật khẩu</label>
                                            <input class="form-control form-control-lg" type="password" name="password"
                                                placeholder="Nhập mật khẩu của bạn"/>
                                            <small>
                                                <a href="pages-reset-password.html">Quên mật khẩu?</a>
                                            </small>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">Đăng nhập</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="{{ 'backend/js/app.js' }}"></script>

</body>

</html>
