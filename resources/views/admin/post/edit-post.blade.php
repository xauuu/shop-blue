@extends('admin-layout')
@section('content')
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card mt-1">
                <div class="card-header">
                    <h2 class="mt-3">Cập nhật bài viết</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ URL::to('/admin/post/update-post') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="post_id" value="{{ $post->post_id }}">
                        <div class="mb-3">
                            <label class="form-label">Tiêu đề bài viết</label>
                            <input type="text" class="form-control" name="post_title" value="{{ $post->post_title }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" class="form-control" name="post_slug" required value="{{ $post->post_slug }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hình ảnh bài viết</label>
                            <input type="file" class="form-control" name="post_img" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Danh mục bài viết</label>
                            <select name="category_post_id" class="form-control">
                                @foreach ($cate_post as $item)
                                    <option value="{{ $item->category_post_id }}">
                                        {{ $item->category_post_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tóm tắt bài viết</label>
                            <textarea class="form-control" name="post_desc" rows="3">{{ $post->post_desc }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Chi tiết bài viết</label>
                            <textarea id="xau1" class="form-control" name="post_detail"
                                rows="3">{{ $post->post_detail }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta từ khoá</label>
                            <textarea class="form-control" name="post_meta_keywords"
                                rows="3">{{ $post->post_meta_keywords }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta nội dung</label>
                            <textarea class="form-control" name="post_meta_desc"
                                rows="3">{{ $post->post_meta_desc }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật bài viết</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
