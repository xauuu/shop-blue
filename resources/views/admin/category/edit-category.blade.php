@extends('admin-layout')
@section('content')
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card mt-1">
                <div class="card-header">
                    <h2 class="mt-3">Sửa danh mục</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ URL::to('/admin/category/update-category') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="category_id" value="{{ $cate->category_id }}">
                        <div class="mb-3">
                            <label class="form-label">Tên danh mục</label>
                            <input type="text" class="form-control" name="category_name" value="{{ $cate->category_name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">SLug</label>
                            <input type="text" class="form-control" name="category_slug" value="{{ $cate->category_slug }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea class="form-control" name="category_desc"
                                rows="3">{{ $cate->category_desc }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Thuộc danh mục</label>
                            <select class="form-control mb-3" name="category_parent">
                                <option value="0">---Danh mục cha---</option>

                                @foreach ($category as $item)
                                    @if ($cate->category_parent == $item->category_id)
                                        <option selected value="{{ $item->category_id }}">{{ $item->category_name }}
                                        </option>
                                    @else
                                        <option value="{{ $item->category_id }}">{{ $item->category_name }}</option>
                                    @endif
                                @endforeach

                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Sửa danh mục</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
