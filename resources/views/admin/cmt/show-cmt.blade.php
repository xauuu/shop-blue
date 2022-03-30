@extends('admin-layout')
@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="mt-3">Danh sách bình luận</h2>
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
        <table class="table mb-0 ml-2">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tài khoản</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Trả lời</th>
                    <th scope="col">Sản phẩm</th>
                    <th scope="col">Thời gian</th>
                    <th scope="col">Xoá</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comment as $item)
                    <tr>
                        <td>{{ $item->comment_id }}</td>
                        <td>{{ $item->customer->customer_name }}</td>
                        <td>{{ $item->comment_content }}</td>
                        <td><a class="btn btn-outline-info" href="{{ URL::to('/admin/comment/show-reply/'.$item->comment_id) }}">Rep</a></td>
                        <td><a href="{{ URL::to('product-detail/'.$item->product->product_slug) }}">{{ $item->product->product_name }}</a></td>
                        <td class="text-nowrap">{{ $item->comment_time }}</td>
                        <td>
                            <a class="btn btn-outline-danger" title="Xoá bình luận"
                                onclick="return confirm('Xoá bình luận này ')"
                                href="{{ URL::to('/admin/product/delete-comment/' . $item->comment_id) }}">
                                <i class="align-middle" data-feather="trash-2"></i></a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="float-right mt-2">
            {!! $comment->render('vendor.pagination.custom') !!}
        </div>
    </div>
</div>
@endsection
