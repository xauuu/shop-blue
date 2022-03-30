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
                        <th style="width: 5%" scope="col">#</th>
                        <th style="width: 25%" scope="col">Tên thương hiệu</th>
                        <th style="width: 45%" scope="col">Mô tả</th>
                        <th style="width: 10%" scope="col">Trạng thái</th>
                        <th style="width: 15%" scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($brand as $item)
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ $item->brand_name }}</td>
                            <td>{{ $item->brand_desc }}</td>
                            <td>
                                @if ($item->brand_status == 0)
                                    <a href="{{ URL::to('admin/brand/active-brand/' . $item->brand_id) }}">Ẩn</a>
                                @else
                                    <a href="{{ URL::to('admin/brand/unactive-brand/' . $item->brand_id) }}">Hiển
                                        thị</a>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-outline-danger" onclick="return confirm('Xoá thương hiệu này')" href="{{ URL::to('/admin/brand/delete-brand/' . $item->brand_id) }}">
                                    <i class="align-middle" data-feather="trash-2"></i></a>
                                <a class="btn btn-outline-warning" href="{{ URL::to('/admin/brand/edit-brand/' . $item->brand_id) }}">
                                    <i class="align-middle" data-feather="edit"></i></a>
                            </td>
                        </tr>
                    @php
                        $i++;
                    @endphp
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
