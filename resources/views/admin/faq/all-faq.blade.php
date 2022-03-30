@extends('admin-layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="mt-3">Danh sách câu hỏi</h2>
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
                        <th scope="col">#</th>
                        <th scope="col">Câu hỏi</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($faq as $item)
                        <tr>
                            <td>{{ $item->faq_id }}</td>
                            <td>{{ $item->faq_question }}</td>
                            <td>
                                <a class="btn btn-outline-danger" onclick="return confirm('Xoá câu hỏi này này')" href="{{ URL::to('/admin/faq/delete-faq/' . $item->faq_id) }}">
                                    <i class="align-middle" data-feather="trash-2"></i></a>
                                <a class="btn btn-outline-warning" href="{{ URL::to('/admin/faq/edit-faq/' . $item->faq_id) }}">
                                    <i class="align-middle" data-feather="edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            <div class="m-2">
                <a class="btn btn-primary" href="{{ URL::to('admin/faq/add-faq') }}">Thêm câu hỏi</a>
            </div>
    </div>
@endsection
