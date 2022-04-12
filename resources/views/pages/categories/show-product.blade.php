@extends('pages.shop.shop')
@section('product')
    <div class="row justify-content-between mb-3">
        <div class="col-lg-6 d-flex">
            <span class="pt-2 mr-2">Sắp xếp theo</span>
            <select class="dropdown">
                <option disabled selected value="">Mặc định</option>
                <option value="{{ Request::url() }}?sort=tang_dan">Giá từ thấp đến cao</option>
                <option value="{{ Request::url() }}?sort=giam_dan">Giá từ cao đến thấp</option>
                <option value="{{ Request::url() }}?sort=a_z">Tên từ A-Z</option>
                <option value="{{ Request::url() }}?sort=z_a">Tên từ Z-A</option>
            </select>
        </div>
        @if(session('customer_id') != null)
            <div class="col-lg-4">
                <span>Hiển thị</span>
                <select style="width:80px;" class="custom-select" name="pagination">
                    <option disabled selected value="0">Chọn</option>
                    <option value="3">3</option>
                    <option value="6">6</option>
                    <option value="9">9</option>
                    <option value="12">12</option>
                    <option value="15">15</option>
                </select>
                <span>sản phẩm</span>
            </div>
        @endif

    </div>
    <div class="row">
        @foreach ($product as $item => $pro)
            <div class="col-lg-4 col-sm-6">
                <form>
                    {{ csrf_field() }}
                    <div class="product-item">
                        <div class="pi-pic">
                            <a href="{{ URL::to('product-detail/' . $pro->product_slug) }}">
                                <img src="{{ $pro->product_img }}" alt="{{ $pro->product_name }}">
                            </a>
                            <div class="pi-links">
                                <button data-id="{{ $pro->product_id }}" type="button" name="add-cart" class="add-card">
                                    <i class="flaticon-bag"></i><span>Add to cart</span>
                                </button>
                                <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                            </div>
                        </div>
                        <div class="pi-text">
                            <h6>{{ number_format($pro->product_discount) }} VND</h6>
                            <a href="{{ URL::to('product-detail/' . $pro->product_slug) }}">
                                <p>{{ $pro->product_name }}</p>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        @endforeach
    </div>
    <div class="pt-3 float-right">
        {{ $product->render('vendor.pagination.product') }}
    </div>

@stop
