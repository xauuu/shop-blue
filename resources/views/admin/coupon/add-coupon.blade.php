@extends('admin-layout')
@section('content')
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card mt-1">
                <div class="card-header">
                    <h2 class="mt-3">Thêm mã giảm giá</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ URL::to('/admin/coupon/save-coupon') }}">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label class="form-label">Tên mã giảm giá</label>
                            <input type="text" class="form-control" name="coupon_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mã giảm giá</label>
                            <input type="text" class="form-control" name="coupon_code" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số lượng giảm giá</label>
                            <input type="text" class="form-control" name="coupon_times" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tính năng mã</label>
                            <select class="form-control mb-3" name="coupon_feature">
                                <option value="" selected>--- Chọn tính năng của mã ---</option>
                                <option value="1">Giảm theo phần trăm</option>
                                <option value="2">Giảm theo tiền</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nhập số % hoặc tiền giảm</label>
                            <input class="form-control" name="coupon_number" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm mã giảm giá</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
