<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Coupon;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Contact;
use Cart;

class CartController extends Controller
{
    public function add_cart_w_qty(Request $request)
    {
        $product = Product::find($request->product_id);
        $qty_available = 0;
        $cart = Cart::search(function ($cartItem, $rowId) use ($product) {
            return $cartItem->id === $product->product_id;
        });
        if (!$cart->isEmpty()) {
            $qty_available = $cart->first()->qty;
        }
        if ($request->quantity + $qty_available <= $product->product_quantity) {
            $data = array();
            $data['id'] = $product->product_id;
            $data['qty'] = $request->quantity;
            $data['name'] = $product->product_name;
            $data['price'] = $product->product_discount;
            $data['weight'] = '0';
            $data['options']['slug'] = $product->product_slug;
            $data['options']['image'] = $product->product_img;
            Cart::add($data);

            echo Cart::content()->count();
        } else {
            echo 'Số lượng sản phẩm trong kho không đủ';
        }
    }
    public function add_cart_ajax(Request $request)
    {
        $product = Product::find($request->id);
        $data = array();
        $data['id'] = $product->product_id;
        $data['qty'] = '1';
        $data['name'] = $product->product_name;
        $data['price'] = $product->product_discount;
        $data['weight'] = '0';
        $data['options']['slug'] = $product->product_slug;
        $data['options']['image'] = $product->product_img;
        Cart::add($data);

        echo Cart::content()->count();
    }

    public function show_cart()
    {
        $contact = Contact::first();
        $category = Category::all();
        return view('pages.cart.show-cart', compact('category', 'contact'));
    }
    public function delete_cart(Request $request)
    {
        Cart::remove($request->rowId);
        $cart = Cart::content();
        $total_cost = number_format(Cart::subtotal(0, '', '')) . " VND";
        echo $total_cost;
    }
    // public function update_cart(Request $request)
    // {
    //     foreach ($request->qty as $rowId => $qty) {
    //         $check = Cart::get($rowId);
    //         $product = Product::find($check->id);
    //         if ($qty < $product->product_quantity) {
    //             Cart::update($rowId, $qty);
    //         } else {
    //             Session::flash('mess', "Số lượng sản phẩm trong kho không đủ");
    //         }
    //     }
    //     return Redirect::to('/cart');
    // }
    public function update_cart_test(Request $request)
    {
        $check = Cart::get($request->rowId);
        $product = Product::find($check->id);
        if ($request->qty < $product->product_quantity) {
            Cart::update($request->rowId, $request->qty);
            $cart = Cart::get($request->rowId);
            $result[] = array(
                'total_col' => number_format($cart->qty*$cart->price) . " VND",
                'total_cost' => number_format(Cart::subtotal(0, '', '')) . " VND",
            );
            echo json_encode($result);
        }else{
            echo 0;
        }
    }
    public function check_coupon(Request $request)
    {
        $coupon = Coupon::where('coupon_code', $request->coupon_code)->where('coupon_times', '>', 0)->first();
        if ($coupon) {
            if ($coupon->count() > 0) {
                if (Session::get('coupon')) {
                    $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_feature' => $coupon->coupon_feature,
                        'coupon_number' => $coupon->coupon_number,
                    );
                    Session::put('coupon', $cou);
                } else {
                    $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_feature' => $coupon->coupon_feature,
                        'coupon_number' => $coupon->coupon_number,
                    );
                    Session::put('coupon', $cou);
                }
                Session::save();
                $coupon->coupon_times = $coupon->coupon_times - 1;
                $coupon->save();
                return redirect()->back()->with('success', 'Sử dụng mã giảm giá thành công');
            }
        } else {
            return redirect()->back()->with('error', 'Không tồn tại mã giảm giá');
        }
    }
}
