@component('mail::message')

 # Đặt hàng thành công

 Cám ơn bạn đã đặt hàng tại shop xxx
 Chi tiết đơn hàng

@component('mail::table')
| Tên sản phẩm | Giá | Số lượng | Tổng tiền |
|:----:| -----:| ---:| --------:|
@foreach ($details as $item)
| {{ $item->name }} | {{ $item->price }} | {{ $item->qty }}| {{ $item->price * $item->qty }} |
@endforeach
@php
$total_coupon = 0;
@endphp
@if (session('coupon'))
@foreach (session('coupon') as $item => $cou)
@if ($cou['coupon_feature'] == 1)
@php
$total_coupon = $cou['coupon_number']*Cart::subtotal(0, '', '')/100;
@endphp
@else
@php
$total_coupon = $cou['coupon_number'];
@endphp
@endif
@endforeach
| | | Mã giảm giá: | -{{ number_format($total_coupon) }} |
@endif
| | | Tổng cộng: | {{ number_format(Cart::subtotal(0, '', '') - $total_coupon) }} |
@endcomponent

@component('mail::button', ['url' => 'https://larave-news.com', 'color' => 'blue'])
Trở lại cửa hàng
@endcomponent
{{ date('d-m-Y') }}
@endcomponent
