@extends('layout')
@section('content')
    <!-- Page info -->
    <div class="page-top-info">
        <div class="container">
            <div class="site-pagination">
                <a href="">Trang chủ</a> /
                <a href="">Shop</a> /
            </div>
        </div>
    </div>
    <!-- Page info end -->


    <!-- Category section -->
    <section class="category-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-2 order-lg-1">
                    <div class="filter-widget">
                        <h2 class="fw-title">Danh mục</h2>
                        <ul class="category-menu">
                            @foreach ($category as $item => $cate)
                                @if ($cate->category_parent == 0)
                                    <li><a
                                            href="{{ URL::to('category/' . $cate->category_slug) }}">{{ $cate->category_name }}</a>
                                        <ul class="sub-menu">
                                            @foreach ($category as $item => $cate_chill)
                                                @if ($cate_chill->category_parent == $cate->category_id)
                                                    <li><a class="chill"
                                                            href="{{ URL::to('category/' . $cate_chill->category_slug) }}">{{ $cate_chill->category_name }}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="filter-widget mb-0">
                        <form method="get">
                        <h2 class="fw-title">Lọc theo</h2>
                        <div class="price-range-wrap">
                            <h4>Giá</h4>
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="0" data-max="999">
                                <div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 0%; width: 100%;">
                                </div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"
                                    style="left: 0%;">
                                </span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"
                                    style="left: 100%;">
                                </span>
                            </div>
                            <div class="range-slider">
                                <div class="price-input">

                                    <input type="text" id="minamount">
                                    <input type="text" id="maxamount">
                                </div>
                                <input type="hidden" name="min">
                                <input type="hidden"  name="max">
                            </div>
                        </div>
                        <div class="price-bt d-flex">
                            <button type="submit" class="mb-2 filter-btn">Lọc</button>
                        </div>
                    </form>
                    </div>
                    {{-- <div class="filter-widget mb-0">
                        <h2 class="fw-title">color by</h2>
                        <div class="fw-color-choose">
                            <div class="cs-item">
                                <input type="radio" name="cs" id="gray-color">
                                <label class="cs-gray" for="gray-color">
                                    <span>(3)</span>
                                </label>
                            </div>
                            <div class="cs-item">
                                <input type="radio" name="cs" id="orange-color">
                                <label class="cs-orange" for="orange-color">
                                    <span>(25)</span>
                                </label>
                            </div>
                            <div class="cs-item">
                                <input type="radio" name="cs" id="yollow-color">
                                <label class="cs-yollow" for="yollow-color">
                                    <span>(112)</span>
                                </label>
                            </div>
                            <div class="cs-item">
                                <input type="radio" name="cs" id="green-color">
                                <label class="cs-green" for="green-color">
                                    <span>(75)</span>
                                </label>
                            </div>
                            <div class="cs-item">
                                <input type="radio" name="cs" id="purple-color">
                                <label class="cs-purple" for="purple-color">
                                    <span>(9)</span>
                                </label>
                            </div>
                            <div class="cs-item">
                                <input type="radio" name="cs" id="blue-color" checked="">
                                <label class="cs-blue" for="blue-color">
                                    <span>(29)</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="filter-widget mb-0">
                        <h2 class="fw-title">Size</h2>
                        <div class="fw-size-choose">
                            <div class="sc-item">
                                <input type="radio" name="sc" id="xs-size">
                                <label for="xs-size">XS</label>
                            </div>
                            <div class="sc-item">
                                <input type="radio" name="sc" id="s-size">
                                <label for="s-size">S</label>
                            </div>
                            <div class="sc-item">
                                <input type="radio" name="sc" id="m-size" checked="">
                                <label for="m-size">M</label>
                            </div>
                            <div class="sc-item">
                                <input type="radio" name="sc" id="l-size">
                                <label for="l-size">L</label>
                            </div>
                            <div class="sc-item">
                                <input type="radio" name="sc" id="xl-size">
                                <label for="xl-size">XL</label>
                            </div>
                            <div class="sc-item">
                                <input type="radio" name="sc" id="xxl-size">
                                <label for="xxl-size">XXL</label>
                            </div>
                        </div>
                    </div> --}}
                    <div class="filter-widget">
                        <h2 class="fw-title">Thương hiệu</h2>
                        <ul class="category-menu">
                            @foreach ($brand as $item)
                                <li><a href="{{ URL::to('brand/' . $item->brand_slug) }}">{{ $item->brand_name }}
                                        <span>({{ count($item->count_brand) }})</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
                    @yield('product')
                </div>
            </div>
        </div>
    </section>
    <!-- Category section end -->
@stop
