@extends('admin-layout')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row mb-2 mb-xl-3">
                <div class="col-auto d-none d-sm-block">
                    <h3><strong>Thống kê doanh số</strong></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-5">
                    <div class="w-100">
                        <div class="row">
                            <h4>Tuần này</h4>
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Lượng truy cập</h5>
                                        <h3 class="mt-1 mb-3">14.212</h3>
                                        {{-- <div class="mb-1">
                                            <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.25%
                                            </span>
                                            <span class="text-muted">so với tuần trước</span>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Đã bán</h5>
                                        <h3 class="mt-1 mb-3">
                                            {{ $statistic_week->qty }} sản phẩm
                                        </h3>
                                        {{-- <div class="mb-1">
                                            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65%
                                            </span>
                                            <span class="text-muted">so với tuần trước</span>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Thu nhập</h5>
                                        <h3 class="mt-1 mb-3">
                                            {{ number_format($statistic_week->sales) }} VND
                                        </h3>
                                        {{-- <div class="mb-1">
                                            <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 6.65%
                                            </span>
                                            <span class="text-muted">so với tuần trước</span>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Đơn hàng</h5>
                                        <h3 class="mt-1 mb-3">
                                            {{ $statistic_week->total }}
                                        </h3>
                                        {{-- <div class="mb-1">
                                            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.25%
                                            </span>
                                            <span class="text-muted">so với tuần trước</span>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-xxl-5">
                    <div class="w-100">
                        <div class="row">
                            <h4>Tháng này</h4>
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Lượng truy cập</h5>
                                        <h3 class="mt-1 mb-3">14.212</h3>
                                        {{-- <div class="mb-1">
                                            <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.25%
                                            </span>
                                            <span class="text-muted">so với tuần trước</span>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Đã bán</h5>
                                        <h3 class="mt-1 mb-3">
                                            {{ $statistic_month->qty }} sản phẩm
                                        </h3>
                                        {{-- <div class="mb-1">
                                            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65%
                                            </span>
                                            <span class="text-muted">so với tuần trước</span>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Thu nhập</h5>
                                        <h3 class="mt-1 mb-3">
                                            {{ number_format($statistic_month->sales) }} VND
                                        </h3>
                                        {{-- <div class="mb-1">
                                            <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 6.65%
                                            </span>
                                            <span class="text-muted">so với tuần trước</span>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Đơn hàng</h5>
                                        <h3 class="mt-1 mb-3">
                                            {{ $statistic_month->total }}
                                        </h3>
                                        {{-- <div class="mb-1">
                                            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.25%
                                            </span>
                                            <span class="text-muted">so với tuần trước</span>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-xxl-5">
                    <div class="w-100">
                        <div class="row">
                            <h4>Tổng cộng</h4>
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Lượng truy cập</h5>
                                        <h3 class="mt-1 mb-3">14.212</h3>
                                        {{-- <div class="mb-1">
                                            <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.25%
                                            </span>
                                            <span class="text-muted">so với tuần trước</span>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Đã bán</h5>
                                        <h3 class="mt-1 mb-3">
                                            {{ $statistic_total->qty }} sản phẩm
                                        </h3>
                                        {{-- <div class="mb-1">
                                            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65%
                                            </span>
                                            <span class="text-muted">so với tuần trước</span>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Thu nhập</h5>
                                        <h3 class="mt-1 mb-3">
                                            {{ number_format($statistic_total->sales) }} VND
                                        </h3>
                                        {{-- <div class="mb-1">
                                            <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 6.65%
                                            </span>
                                            <span class="text-muted">so với tuần trước</span>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Đơn hàng</h5>
                                        <h3 class="mt-1 mb-3">
                                            {{ $statistic_total->total }}
                                        </h3>
                                        {{-- <div class="mb-1">
                                            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.25%
                                            </span>
                                            <span class="text-muted">so với tuần trước</span>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
