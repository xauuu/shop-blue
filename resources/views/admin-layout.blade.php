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

    <title>XAU - Dashboard</title>
    <link href="{{ asset('/backend/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/backend/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/backend/css/bootstrap-tagsinput.css') }}" rel="stylesheet">
    <link href="{{ asset('/backend/css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('/backend/css/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('/backend/css/datatables.bundle.css') }}" rel="stylesheet">
</head>

<body>
    @csrf
    <div class="wrapper">
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="{{ URL::to('/admin/dashboard') }}">
                    <span class="align-middle">Xau</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Dashboard
                    </li>

                    <li class="sidebar-item {{ ActiveSegment(2, 'dashboard') }}">
                        <a class="sidebar-link" href="{{ URL::to('/admin/dashboard') }}">
                            <i class="align-middle" data-feather="airplay"></i> <span
                                class="align-middle">Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ ActiveSegment(2, 'statistic') }}">
                        <a class="sidebar-link" href="{{ URL::to('/admin/statistic') }}">
                            <i class="align-middle" data-feather="trending-up"></i> <span class="align-middle">Thống
                                kê</span>
                        </a>
                    </li>
                    @hasrole(['admin'])
                    <li class="sidebar-item {{ ActiveSegment(2, 'user') }}">
                        <a class="sidebar-link" href="{{ URL::to('/admin/user/all-user') }}">
                            <i class="align-middle" data-feather="user"></i> <span class="align-middle">User</span>
                        </a>
                    </li>
                    @endhasrole

                    <li class="sidebar-header">
                        Quản lí
                    </li>

                    @hasrole(['admin', 'manage'])
                    <li class="sidebar-item {{ ActiveSegment(2, 'customer') }}">
                        <a class="sidebar-link" href="{{ URL::to('/admin/customer') }}">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Tài
                                khoản khách hàng</span>
                        </a>
                    </li>
                    @endhasrole

                    <li class="sidebar-item {{ ActiveSegment(2, 'category') }}">
                        <a data-target="#cate" data-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="briefcase"></i> <span class="align-middle">Danh
                                mục</span>
                        </a>
                        <ul id="cate" class="sidebar-dropdown list-unstyled {{ collapse('admin/category/*') }}"
                            data-parent="#sidebar">
                            @hasrole(['admin', 'manage'])
                            <li class="sidebar-item {{ ActiveSegment(3, 'add-category') }}"><a class="sidebar-link"
                                    href="{{ URL::to('/admin/category/add-category') }}">Thêm danh mục</a></li>
                            @endhasrole
                            <li class="sidebar-item {{ ActiveSegment(3, 'all-category') }}"><a class="sidebar-link"
                                    href="{{ URL::to('/admin/category/all-category') }}">Xem danh mục</a></li>
                        </ul>
                    </li>

                    <li class="sidebar-item {{ ActiveSegment(2, 'brand') }}">
                        <a data-target="#bra" data-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="layers"></i> <span class="align-middle">Thương
                                hiệu</span>
                        </a>
                        <ul id="bra" class="sidebar-dropdown list-unstyled {{ collapse('admin/brand/*') }}"
                            data-parent="#sidebar">
                            @hasrole(['admin', 'manage'])
                            <li class="sidebar-item {{ ActiveSegment(3, 'add-brand') }}"><a class="sidebar-link"
                                    href="{{ URL::to('/admin/brand/add-brand') }}">Thêm thương hiệu</a>
                            </li>
                            @endhasrole
                            <li class="sidebar-item {{ ActiveSegment(3, 'all-brand') }}"><a class="sidebar-link"
                                    href="{{ URL::to('/admin/brand/all-brand') }}">Xem thương hiệu</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item {{ ActiveSegment(2, 'product') }}">
                        <a data-target="#pro" data-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="send"></i> <span class="align-middle">Sản phẩm</span>
                        </a>
                        <ul id="pro" class="sidebar-dropdown list-unstyled {{ collapse('admin/product/*') }}"
                            data-parent="#sidebar">
                            @hasrole(['admin', 'manage'])
                            <li class="sidebar-item {{ ActiveSegment(3, 'add-product') }}"><a class="sidebar-link"
                                    href="{{ URL::to('/admin/product/add-product') }}">Thêm sản phẩm</a>
                            </li>
                            @endhasrole
                            <li class="sidebar-item {{ ActiveSegment(3, 'all-product') }}"><a class="sidebar-link"
                                    href="{{ URL::to('/admin/product/all-product') }}">Xem sản phẩm</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item {{ ActiveSegment(2, 'order') }}">
                        <a data-target="#order" data-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Đơn
                                hàng</span>
                        </a>
                        <ul id="order" class="sidebar-dropdown list-unstyled {{ collapse('admin/order/*') }}"
                            data-parent="#sidebar">
                            <li class="sidebar-item {{ ActiveSegment(3, 'confirm-order') }}"><a class="sidebar-link"
                                    href="{{ URL::to('/admin/order/confirm-order') }}">Xác nhận đơn hàng</a>
                            </li>
                            <li class="sidebar-item {{ ActiveSegment(3, 'success-order') }}"><a class="sidebar-link"
                                    href="{{ URL::to('/admin/order/success-order') }}">Đơn hàng đã xác nhận</a>
                            </li>
                            <li class="sidebar-item {{ ActiveSegment(3, 'cancel-order') }}"><a class="sidebar-link"
                                    href="{{ URL::to('/admin/order/cancel-order') }}">Đơn hàng đã huỷ</a>
                            </li>
                            <li class="sidebar-item {{ ActiveSegment(3, 'all-order') }}"><a class="sidebar-link"
                                    href="{{ URL::to('/admin/order/all-order') }}">Xem tất cả đơn hàng</a>
                            </li>
                        </ul>
                    </li>

                    @hasrole(['admin', 'manage'])
                    <li class="sidebar-item {{ ActiveSegment(2, 'coupon') }}">
                        <a data-target="#coupon" data-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="slack"></i> <span class="align-middle">Mã giảm
                                giá</span>
                        </a>
                        <ul id="coupon" class="sidebar-dropdown list-unstyled {{ collapse('admin/coupon/*') }}"
                            data-parent="#sidebar">
                            <li class="sidebar-item {{ ActiveSegment(3, 'add-coupon') }}"><a class="sidebar-link"
                                    href="{{ URL::to('/admin/coupon/add-coupon') }}">Thêm mã giảm giá</a>
                            </li>
                            <li class="sidebar-item{{ ActiveSegment(3, 'all-coupon') }}"><a class="sidebar-link"
                                    href="{{ URL::to('/admin/coupon/all-coupon') }}">Xem mã giảm giá</a>
                            </li>
                        </ul>
                    </li>
                    @endhasrole

                    @hasrole(['admin', 'manage'])
                    <li class="sidebar-item {{ ActiveSegment(2, 'comment') }}">
                        <a class="sidebar-link" href="{{ URL::to('/admin/comment/show-comment') }}">
                            <i class="align-middle" data-feather="message-square"></i> <span class="align-middle">Bình
                                luận</span>
                        </a>
                    </li>
                    @endhasrole

                    <li class="sidebar-header">
                        Bài viết
                    </li>

                    <li class="sidebar-item {{ ActiveSegment(2, 'category_post') }}">
                        <a data-target="#catepost" data-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="list"></i> <span class="align-middle">Danh
                                mục bài viết</span>
                        </a>
                        <ul id="catepost" class="sidebar-dropdown list-unstyled {{ collapse('admin/category_post/*') }}"
                            data-parent="#sidebar">
                            @hasrole(['admin', 'manage'])
                            <li class="sidebar-item {{ ActiveSegment(3, 'add-category-post') }}"><a class="sidebar-link"
                                    href="{{ URL::to('/admin/category_post/add-category-post') }}">Thêm danh mục bài
                                    viết</a>
                            </li>
                            @endhasrole
                            <li class="sidebar-item {{ ActiveSegment(3, 'all-category-post') }}"><a class="sidebar-link"
                                    href="{{ URL::to('/admin/category_post/all-category-post') }}">Xem
                                    danh mục bài viết</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item {{ ActiveSegment(2, 'post') }}">
                        <a data-target="#post" data-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Bài
                                viết</span>
                        </a>
                        <ul id="post" class="sidebar-dropdown list-unstyled {{ collapse('admin/post/*') }}"
                            data-parent="#sidebar">
                            @hasrole(['admin', 'manage'])
                            <li class="sidebar-item {{ ActiveSegment(3, 'add-post') }}"><a class="sidebar-link"
                                    href="{{ URL::to('/admin/post/add-post') }}">Thêm bài viết</a>
                            </li>
                            @endhasrole
                            <li class="sidebar-item {{ ActiveSegment(3, 'all-post') }}"><a class="sidebar-link"
                                    href="{{ URL::to('/admin/post/all-post') }}">Xem bài viết</a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-header">
                        Giao diện
                    </li>

                    @hasrole(['admin', 'manage'])
                    <li class="sidebar-item {{ ActiveSegment(2, 'sale') }}">
                        <a class="sidebar-link" href="{{ URL::to('/admin/sale/all-sale') }}">
                            <i class="align-middle" data-feather="percent"></i> <span class="align-middle">Siêu
                                sale</span>
                        </a>
                    </li>
                    @endhasrole

                    <li class="sidebar-item {{ Request::is('admin/slider/*') ? 'active' : '' }}">
                        <a data-target="#slider" data-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Slider</span>
                        </a>
                        <ul id="slider" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                            @hasrole(['admin', 'manage'])
                            <li class="sidebar-item"><a class="sidebar-link"
                                    href="{{ URL::to('/admin/slider/add-slider') }}">Thêm slider</a>
                            </li>
                            @endhasrole
                            <li class="sidebar-item"><a class="sidebar-link"
                                    href="{{ URL::to('/admin/slider/all-slider') }}">Danh sách slider</a>
                            </li>
                        </ul>
                    </li>

                    @hasrole(['admin', 'manage'])
                    <li class="sidebar-item {{ ActiveSegment(2, 'contact') }}">
                        <a class="sidebar-link" href="{{ URL::to('/admin/contact') }}">
                            <i class="align-middle" data-feather="phone"></i> <span class="align-middle">Liên hệ</span>
                        </a>
                    </li>
                    @endhasrole

                    <li class="sidebar-item {{ ActiveSegment(2, 'faq') }}">
                        <a class="sidebar-link" href="{{ URL::to('/admin/faq/all-faq') }}">
                            <i class="align-middle" data-feather="help-circle"></i> <span
                                class="align-middle">FAQ</span>
                        </a>
                    </li>
                </ul>

            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg sticky-top">
                <a class="sidebar-toggle d-flex">
                    <i class="hamburger align-self-center"></i>
                </a>

                <form class="d-none d-sm-inline-block">
                    <div class="input-group input-group-navbar">
                        <input type="text" class="form-control" placeholder="Search…" aria-label="Search">
                        <button class="btn" type="button">
                            <i class="align-middle" data-feather="search"></i>
                        </button>
                    </div>
                </form>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="bell"></i>
                                    <span class="indicator">4</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0"
                                aria-labelledby="alertsDropdown">
                                <div class="dropdown-menu-header">
                                    4 New Notifications
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-danger" data-feather="alert-circle"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Update completed</div>
                                                <div class="text-muted small mt-1">Restart server 12 to complete the
                                                    update.</div>
                                                <div class="text-muted small mt-1">30m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-warning" data-feather="bell"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Lorem ipsum</div>
                                                <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate
                                                    hendrerit et.</div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-primary" data-feather="home"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Login from 192.186.1.8</div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-success" data-feather="user-plus"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">New connection</div>
                                                <div class="text-muted small mt-1">Christina accepted your request.
                                                </div>
                                                <div class="text-muted small mt-1">14h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all notifications</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="message-square"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0"
                                aria-labelledby="messagesDropdown">
                                <div class="dropdown-menu-header">
                                    <div class="position-relative">
                                        4 New Messages
                                    </div>
                                </div>
                                {{-- <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="img/avatars/avatar-5.jpg"
                                                    class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                            </div>
                                            <div class="col-10 pl-2">
                                                <div class="text-dark">Vanessa Tucker</div>
                                                <div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu
                                                    tortor.</div>
                                                <div class="text-muted small mt-1">15m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="img/avatars/avatar-2.jpg"
                                                    class="avatar img-fluid rounded-circle" alt="William Harris">
                                            </div>
                                            <div class="col-10 pl-2">
                                                <div class="text-dark">William Harris</div>
                                                <div class="text-muted small mt-1">Curabitur ligula sapien euismod
                                                    vitae.</div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="img/avatars/avatar-4.jpg"
                                                    class="avatar img-fluid rounded-circle" alt="Christina Mason">
                                            </div>
                                            <div class="col-10 pl-2">
                                                <div class="text-dark">Christina Mason</div>
                                                <div class="text-muted small mt-1">Pellentesque auctor neque nec urna.
                                                </div>
                                                <div class="text-muted small mt-1">4h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="img/avatars/avatar-3.jpg"
                                                    class="avatar img-fluid rounded-circle" alt="Sharon Lessman">
                                            </div>
                                            <div class="col-10 pl-2">
                                                <div class="text-dark">Sharon Lessman</div>
                                                <div class="text-muted small mt-1">Aenean tellus metus, bibendum sed,
                                                    posuere ac, mattis non.</div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div> --}}
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all messages</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#"
                                data-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>
                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#"
                                data-toggle="dropdown">
                                <img src="{{ asset('uploads/' . Auth::user()->avatar) }}"
                                    class="avatar img-fluid rounded mr-1" alt="" />
                                <span class="text-dark">{{ Auth::user()->name }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="pages-profile.html"><i class="align-middle mr-1"
                                        data-feather="user"></i> Thông tin</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="pages-settings.html"><i class="align-middle mr-1"
                                        data-feather="settings"></i> Cài đặt</a>
                                <a class="dropdown-item" href="#"><i class="align-middle mr-1"
                                        data-feather="help-circle"></i> Trợ giúp</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ URL::to('admin/logout') }}">Đăng xuất</a>
                            </div>
                            {{--
                            --}}
                        </li>
                    </ul>
                </div>
            </nav>

            @yield('content')

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-left">
                            <p class="mb-0">
                                <a href="index.html" class="text-muted"><strong>XAU</strong></a> &copy;
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @csrf
    <script src="{{ asset('backend/js/app.js') }}"></script>
    <script src="{{ asset('backend/js/jquery-3.5.0.min.js') }}"></script>
    <script src="{{ asset('backend/js/bootstrap-tagsinput.min.js') }}"></script>
    {{-- Ckeditor --}}
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    {{-- Validate --}}
    <script src="{{ asset('backend/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/js/additional-methods.min.js') }}"></script>
    <script src="{{ asset('backend/js/validate.js') }}"></script>
    {{-- End Validate --}}
    {{-- Date Picker --}}
    <script src="{{ asset('backend/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('backend/js/moment.min.js') }}"></script>
    <script src="{{ asset('backend/js/daterangepicker.min.js') }}"></script>
    {{-- End date picker --}}
    {{-- Data Table --}}
    <script src="{{ asset('backend/js/datatables.bundle.js') }}"></script>
    {{-- End Data Table --}}
    <script src="{{ asset('backend/js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>
