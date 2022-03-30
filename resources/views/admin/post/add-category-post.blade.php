@extends('admin-layout')
@section('content')
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card mt-1">
                <div class="card-header">
                    <h2 class="mt-3">Thêm danh mục bài viết</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ URL::to('/admin/category_post/save-category-post') }}">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label class="form-label">Tên danh mục bài viết</label>
                            <input type="text" class="form-control" name="category_post_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea class="form-control" name="category_post_desc" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select class="form-control mb-3" name="category_post_status">
                                <option value="1" selected>Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm danh mục bài viết</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
