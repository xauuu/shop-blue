@extends('admin-layout')
@section('content')
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card mt-1">
                <div class="card-header">
                    <h2 class="mt-3">Cập nhật sản phẩm</h2>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data"
                        action="{{ URL::to('/admin/product/update-product') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                        <div class="mb-3">
                            <label class="form-label">Tên sản phẩm</label>
                            <input type="text" class="form-control" name="product_name" value="{{ $product->product_name }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Slug</label>
                            <input type="text" class="form-control" name="product_slug"
                                value="{{ $product->product_slug }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea id="xau" class="form-control" name="product_desc" rows="3">
                                                                    {!!  $product->product_detail !!}
                                                                </textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Danh mục</label>
                            <select class="form-control mb-3" name="category_id">
                                @foreach ($category as $item => $value)
                                    @if ($value->category_parent == 0)
                                        @if ($product->category_id == $value->category_id)
                                            <option selected value="{{ $value->category_id }}">{{ $value->category_name }}
                                            </option>
                                        @else
                                            <option value="{{ $value->category_id }}">{{ $value->category_name }}</option>
                                        @endif
                                    @endif
                                    @foreach ($category as $item => $value1)
                                        @if ($value1->category_parent == $value->category_id)
                                            @if ($product->category_id == $value1->category_id)
                                                <option selected value="{{ $value1->category_id }}">---
                                                    {{ $value1->category_name }}
                                                </option>
                                            @else
                                                <option value="{{ $value1->category_id }}">--- {{ $value1->category_name }}
                                                </option>
                                            @endif
                                        @endif
                                    @endforeach
                                @endforeach

                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Thương hiệu</label>
                            <select class="form-control mb-3" name="brand_id">
                                @foreach ($brand as $item => $value)
                                    @if ($product->brand_id == $value->brand_id)
                                        <option selected value="{{ $value->brand_id }}">{{ $value->brand_name }}</option>
                                    @else
                                        <option value="{{ $value->brand_id }}">{{ $value->brand_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số lượng</label>
                            <input type="text" class="form-control" name="product_quantity"
                                value="{{ $product->product_quantity }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giá tiền</label>
                            <input type="text" class="form-control" name="product_price"
                                value="{{ $product->product_price }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Giảm giá</label>
                            <input type="text" class="form-control" name="product_discount"
                                value="{{ $product->product_discount }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ảnh</label>
                            <input type="file" class="form-control" name="product_img">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Chi tiết</label>
                            <textarea id="xau1" class="form-control" name="product_detail" rows="3">
                                                                    {!!  $product->product_detail !!}
                                                                </textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tags</label>
                            <input data-role="tagsinput" type="text" class="form-control" name="product_tag"
                                value="{{ $product->product_tag }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
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

