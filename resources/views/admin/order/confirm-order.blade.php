@extends('admin-layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="mt-3">Danh sách đơn hàng</h2>
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
                        <th scope="col">Tên người đặt</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_order as $item)
                        <tr>
                            <td>{{ $item->customer_name }}</td>
                            <td>{!! number_format($item->order_total) !!} VND</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                @php
                                if($item->order_status == 0){
                                echo '<span class="badge bg-info">Đang chờ xác nhận</span>';
                                }elseif ($item->order_status == 1){
                                echo '<span class="badge bg-success">Đã xác nhận</span>';
                                }else{
                                echo '<span class="badge bg-danger">Đã huỷ</span>';
                                }
                                @endphp
                            </td>
                            <td><a class="btn btn-outline-info"
                                    href="{{ URL::to('admin/order/detail-order/' . $item->order_id) }}">
                                    <i class="align-middle" data-feather="eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="float-right mt-2">
                {!! $all_order->render('vendor.pagination.custom') !!}
            </div>
        </div>
    </div>
@endsection
