@extends('admin-layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="mt-3">Danh sách slider</h2>
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
            <table class="table mb-0 ml-2">
                <thead>
                    <tr>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Tiêu đề</th>
                        <th scope="col">Giảm giá</th>
                        <th scope="col">Nội dung</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($slider as $item)
                        <tr>
                            <td><img width="150" src="{{ URL::to('uploads/slider/' . $item->slider_img) }}"></td>
                            <td>{{ $item->slider_name }}</td>
                            <td> {!! $item->slider_title !!} </td>
                            <td>{{ $item->slider_discount }}</td>
                            <td>{!! $item->slider_content !!}</td>
                            <td>
                                @if ($item->slider_status == 0)
                                    <a class="btn btn-outline-primary" href="{{ URL::to('admin/slider/slider_status/' . $item->slider_id) }}">Ẩn</a>
                                @else
                                    <a class="btn btn-outline-primary" href="{{ URL::to('admin/slider/slider_status/' . $item->slider_id) }}">Hiển
                                        thị</a>
                                @endif
                            </td>
                            <td class="text-nowrap">
                                <a class="btn btn-outline-danger" title="Xoá slider"
                                    onclick="return confirm('Xoá sản slider')"
                                    href="{{ URL::to('/admin/slider/delete-slider/' . $item->slider_id) }}">
                                    <i class="align-middle" data-feather="trash-2"></i></a>
                                <a class="btn btn-outline-warning" title="Sửa slider"
                                    href="{{ URL::to('/admin/slider/edit-slider/' . $item->slider_id) }}">
                                    <i class="align-middle" data-feather="edit"></i></a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            {{-- <div class="float-right mt-2">
                {!! $slider->render('vendor.pagination.custom') !!}
            </div> --}}
        </div>
    </div>
@endsection
