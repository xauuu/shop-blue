@extends('layout')
@section('content')
    <div class="page-top-info">
        <div class="container">
            <h4>Đơn hàng của bạn</h4>
            <div class="site-pagination">
                <a href="">Trang chủ</a> /
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                <div id="accordion">
                    @foreach ($order as $item => $order)
                        <div class="card mb-3">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#order{{ $order->order_id }}">
                                    <div class="your_order_header">
                                        <div>Ngày đặt hàng: {{ $order->created_at }}</div>
                                        <div>Trạng thái:
                                            <span>
                                                @if ($order->order_status == 0)
                                                    Đang chờ xác nhận
                                                @elseif($order->order_status == 1)
                                                    Đã xác nhận
                                                @else
                                                    Đã huỷ
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div id="order{{ $order->order_id }}" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <div class=" mb-3">
                                        @if ($order->order_status == 0)
                                            <a class="btn btn-outline-warning"
                                                href="{{ URL::to('cancel-order/' . $order->order_id) }}">Huỷ đơn hàng</a>
                                        @elseif($order->order_status == 1)
                                            <a class="btn btn-success disabled" href="">Đã xác nhận</a>
                                        @else
                                            <a class="btn btn-danger     disabled" href="">Đã huỷ</a>
                                        @endif

                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div>
                                                <h5 class="mb-2">Thông tin giao hàng</h5>
                                                <p>Tên người nhận: {{ $order->shipping->shipping_name }}</p>
                                                <p>Địa chỉ: {{ $order->shipping->shipping_address }}</p>
                                                <p>Số điện thoại: {{ $order->shipping->shipping_phone }}</p>
                                                <p>Email: {{ $order->shipping->shipping_email }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <h5>Chi tiết đơn hàng</h5>
                                            <div class="your_order">
                                                <div class="your_order_content">
                                                    @foreach ($order->order_detail as $item => $pro)
                                                        <div class="your_order_product">
                                                            <div class="your_order_product_img">
                                                                <img src="{{ URL::to('uploads/product/' . $pro->product->product_img) }}"
                                                                    alt="">
                                                            </div>
                                                            <div class="your_order_product_detail">
                                                                <div class="your_order_product_name">
                                                                    {{ $pro->product->product_name }}
                                                                </div>
                                                                <div class="your_order_product_price">
                                                                    {{ number_format($pro->product_price) }} VND
                                                                </div>
                                                                <div class="your_order_product_qty">
                                                                    x{{ $pro->quantity }}
                                                                </div>
                                                            </div>
                                                            <div class="your_order_product_total">
                                                                {{ number_format($pro->product_price * $pro->quantity) }}
                                                                VND
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="your_order_footer">
                                                    <div>Tổng số tiền: <span>{{ number_format($order->order_total) }} VND
                                                        </span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
