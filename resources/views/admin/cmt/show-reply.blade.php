@extends('admin-layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="mt-3">Bình luận đã trả lời</h2>
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
                    <tr class="text-nowrap">
                        <th scope="col">ID</th>
                        <th scope="col">Tài khoản</th>
                        <th scope="col">Nội dung</th>
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
                            <td>{{ $item->comment_time }}</td>
                            <td>
                                <a class="btn btn-outline-danger" title="Xoá bình luận"
                                    onclick="return confirm('Xoá bình luận này ')"
                                    href="{{ URL::to('/admin/product/delete-comment/' . $item->comment_id) }}">
                                    <i class="align-middle" data-feather="trash-2"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4">
                            <form action="{{ URL::to('/admin/comment/add-reply') }}" method="post">
                                @csrf
                                <input type="hidden" name="cmt_id" value="{{ $comment_id }}">
                                <div class="row">
                                    <div class="col">
                                        <input class="form-control" type="text" name="content" id="">
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-outline-primary">Trả lời</button>
                                    </div>
                                </div>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
