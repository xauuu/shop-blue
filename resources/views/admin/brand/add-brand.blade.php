@extends('admin-layout')
@section('content')
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card mt-1">
                <div class="card-header">
                    <h2 class="mt-3">Thêm thương hiệu</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ URL::to('/admin/brand/save-brand') }}">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label class="form-label">Tên thương hiệu</label>
                            <input type="text" class="form-control" name="brand_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" class="form-control" name="brand_slug" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea class="form-control" name="brand_desc" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select class="form-control mb-3" name="brand_status">
                                <option value="1" selected>Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm thương hiệu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
