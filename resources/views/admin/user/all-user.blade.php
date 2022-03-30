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
                        <th scope="col">Tên user</th>
                        <th scope="col">Email</th>
                        <th scope="col">Admin</th>
                        <th scope="col">Manage</th>
                        <th scope="col">User</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admin as $item)
                        <form action="{{ URL::to('/admin/user/assign-roles') }}" method="post">
                            @csrf
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td><input type="hidden" name="email" value="{{ $item->email }}">
                                    <input type="hidden" name="admin_id" value="{{ $item->admin_id }}">
                                    {{ $item->email }}
                                </td>
                                <td>
                                    <input type="checkbox" name="admin_role" {{ $item->hasRole('admin') ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="checkbox" name="manage_role"
                                        {{ $item->hasRole('manage') ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="checkbox" name="user_role" {{ $item->hasRole('user') ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-outline-success">Add</button>
                                    <a class="btn btn-outline-danger" href="{{ URL::to('/admin/user/delete-user/'.$item->admin_id) }}">Delete</a>
                                </td>
                            </tr>
                        </form>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
