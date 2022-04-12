@extends('pages.shop.shop')
@section('product')
    <div class="mb-4">
        <h4>{{ $mess }}</h4>
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
