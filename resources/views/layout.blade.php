<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>BLUE - Because Love U Everyday</title>
    <meta charset="UTF-8">
    <meta name="description" content=" Divisima | eCommerce Template">
    <meta name="keywords" content="divisima, eCommerce, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link href="{{ asset('frontend/img/icons/zz.png') }}" rel="shortcut icon" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" />
    @stack('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/flaticon.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/slicknav.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/sweetalert.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/easydropdown.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.fancybox.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/toastr.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/css/xau.css') }}" />



    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
 <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
 <![endif]-->

</head>

<body>
    <!-- Page Preloder -->
    <a id="backtotop"></a>
    <div id="preloder">
        <div class="loader"></div>
    </div>
    @php
    if (Request::segment(1) != 'login-customer' || Request::segment(1) != 'registration') {
    Session::put('backUrl', url()->current());
    }
    @endphp
    <input type="hidden" name="this_url" value="{{ url('/') }}">
    <!-- Header section -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 text-center text-lg-left">
                        <!-- logo -->
                        <a href="{{ URL::to('/home') }}" class="site-logo">
                            <img src="{{ asset('frontend/img/logoo.png') }}" alt="">
                        </a>
                    </div>
                    <div class="col-xl-6 col-lg-5">
                        <form method="post" action="{{ URL::to('search') }}" class="header-search-form"
                            autocomplete="off">
                            @csrf
                            <input name="search" type="text" placeholder="Nhập tên sản phẩm hoặc giá ....">
                            <button type="submit"><i class="flaticon-search"></i></button>
                        </form>
                        <div id="search-list"></div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="user-panel float-right">
                            <div class="up-item">
                                <div class="shopping-card">
                                    <a href="{{ URL::to('/cart') }}">
                                        <i class="flaticon-bag"></i>
                                        <span id="slsp">
                                            @php
                                            echo Cart::content()->count();
                                            @endphp
                                        </span>
                                        Giỏ hàng
                                    </a>
                                </div>
                            </div>
                            <div class="up-item">
                                <ul class="main-menu-us">
                                    @if (session('customer_id'))
                                        <li>
                                            <a href="{{ URL::to('my-account') }}">
                                                @if (session('customer_avatar') == '')
                                                    <i class="flaticon-profile"></i>
                                                @else
                                                    <img class="avatar" src="{{ session('customer_avatar') }}" alt="">
                                                @endif
                                                <span>{{ session('customer_name') }}</span>
                                            </a>
                                            <ul class="sub-menu">
                                                <li><a href="{{ URL::to('/your-order') }}">Đơn hàng</a></li>
                                                <li><a href="{{ URL::to('/logout') }}">Đăng xuất</a></li>
                                            </ul>
                                        </li>
                                    @else
                                        <li><i class="flaticon-profile"></i> <span>Tài khoản</span>
                                            <ul class="sub-menu">
                                                <li><a href="{{ URL::to('/login-customer') }}">Đăng nhập</a></li>
                                                <li><a href="{{ URL::to('/registration') }}">Đăng kí</a></li>
                                            </ul>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="main-navbar">
            <div class="container">
                <!-- menu -->
                <ul class="main-menu">
                    <li><a href="{{ URL::to('/home') }}">Trang chủ</a></li>
                    <li><a href="{{ URL::to('/shop') }}">Shop</a></li>
                    @foreach ($category as $item => $cate)
                        @if ($cate->category_parent == 0)
                            <li><a
                                    href="{{ URL::to('category/' . $cate->category_slug) }}">{{ $cate->category_name }}</a>
                                <ul class="sub-menu">
                                    @foreach ($category as $item => $cate_chill)
                                        @if ($cate_chill->category_parent == $cate->category_id)
                                            <li><a
                                                    href="{{ URL::to('category/' . $cate_chill->category_slug) }}">{{ $cate_chill->category_name }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endforeach
                    <li><a href="{{ URL::to('/blog') }}">Blog</a></li>
                    <li><a href="{{ URL::to('/contact') }}">Liên hệ</a></li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Header section end -->

    @yield('content')
    <!-- Footer section -->
    <section class="footer-section">
        <div class="container">
            <div class="footer-logo text-center">
                <a href="index.html"><img src="{{ asset('frontend/./img/light.png') }}" alt=""></a>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget about-widget">
                        <h2>About</h2>
                        <p>Donec vitae purus nunc. Morbi faucibus erat sit amet congue mattis. Nullam frin-gilla
                            faucibus urna, id dapibus erat iaculis ut. Integer ac sem.</p>
                        <img src="{{ asset('frontend/img/cards.png') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget about-widget">
                        <h2>Questions</h2>
                        <ul>
                            <li><a href="">Về chúng tôi</a></li>
                            <li><a href="">Theo dõi đơn hàng</a></li>
                            <li><a href="">Blogs</a></li>
                            <li><a href="">Điều khoản sử dụng</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget about-widget">
                        <h2>Questions</h2>
                        <div class="fw-latest-post-widget">
                            <div class="lp-item">
                                <div class="lp-thumb set-bg" data-setbg="{{ asset('frontend/img/blog-thumbs/1.jpg') }}">
                                </div>
                                <div class="lp-content">
                                    <h6>what shoes to wear</h6>
                                    <span>Oct 21, 2018</span>
                                    <a href="#" class="readmore">Read More</a>
                                </div>
                            </div>
                            <div class="lp-item">
                                <div class="lp-thumb set-bg" data-setbg="{{ asset('frontend/img/blog-thumbs/2.jpg') }}">
                                </div>
                                <div class="lp-content">
                                    <h6>trends this year</h6>
                                    <span>Oct 21, 2018</span>
                                    <a href="#" class="readmore">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="footer-widget contact-widget">
                        <h2>Information</h2>
                        <div class="con-info">
                            <span>C.</span>
                            <p>{{ $contact->contact_company }} </p>
                        </div>
                        <div class="con-info">
                            <span>A.</span>
                            <p>{{ $contact->contact_address }} </p>
                        </div>
                        <div class="con-info">
                            <span>P.</span>
                            <p>{{ $contact->contact_phone }}</p>
                        </div>
                        <div class="con-info">
                            <span>E.</span>
                            <p>{{ $contact->contact_email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="social-links-warp">
            <div class="container">
                <div class="social-links">
                    <a href="" class="instagram"><i class="fa fa-instagram"></i><span>instagram</span></a>
                    <a href="" class="google-plus"><i class="fa fa-google-plus"></i><span>g+plus</span></a>
                    <a href="" class="pinterest"><i class="fa fa-pinterest"></i><span>pinterest</span></a>
                    <a href="" class="facebook"><i class="fa fa-facebook"></i><span>facebook</span></a>
                    <a href="" class="twitter"><i class="fa fa-twitter"></i><span>twitter</span></a>
                    <a href="" class="youtube"><i class="fa fa-youtube"></i><span>youtube</span></a>
                    <a href="" class="tumblr"><i class="fa fa-tumblr-square"></i><span>tumblr</span></a>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer section end -->



    <!--====== Javascripts & Jquery ======-->
    <script src="{{ asset('frontend/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend/js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.easydropdown.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('frontend/js/toastr.min.js') }}"></script>
    <script src="{{ asset('frontend/js/topbar.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('frontend/js/xau.js') }}"></script>
    @stack('script')
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v9.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

    </script>

    <!-- Your Chat Plugin code -->
    <div class="fb-customerchat" attribution=setup_tool page_id="100895738606966" theme_color="#ff5ca1"
        logged_in_greeting="Xin chào, Shop có thể giúp gì cho bạn?"
        logged_out_greeting="Xin chào, Shop có thể giúp gì cho bạn?">
    </div>
</body>

</html>
