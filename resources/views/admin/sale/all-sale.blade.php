@extends('admin-layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="mt-3">Danh sách sale</h2>
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
        </div>
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr class="text-nowrap">
                        <th scope="col">Tên sale</th>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Sale</th>
                        <th scope="col">Thời gian kết thúc</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sale as $item)
                        <tr>
                            <td>{{ $item->sale_name }}</td>
                            <td>{{ $item->product->product_name }}</td>
                            <td><img width="150" src="{{ asset('uploads/sale/'.$item->sale_img) }}" alt="{{ $item->product->product_name }}"> </td>
                            <td>{{ $item->sale_percent }}%</td>
                            <td>{{ $item->sale_time }}</td>
                            <td>
                                <a class="btn btn-outline-danger" onclick="return confirm('Xoá sale này này')" href="{{ URL::to('/admin/sale/delete-sale/' . $item->sale_id) }}">
                                    <i class="align-middle" data-feather="trash-2"></i></a>
                                <a class="btn btn-outline-warning" href="{{ URL::to('/admin/sale/edit-sale/' . $item->sale_id) }}">
                                    <i class="align-middle" data-feather="edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            <div class="m-2">
                <a class="btn btn-primary" href="{{ URL::to('admin/sale/add-sale') }}">Thêm sale</a>
            </div>
    </div>
@endsection
