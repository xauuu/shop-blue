<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    public function add_coupon()
    {
        return view('admin.coupon.add-coupon');
    }
    public function all_coupon()
    {
        $coupon = Coupon::all();
        return view('admin.coupon.all-coupon', compact('coupon'));
    }
    public function save_coupon(Request $request)
    {
        $all = $request->all();
        $coupon = new Coupon();
        $coupon->coupon_name = $all['coupon_name'];
        $coupon->coupon_code = $all['coupon_code'];
        $coupon->coupon_times = $all['coupon_times'];
        $coupon->coupon_feature = $all['coupon_feature'];
        $coupon->coupon_number   = $all['coupon_number'];

        $coupon->save();
        Session::flash('success', 'Bạn đã thêm mã giảm giá ' . $all['coupon_name']);
        return Redirect::to('admin/coupon/all-coupon');
    }
    public function delete_coupon($coupon_id)
    {
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        Session::flash('success', 'Bạn đã xoá mã giảm giá ' . $coupon->coupon_name);
        return Redirect::to('admin/coupon/all-coupon');
    }
}
