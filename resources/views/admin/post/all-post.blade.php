@extends('admin-layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="mt-3">Danh sách bài viết</h2>
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
                        <th scope="col">#</th>
                        <th scope="col">Tiêu đề bài viết</th>
                        <th scope="col">Mô tả</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($post as $item => $value1)
                        <tr>
                            <th scope="row">{{ $value1->post_id }}</th>
                            <td>{{ $value1->post_title }}</td>
                            <td>{{ $value1->post_desc }}</td>
                            <td>
                                @if ($value1->post_status == 0)
                                    <a href="{{ URL::to('admin/post/status-post/' . $value1->post_id) }}">
                                    @else
                                        <a href="{{ URL::to('admin/post/status-post/' . $value1->post_id) }}">Hiển
                                            thị</a>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-outline-danger" onclick="return confirm('Xoá danh mục này')"
                                    href="{{ URL::to('/admin/post/delete-post/' . $value1->post_id) }}">
                                    <i class="align-middle" data-feather="trash-2"></i></a>
                                <a class="btn btn-outline-warning" href="{{ URL::to('/admin/post/edit-post/' . $value1->post_id) }}">
                                    <i class="align-middle" data-feather="edit"></i></a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            {{-- <div class="float-right mt-2">
                {!! $categorypa->render('vendor.pagination.custom') !!}
            </div> --}}

        </div>
    </div>
@endsection
