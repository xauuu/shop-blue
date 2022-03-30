@extends('admin-layout')
@section('content')
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card mt-1">
                <div class="card-header">
                    <h2 class="mt-3">Cập nhật thương hiệu</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ URL::to('/admin/brand/update-brand') }}">
                        {{ csrf_field() }}
                            <input type="hidden" name="brand_id" value="{{ $brand->brand_id }}">
                            <div class="mb-3">
                                <label class="form-label">Tên thương hiệu</label>
                                <input type="text" class="form-control" name="brand_name" value="{{ $brand->brand_name }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Slug</label>
                                <input type="text" class="form-control" name="brand_slug" value="{{ $brand->brand_slug }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mô tả</label>
                                <textarea class="form-control" name="brand_desc" rows="3">{{ $brand->brand_desc }}</textarea>
                            </div>
                        <button type="submit" class="btn btn-primary">Cập nhật thương hiệu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
