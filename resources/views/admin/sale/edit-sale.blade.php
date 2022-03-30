@extends('admin-layout')
@section('content')
    <div class="row">
        <div class="col-xl-8 mx-auto">
            <div class="card mt-1">
                <div class="card-header">
                    <h2 class="mt-3">Cập nhật Sale</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ URL::to('/admin/sale/update-sale') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="sale_id" value="{{ $sale->sale_id }}">
                        <div class="mb-3">
                            <label class="form-label">Tên sale</label>
                            <input type="text" class="form-control" name="sale_name" value="{{ $sale->sale_name }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sản phẩm</label>
                            <select name="product_id" class="form-control">
                                @foreach ($product as $item)
                                    @if ($item->product_id == $sale->product_id)
                                        <option selected value="{{ $item->product_id }}">{{ $item->product_name }}</option>
                                    @endif
                                    <option value="{{ $item->product_id }}">{{ $item->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Hình ảnh</label>
                            <input type="file" class="form-control" name="sale_img" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phần trăm giảm</label>
                            <input type="text" class="form-control" name="sale_percent" value="{{ $sale->sale_percent }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Thời gian kết thúc</label>
                            <input id="datepicker" class="form-control" name="sale_time" value="{{ $sale->sale_time }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật sale</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $.datepicker.regional["vi-VN"] = {
            closeText: "Đóng",
            prevText: "Trước",
            nextText: "Sau",
            currentText: "Hôm nay",
            monthNames: ["Tháng một", "Tháng hai", "Tháng ba", "Tháng tư", "Tháng năm", "Tháng sáu", "Tháng bảy",
                "Tháng tám", "Tháng chín", "Tháng mười", "Tháng mười một", "Tháng mười hai"
            ],
            monthNamesShort: ["Một", "Hai", "Ba", "Bốn", "Năm", "Sáu", "Bảy", "Tám", "Chín", "Mười", "Mười một",
                "Mười hai"
            ],
            dayNames: ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"],
            dayNamesShort: ["CN", "Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy"],
            dayNamesMin: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
            weekHeader: "Tuần",
            dateFormat: "dd/mm/yy",
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ""
        };
        $.datepicker.setDefaults($.datepicker.regional["vi-VN"]);
        $("#datepicker").datepicker({
            dateFormat: "yy/mm/dd",
        });

    </script>
@endpush
