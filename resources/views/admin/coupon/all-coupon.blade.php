@extends('admin-layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="mt-3">Danh sách thương hiệu</h2>
            @if (session('success'))
                <div class="alert alert-primary alert-dismissible col-6" role="alert">
                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon">
                        <i class="far fa-fw fa-bell"></i>
                    </div>
                    <div class="alert-message">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            <div>

            </div>
        </div>

        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr class="text-nowrap">
                        <th scope="col">Tên mã giảm giá</th>
                        <th scope="col">Mã giảm giá</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Tính năng</th>
                        <th scope="col">Giảm giá</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($coupon as $item)
                        <tr>
                            <td>{{ $item->coupon_name }}</td>
                            <td>{{ $item->coupon_code }}</td>
                            <td>{{ $item->coupon_times }}</td>
                            <td>
                                @if ($item->coupon_feature == 1)
                                    Giảm theo phần trăm
                                @else
                                    Giảm theo tiền
                                @endif
                            </td>
                            <td>
                                @if ($item->coupon_feature == 1)
                                    Giảm {{ $item->coupon_number }}%
                                @else
                                    Giảm {{ number_format($item->coupon_number) }} VND
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-outline-danger" onclick="return confirm('Xoá mã giảm giá này')"
                                    href="{{ URL::to('/admin/coupon/delete-coupon/' . $item->coupon_id) }}">
                                    <i class="align-middle" data-feather="trash-2"></i></a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
