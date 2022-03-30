@extends('admin-layout')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card mt-1">
                <div class="card-header">
                    <h2 class="mt-3">Thêm thư viện hình ảnh</h2>
                    <h4>Sản phẩm: {{ $product->product_name }}</h4>
                </div>
                <!-- BEGIN  modal -->
                <div class="col-md-3 mb-4 ml-3">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sizedModalLg">
                        Thêm hình ảnh
                    </button>
                </div>
                <div class="modal fade" id="sizedModalLg" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Chọn hình ảnh</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body m-3">
                                <form action="{{ URL::to('/admin/product/add-gallery') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                                        <input id="files" class="form-control" type="file" name="image[]" accept="image/*"
                                            multiple><br>
                                        <p class="text-danger" id="err-ga"></p>
                                    </div>
                                    <button class="btn btn-success" type="submit">Thêm</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END  modal -->
                <div id="gallery-load">
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <table class="table ml-3">
                                    <thead>
                                        <tr>
                                            <th>Hình ảnh</th>
                                            <th>Tên hình ảnh</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->gallery as $item)
                                            <tr>
                                                <td><img width="150" src="{{ asset('uploads/product/gallery/'.$item->gallery_img) }}" alt=""></td>
                                                <td>{{ $item->gallery_img }}</td>
                                                <td class="table-action">
                                                    <a href="{{ URL::to('/admin/product/delete-ga/' . $item->gallery_id) }}">
                                                        <i class="align-middle" data-feather="trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
