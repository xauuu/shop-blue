@extends('admin-layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="mt-3">Chi tiết đơn hàng</h2>
        </div>
    </div>
    <div class="card">
        <div class="table-responsive">
            <div class="card-header bg-secondary">
                <span class="text-white">Thông tin người đặt</span>
            </div>
            <table class="table mb-3 table-success">
                <thead>
                    <tr class="text-nowrap">
                        <th scope="col">Tên người nhận</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Email</th>
                        <th scope="col">Địa chỉ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $detail_order->shipping->shipping_name }}</td>
                        <td>{{ $detail_order->shipping->shipping_phone }}</td>
                        <td>{{ $detail_order->shipping->shipping_email }}</td>
                        <td>{{ $detail_order->shipping->shipping_address }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="table-responsive">
            <div class="card-header bg-secondary">
                <span class="text-white">Chi tiết đơn hàng</span>
            </div>
            <table class="table mb-3 table-important">
                <thead>
                    <tr class="text-nowrap">
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detail_order->order_detail as $item)
                        <tr>
                            <td>{{ $item->product->product_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->product_price) }} VND</td>
                            <td>{{ number_format($item->product_price * $item->quantity) }} VND</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="table-responsive">
            <div class="card-header bg-secondary">
                <span class="text-white">Mã giảm giá</span>
            </div>
            @if ($detail_order->coupon_code == '')
                <div class="ml-3">Không dùng mã giảm giá</div>
            @else
                <table class="table table-warning">
                    <thead>
                        <tr class="text-nowrap">
                            <th scope="col">Tên mã giảm giá</th>
                            <th scope="col">Số tiền giảm</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $detail_order->coupon_code }}</td>
                            <td>{{ number_format($detail_order->discount) }} VND</td>
                        </tr>
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <div class="card-body text-center">
        <a href="{{ URL::to('/admin/order/confirm-order') }}" class="btn btn-square btn-secondary">Quay lại</a>
        <a href="{{ URL::to('/admin/order/agree-order/' . $detail_order->order_id) }}" class="btn btn-square btn-primary">Xác nhận đơn hàng</a>
        <a href="{{ URL::to('/admin/order/xoa-order/' . $detail_order->order_id) }}" class="btn btn-square btn-danger">Huỷ đơn hàng</a>
    </div>
@endsection
