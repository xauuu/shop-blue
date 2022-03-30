@extends('admin-layout')
@section('content')
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card mt-1">
                <div class="card-header">
                    <h2 class="mt-3">Cập nhật danh mục bài viết</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ URL::to('/admin/category_post/update-category-post') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="category_post_id" value="{{ $cate_post->category_post_id }}">
                        <div class="mb-3">
                            <label class="form-label">Tên danh mục bài viết</label>
                            <input type="text" class="form-control" name="category_post_name" value="{{ $cate_post->category_post_name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea class="form-control" name="category_post_desc"
                                rows="3">{{ $cate_post->category_post_desc }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật danh mục bài viết</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
