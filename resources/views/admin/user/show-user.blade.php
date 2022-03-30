@extends('admin-layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="mt-3">Danh sách tài khoản</h2>
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
                        <th scope="col">Email</th>
                        <th scope="col">Tên người dùng</th>
                        <th scope="col">Thao tác</th>
                        <th scope="col">Xoá</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $item)
                        <tr>
                            <th scope="row">{{ $item->id }}</th>
                            <td>{{ $item->customer_email }}</td>
                            <td>{{ $item->customer_name }}</td>
                            <td>
                                @if ($item->customer_status == 0)
                                    <a class="btn btn-outline-warning"
                                        href="{{ URL::to('/admin/lock-user/' . $item->id) }}">Khoá</a>
                                @else
                                    <a class="btn btn-outline-warning"
                                        href="{{ URL::to('/admin/lock-user/' . $item->id) }}">Mở khoá</a>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-outline-danger" onclick="return confirm('Xoá tài khoản này')"
                                    href="{{ URL::to('/admin/delete-user/' . $item->id) }}">
                                    <i class="align-middle" data-feather="trash-2"></i></a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
