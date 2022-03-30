@extends('admin-layout')
@section('content')
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card mt-1">
                <div class="card-header">
                    <h2 class="mt-3">Cập nhật Slider</h2>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data"
                        action="{{ URL::to('/admin/slider/update-slider') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="slider_id" value="{{ $slider->slider_id }}">
                        <div class="mb-3">
                            <label class="form-label">Ảnh</label>
                            <input type="file" class="form-control" name="slider_img" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tên</label>
                            <input type="text" class="form-control" name="slider_name" value="{{ $slider->slider_name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tiêu đề</label>
                            <input type="text" class="form-control" name="slider_title" value="{{ $slider->slider_title }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giảm giá</label>
                            <input type="number" class="form-control" name="slider_discount" value="{{ $slider->slider_discount }}" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nội dung</label>
                            <textarea id="xau1" class="form-control" name="slider_content" rows="3">{{ $slider->slider_content }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật slider</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
