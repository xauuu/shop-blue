@extends('admin-layout')
@section('content')
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card mt-1">
                <div class="card-header">
                    <h2 class="mt-3">Thêm danh mục</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ URL::to('/admin/category/save-category') }}">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label class="form-label">Tên danh mục</label>
                            <input type="text" class="form-control" name="category_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" class="form-control" name="category_slug" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea class="form-control" name="category_desc" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select class="form-control mb-3" name="category_status">
                                <option value="1" selected>Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Thuộc danh mục</label>
                            <select class="form-control mb-3" name="category_parent">
                                <option value="0">---Danh mục cha---</option>
                                @foreach ($category as $item)
                                    <option value="{{ $item->category_id }}">{{ $item->category_name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm danh mục</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
