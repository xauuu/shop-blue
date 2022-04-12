@extends('layout')
@section('content')
    <!-- Hero section -->
    <section class="hero-section">
        <div class="hero-slider owl-carousel">
            @foreach ($slider as $item)
                <div class="hs-item set-bg" data-setbg="{{ asset('uploads/slider/' . $item->slider_img) }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-7 text-white">
                                <span>{{ $item->slider_name }}</span>
                                <h2>{{ $item->slider_title }}</h2>
                                <div>{!! $item->slider_content !!}</div>
                                <a href="#" class="site-btn sb-white">KHÁM PHÁ</a>
                            </div>
                        </div>
                        <div class="offer-card text-white">
                            <span>Giảm</span>
                            <h2>{{ $item->slider_discount }}%</h2>
                            <p>MUA NGAY</p>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- <div class="hs-item set-bg"
                data-setbg="{{ asset('frontend/img/bg-2.jpg') }}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 text-white">
                            <span>New Arrivals</span>
                            <h2>denim jackets</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                                labore et dolore magna aliqua. Quis ipsum sus-pendisse ultrices gravida. Risus commodo
                                viverra maecenas accumsan lacus vel facilisis. </p>
                            <a href="#" class="site-btn sb-line">DISCOVER</a>
                            <a href="#" class="site-btn sb-white">ADD TO CART</a>
                        </div>
                    </div>
                    <div class="offer-card text-white">
                        <span>from</span>
                        <h2>$29</h2>
                        <p>SHOP NOW</p>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="container">
            <div class="slide-num-holder" id="snh-1"></div>
        </div>
    </section>
    <!-- Hero section end -->



    <!-- Features section -->
    <section class="features-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 p-0 feature">
                    <div class="feature-inner">
                        <div class="feature-icon">
                            <img src="{{ asset('frontend/img/icons/1.png') }}" alt="#">
                        </div>
                        <h2>THANH TOÁN AN TOÀN</h2>
                    </div>
                </div>
                <div class="col-md-4 p-0 feature">
                    <div class="feature-inner">
                        <div class="feature-icon">
                            <img src="{{ asset('frontend/img/icons/2.png') }}" alt="#">
                        </div>
                        <h2>SẢN PHẨM CAO CẤP</h2>
                    </div>
                </div>
                <div class="col-md-4 p-0 feature">
                    <div class="feature-inner">
                        <div class="feature-icon">
                            <img src="{{ asset('frontend/img/icons/3.png') }}" alt="#">
                        </div>
                        <h2>GIAO HÀNG MIỄN PHÍ</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features section end -->

    <!-- letest product section -->
    <section class="top-letest-product-section">
        <div class="container">
            <div class="section-title mt-5">
                <h2>SẢN PHẨM MỚI</h2>
            </div>
            <div class="product-slider owl-carousel">
                @foreach ($product_latest as $item => $pro)
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
                @endforeach
            </div>
        </div>
    </section>
    <!-- letest product section end -->
    <!-- Product filter section -->
    <section class="product-filter-section">
        <div class="container">
            <div class="section-title">
                <h2>SẢN PHẨM BÁN CHẠY</h2>
            </div>
            <ul class="product-filter-menu">
                <li><a href="#">TOPS</a></li>
                <li><a href="#">JUMPSUITS</a></li>
                <li><a href="#">LINGERIE</a></li>
                <li><a href="#">JEANS</a></li>
                <li><a href="#">DRESSES</a></li>
                <li><a href="#">COATS</a></li>
                <li><a href="#">JUMPERS</a></li>
                <li><a href="#">LEGGINGS</a></li>
            </ul>
            <div class="row">
                @foreach ($product_sale as $item => $pro)
                    <div class="col-lg-3 col-sm-6">
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
            <div class="text-center pt-5">
                <a href="{{ URL::to('/shop') }}" class="site-btn sb-line sb-dark">XEM THÊM</a>
            </div>
        </div>
    </section>
    <!-- Product filter section end -->
    @isset($sale)
        <section class="discount m-4">
            <div class="container">
                <div class="section-title mt-5">
                    <h2>SIÊU SALE</h2>
                </div>
                <div class="row">
                    <div class="col-lg-6 p-0">
                        <div class="discount__pic">
                            <img src="{{ asset('uploads/sale/' . $sale->sale_img) }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 p-0">
                        <div class="discount__text">
                            <div class="discount__text__title">
                                <span>Giảm giá</span>
                                <h2>{{ $sale->sale_name }}</h2>
                                <h5><span>Giảm</span> {{ $sale->sale_percent }}%</h5>
                            </div>
                            <div class="discount__countdown" id="countdown-time">
                                <div class="countdown__item">
                                    <span>20</span>
                                    <p>Days</p>
                                </div>
                                <div class="countdown__item">
                                    <span>18</span>
                                    <p>Hour</p>
                                </div>
                                <div class="countdown__item">
                                    <span>46</span>
                                    <p>Min</p>
                                </div>
                                <div class="countdown__item">
                                    <span>05</span>
                                    <p>Sec</p>
                                </div>
                            </div>
                            <a href="{{ url('product-detail/' . $sale->product->product_slug) }}">Mua ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endisset


    <!-- Product filter section -->
    {{-- <section class="product-filter-section">
        <div class="container">
            <div class="section-title">
                <h2>BROWSE TOP SELLING PRODUCTS</h2>
            </div>
            <ul class="product-filter-menu">
                <li><a href="#">TOPS</a></li>
                <li><a href="#">JUMPSUITS</a></li>
                <li><a href="#">LINGERIE</a></li>
                <li><a href="#">JEANS</a></li>
                <li><a href="#">DRESSES</a></li>
                <li><a href="#">COATS</a></li>
                <li><a href="#">JUMPERS</a></li>
                <li><a href="#">LEGGINGS</a></li>
            </ul>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{ asset('frontend/./img/product/5.jpg') }}" alt="">
                            <div class="pi-links">
                                <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
                                <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                            </div>
                        </div>
                        <div class="pi-text">
                            <h6>$35,00</h6>
                            <p>Flamboyant Pink Top </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <div class="tag-sale">ON SALE</div>
                            <img src="{{ asset('frontend/./img/product/6.jpg') }}" alt="">
                            <div class="pi-links">
                                <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
                                <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                            </div>
                        </div>
                        <div class="pi-text">
                            <h6>$35,00</h6>
                            <p>Black and White Stripes Dress</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{ asset('frontend/./img/product/7.jpg') }}" alt="">
                            <div class="pi-links">
                                <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
                                <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                            </div>
                        </div>
                        <div class="pi-text">
                            <h6>$35,00</h6>
                            <p>Flamboyant Pink Top </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{ asset('frontend/./img/product/8.jpg') }}" alt="">
                            <div class="pi-links">
                                <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
                                <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                            </div>
                        </div>
                        <div class="pi-text">
                            <h6>$35,00</h6>
                            <p>Flamboyant Pink Top </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{ asset('frontend/./img/product/9.jpg') }}" alt="">
                            <div class="pi-links">
                                <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
                                <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                            </div>
                        </div>
                        <div class="pi-text">
                            <h6>$35,00</h6>
                            <p>Flamboyant Pink Top </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{ asset('frontend/./img/product/10.jpg') }}" alt="">
                            <div class="pi-links">
                                <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
                                <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                            </div>
                        </div>
                        <div class="pi-text">
                            <h6>$35,00</h6>
                            <p>Black and White Stripes Dress</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{ asset('frontend/./img/product/11.jpg') }}" alt="">
                            <div class="pi-links">
                                <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
                                <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                            </div>
                        </div>
                        <div class="pi-text">
                            <h6>$35,00</h6>
                            <p>Flamboyant Pink Top </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{ asset('frontend/./img/product/12.jpg') }}" alt="">
                            <div class="pi-links">
                                <a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
                                <a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
                            </div>
                        </div>
                        <div class="pi-text">
                            <h6>$35,00</h6>
                            <p>Flamboyant Pink Top </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center pt-5">
                <button class="site-btn sb-line sb-dark">LOAD MORE</button>
            </div>
        </div>
    </section> --}}
    <!-- Product filter section end -->

@endsection
@isset($sale)
    @push('script')
        <script>
            var timerdate = {!!json_encode($sale->sale_time) !!};

            $("#countdown-time").countdown(timerdate, function(event) {
                $(this).html(event.strftime("<div class='countdown__item'><span>%D</span> <p>Ngày</p> </div>" +
                    "<div class='countdown__item'><span>%H</span> <p>Giờ</p> </div>" +
                    "<div class='countdown__item'><span>%M</span> <p>Phút</p> </div>" +
                    "<div class='countdown__item'><span>%S</span> <p>Giây</p> </div>"));
            });

        </script>
    @endpush
@endisset
