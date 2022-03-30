@extends('admin-layout')
@section('content')
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card mt-1">
                <div class="card-header">
                    <h2 class="mt-3">Thêm bài viết</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ URL::to('/admin/post/save-post') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label class="form-label">Tiêu đề bài viết</label>
                            <input type="text" class="form-control" name="post_title" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" class="form-control" name="post_slug" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hình ảnh bài viết</label>
                            <input type="file" class="form-control" name="post_img" accept="image/*" required>
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
                            <textarea class="form-control" name="post_desc" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Chi tiết bài viết</label>
                            <textarea id="xau1" class="form-control" name="post_detail" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta từ khoá</label>
                            <textarea class="form-control" name="post_meta_keywords" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Meta nội dung</label>
                            <textarea class="form-control" name="post_meta_desc" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select class="form-control mb-3" name="post_status">
                                <option value="1" selected>Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm bài viết</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    CKEDITOR.replace('xau');
    CKEDITOR.replace('xau1', {
        filebrowserBrowseUrl: '{{ asset('ckeditor/ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('ckeditor/ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl : '{{ asset('ckeditor/ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl : '{{ asset('ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl : '{{ asset('ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl : '{{ asset('ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
    });
</script>
@endpush
