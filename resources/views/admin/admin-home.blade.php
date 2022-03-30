@extends('admin-layout')
@section('content')
    <main class="content">
        <div class="container-fluid p-0">

            <div class="row mb-2 mb-xl-3">
                <div class="col-auto d-none d-sm-block">
                    <h3><strong>Thống kê hôm nay</strong></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-5">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Đơn hàng</h5>
                                            </div>
                                            <div class="col-auto">
                                                <div class="avatar">
                                                    <div class="avatar-title rounded-circle bg-primary-light">
                                                        {{-- <i class="align-middle" data-feather="shopping-cart"></i> --}}
                                                        Mới
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="mt-1 mb-3">
                                            @if ($new_order)
                                                {{ count($new_order) }}
                                            @else
                                                0
                                            @endif
                                        </h3>
                                        {{-- <div class="mb-1">
                                            <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.25%
                                            </span>
                                            <span class="text-muted">so với tuần trước</span>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Đã bán</h5>
                                            </div>
                                            <div class="col-auto">
                                                <div class="avatar">
                                                    <div class="avatar-title rounded-circle bg-primary-light">
                                                        <i class="align-middle" data-feather="shopping-bag"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="mt-1 mb-3">
                                            @if ($statistic)
                                                {{ $statistic->quantity }}
                                            @else
                                                0
                                            @endif
                                            sản phẩm
                                        </h3>
                                        {{-- <div class="mb-1">
                                            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65%
                                            </span>
                                            <span class="text-muted">so với tuần trước</span>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Thu nhập</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="avatar">
                                                    <div class="avatar-title rounded-circle bg-primary-light">
                                                        <i class="align-middle" data-feather="dollar-sign"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="mt-1 mb-3">
                                            @if ($statistic)
                                                {{ number_format($statistic->sales) }}
                                            @else
                                                0
                                            @endif VND
                                        </h3>
                                        {{-- <div class="mb-1">
                                            <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 6.65%
                                            </span>
                                            <span class="text-muted">so với tuần trước</span>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Đơn hàng</h5>
                                            </div>
                                            <div class="col-auto">
                                                <div class="avatar">
                                                    <div class="avatar-title rounded-circle bg-primary-light">
                                                        <i class="align-middle" data-feather="shopping-cart"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="mt-1 mb-3">
                                            @if ($statistic)
                                                {{ $statistic->total_order }}
                                            @else
                                                0
                                            @endif
                                        </h3>
                                        {{-- <div class="mb-1">
                                            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.25%
                                            </span>
                                            <span class="text-muted">so với tuần trước</span>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-xxl-7">
                    <div class="card flex-fill w-100">
                        <div class="card-header">
                            <div class="picker">
                                <button class="btn btn-outline-primary" id="picker">
                                    <i class="fa fa-calendar"></i>&nbsp;Chọn ngày
                                    <i class="fa fa-caret-down"></i>
                                </button>
                                <span id="datepicker"></span>
                            </div>
                        </div>
                        <div class="card-body py-3">
                            <div class="chart chart-sm">
                                <canvas id="chartjs-dashboard-line" style="height: 450px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-xxl-6 d-flex order-1 order-xxl-1">
                    <div class="card flex-fill w-100">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Thống kê sản phẩm</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-checkable" id="kt_datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá</th>
                                        <th>Lượt xem</th>
                                        <th>Số lượng đã bán</th>
                                        <th>Số lượng tồn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product_view as $item)
                                        <tr>
                                            <td>{{ $item->product_id }}</td>
                                            <td>{{ $item->product_name }}</td>
                                            <td>{{ number_format($item->product_discount) }} VND</td>
                                            <td>{{ $item->product_view }}</td>
                                            <td>{{ $item->product_sale_quantity }}</td>
                                            <td>{{ $item->product_quantity }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xxl-3 d-flex order-2 order-xxl-3">
                    <div class="card flex-fill w-100">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Browser Usage</h5>
                        </div>
                        <div class="card-body d-flex">
                            <div class="align-self-center w-100">
                                <div class="py-3">
                                    <div class="chart chart-xs">
                                        <canvas id="chartjs-dashboard-pie"></canvas>
                                    </div>
                                </div>

                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td>Chrome</td>
                                            <td class="text-right">4306</td>
                                        </tr>
                                        <tr>
                                            <td>Firefox</td>
                                            <td class="text-right">3801</td>
                                        </tr>
                                        <tr>
                                            <td>IE</td>
                                            <td class="text-right">1689</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
                    <div class="card flex-fill w-100">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Real-Time</h5>
                        </div>
                        <div class="card-body px-4">
                            <div id="world_map" style="height:350px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
                    <div class="card flex-fill">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Lịch</h5>
                        </div>
                        <div class="card-body d-flex">
                            <div class="align-self-center w-100">
                                <div class="chart">
                                    <div id="datetimepicker-dashboard"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#kt_datatable').DataTable({
                "order": [
                    [0, "asc"]
                ]
            });
        });

    </script>
    <script>
        $('#picker').daterangepicker({
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                ranges: {
                    '7 ngày trước': [moment().subtract(6, 'days'), moment()],
                    'Tuần này': [moment().startOf('isoWeek'), moment().endOf('isoWeek')],
                    'Tuần trước': [moment().subtract(1, 'week').startOf('isoWeek'), moment().subtract(1, 'week').endOf(
                        'isoWeek')],
                    '30 ngày trước': [moment().subtract(29, 'days'), moment()],
                    'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                    'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                        'month')],
                    'Năm này': [moment().startOf('year'), moment().endOf('year')],
                }
            },
            function(start, end) {
                $('#datepicker').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
                var start = start.format('YYYY-MM-DD');
                var end = end.format('YYYY-MM-DD');
                var _token = $('input[name=_token]').val();
                $.ajax({
                    type: "post",
                    url: "{{ url('/load-statistic') }}",
                    data: {
                        start: start,
                        end: end,
                        _token: _token
                    },
                    dataType: "json",
                    success: function(data) {
                        var labels = [];
                        var dat = [];
                        var order = [];
                        $.each(data, function(key, value) {
                            labels.push(value.order_date);
                            dat.push(value.profit);
                            order.push(value.order);
                        })
                        chart.data.labels = labels;
                        chart.data.datasets[0].data = dat;
                        chart.data.datasets[1].data = order;
                        chart.update();
                    }
                });
            });
        var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
        var gradient = ctx.createLinearGradient(0, 0, 0, 225);
        gradient.addColorStop(0, "rgba(255, 217, 112, 1)");
        gradient.addColorStop(1, "rgba(255, 217, 112, 0)");
        var gradient1 = ctx.createLinearGradient(0, 0, 0, 225);
        gradient1.addColorStop(0, "rgba(133, 146, 219, 1)");
        gradient1.addColorStop(1, "rgba(133, 146, 219, 0)");
        var chart = new Chart(document.getElementById("chartjs-dashboard-line"), {
            type: "line",
            data: {
                labels: [],
                datasets: [{
                    label: "Thu nhập",
                    fill: true,
                    backgroundColor: gradient,
                    borderColor: window.theme.warning,
                    data: []
                }, {
                    label: "Đơn hàng",
                    fill: true,
                    backgroundColor: gradient1,
                    borderColor: window.theme.primary,
                    data: []
                }]
            },
            options: {
                maintainAspectRatio: false,
                legend: {
                    display: true
                },
                tooltips: {
                    intersect: false,
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var label = data.datasets[tooltipItem.datasetIndex].label || '';
                            if (label) {
                                label += ': ';
                            }
                            label += tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                            return label;
                        }
                    }
                },
                hover: {
                    intersect: true
                },
                plugins: {
                    filler: {
                        propagate: false
                    }
                },
                scales: {
                    xAxes: [{
                        reverse: true,
                        // gridLines: {
                        //     color: "rgba(0,0,0,0.0)"
                        // }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                if (Math.floor(value) === value) {
                                    return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                }
                            }
                        },
                        display: true,
                        borderDash: [3, 3],
                        // gridLines: {
                        //     color: "rgba(0,0,0,0.0)"
                        // }
                    }]
                }
            }
        });

        function load_data() {
            var _token = $('input[name=_token]').val();
            $.ajax({
                type: "post",
                url: "{{ url('/load-chart') }}",
                data: {
                    _token: _token
                },
                dataType: "json",
                success: function(data) {
                    var labels = [];
                    var dat = [];
                    var order = [];
                    $.each(data, function(key, value) {
                        labels.push(value.order_date);
                        dat.push(value.profit);
                        order.push(value.order);
                    })
                    chart.data.labels = labels;
                    chart.data.datasets[0].data = dat;
                    chart.data.datasets[1].data = order;
                    chart.update();
                }
            });
        }
        load_data();

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Pie chart
            new Chart(document.getElementById("chartjs-dashboard-pie"), {
                type: "pie",
                data: {
                    labels: ["Chrome", "Firefox", "IE"],
                    datasets: [{
                        data: [4306, 3801, 1689],
                        backgroundColor: [
                            window.theme.primary,
                            window.theme.warning,
                            window.theme.danger
                        ],
                        borderWidth: 5
                    }]
                },
                options: {
                    responsive: !window.MSInputMethodContext,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 75
                }
            });
        });

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var markers = [{
                    coords: [31.230391, 121.473701],
                    name: "Shanghai"
                },
                {
                    coords: [37.532600, 127.024612],
                    name: "Seoul"
                },
                {
                    coords: [55.751244, 37.618423],
                    name: "Moscow"
                },
                {
                    coords: [35.689487, 139.691711],
                    name: "Tokyo"
                },
                {
                    coords: [17.483, 106.600],
                    name: "Quang Binh"
                },
                {
                    coords: [40.7127837, -74.0059413],
                    name: "New York"
                },
                {
                    coords: [34.052235, -118.243683],
                    name: "Los Angeles"
                },
                {
                    coords: [41.878113, -87.629799],
                    name: "Chicago"
                },
                {
                    coords: [51.507351, -0.127758],
                    name: "London"
                },
                {
                    coords: [40.416775, -3.703790],
                    name: "Madrid "
                }
            ];
            var map = new JsVectorMap({
                map: "world",
                selector: "#world_map",
                zoomButtons: true,
                markers: markers,
                markerStyle: {
                    initial: {
                        r: 9,
                        strokeWidth: 7,
                        stokeOpacity: .4,
                        fill: window.theme.primary
                    },
                    hover: {
                        fill: window.theme.primary,
                        stroke: window.theme.primary
                    }
                }
            });
            window.addEventListener("resize", () => {
                map.updateSize();
            });
        });

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("datetimepicker-dashboard").flatpickr({
                inline: true,
                prevArrow: "<span class=\"fas fa-chevron-left\" title=\"Previous month\"></span>",
                nextArrow: "<span class=\"fas fa-chevron-right\" title=\"Next month\"></span>",
            });
        });

    </script>
@endpush
