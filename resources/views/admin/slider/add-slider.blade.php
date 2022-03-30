@extends('admin-layout')
@section('content')
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card mt-1">
                <div class="card-header">
                    <h2 class="mt-3">Thêm Slider</h2>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data"
                        action="{{ URL::to('/admin/slider/save-slider') }}">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label class="form-label">Ảnh</label>
                            <input type="file" class="form-control" name="slider_img" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tên</label>
                            <input type="text" class="form-control" name="slider_name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tiêu đề</label>
                            <input type="text" class="form-control" name="slider_title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giảm giá</label>
                            <input type="number" class="form-control" name="slider_discount" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nội dung</label>
                            <textarea id="xau1" class="form-control" name="slider_content" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select class="form-control mb-3" name="slider_status">
                                <option value="1" selected>Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm slider</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
