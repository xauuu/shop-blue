@extends('admin-layout')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="mt-3">Danh sách sản phẩm</h2>
            @if (session('success'))
                <div class="alert alert-primary alert-dismissible col-6" role="alert">
                    <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
                    <div class="alert-icon">
                        <i class="far fa-fw fa-bell"></i>
                    </div>
                    <div class="alert-message">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            <div class="float-left ">
                <form class="d-sm-inline-block">
                    <div class="input-group">
                        <label class="input-group-text">Hiển thị</label>
                        <select class="form-select ml-2" name="entries" onchange="this.form.submit();">
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                            <option value="25">25</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="float-right">
                <form autocomplete="off" class="d-none d-sm-inline-block" method="post"
                    action="{{ URL::to('admin/product/search-product') }}">
                    @csrf
                    <div class="input-group input-group-navbar">
                        <input name="search" type="text" class="form-control" placeholder="Nhập tên sản phẩm..."
                            aria-label="Search" required>
                        <button class="btn" type="submit">
                            <i class="align-middle" data-feather="search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table mb-0 ml-2">
                <thead>
                    <tr class="text-nowrap">
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Gallery</th>
                        <th scope="col">Mô tả sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Bình luận</th>
                        <th scope="col">Chi tiết</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <style type="text/css">
                    #product_order .ui-state-hightlight {
                        padding: 24px;
                        background-color: #ffffcc;
                        border: 1px dotted #ccc;
                        cursor: move;
                        margin-top: 12px;
                    }

                </style>
                <tbody id="product_order">
                    @foreach ($product as $item => $value1)
                        <tr id="{{ $value1->product_id }}">
                            <td>{{ $value1->product_name }}</td>
                            <td><img width="100" src="{{ $value1->product_img }}"
                                    alt="{{ $value1->product_name }}"></td>
                            <td>
                                <a class="btn btn-outline-success" title="Thêm thư viên ảnh cho sản phẩm"
                                    href="{{ URL::to('admin/product/gallery/' . $value1->product_id) }}">
                                    <i class="align-middle" data-feather="image"></i>
                                </a>
                            </td>
                            <td> {!! $value1->product_desc !!} </td>
                            <td>{{ number_format($value1->product_discount) }} VND</td>
                            <td>
                                @if ($value1->product_status == 0)
                                    <a href="{{ URL::to('admin/product/product_status/' . $value1->product_id) }}">Ẩn</a>
                                @else
                                    <a href="{{ URL::to('admin/product/product_status/' . $value1->product_id) }}">Hiển
                                        thị</a>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-outline-secondary" title="Xem bình luận của sản phẩm"
                                    href="{{ URL::to('admin/product/comment/' . $value1->product_id) }}">
                                    <i class="align-middle" data-feather="message-square"></i>
                                </a>
                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                    data-target="#sanpham{{ $value1->product_id }}" title="Xem chi tiết sản phẩm">
                                    Xem
                                </button>
                                <div class="modal fade" id="sanpham{{ $value1->product_id }}" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Chi tiết sản phẩm: {{ $value1->product_name }}</h4>
                                                <button type="button" class="btn-close" data-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body m-3">
                                                <p class="mb-0">{!! $value1->product_detail !!}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-nowrap">
                                <a class="btn btn-outline-danger" title="Xoá sản phẩm"
                                    onclick="return confirm('Xoá sản phẩm: {{ $value1->product_name }}')"
                                    href="{{ URL::to('/admin/product/delete-product/' . $value1->product_id) }}">
                                    <i class="align-middle" data-feather="trash-2"></i></a>
                                <a class="btn btn-outline-warning" title="Sửa sản phẩm"
                                    href="{{ URL::to('/admin/product/edit-product/' . $value1->product_id) }}">
                                    <i class="align-middle" data-feather="edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right mt-2">
                {!! $product->render('vendor.pagination.custom') !!}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#product_order').sortable({
                placeholder: 'ui-state-hightlight',
                update: function(event, ui) {
                    var page_id_array = new Array();
                    var _token = $('input[name="_token"]').val();
                    $('#product_order tr').each(function() {
                        page_id_array.push($(this).attr("id"));
                    });
                    $.ajax({
                        type: "post",
                        url: "{{ url('/admin/product/arrange-product') }}",
                        data: {
                            page_id_array: page_id_array,
                            _token: _token
                        },
                        success: function(result) {
                            console.log(result);
                        }
                    });
                }
            });
        });

    </script>
@endpush
