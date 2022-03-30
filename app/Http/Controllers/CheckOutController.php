<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Mail\SendMail;
use App\Mail\test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\City;
use App\Models\Contact;
use App\Models\District;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Statistic;
use App\Models\Wards;
use Carbon\Carbon;
use Cart;

class CheckOutController extends Controller
{
    public function check_out()
    {
        if(Cart::content()->isEmpty()) return redirect('/home');
        $contact = Contact::first();
        $category = Category::all();
        $city = City::orderBy('matp', 'asc')->get();
        if (session('customer_id')) {
            return view('pages.cart.check-out', compact('category', 'city', 'contact'));
        } else {
            return Redirect::to('/login-customer');
        }
    }
    public function save_checkout(Request $request)
    {
        $shipping = new Shipping();
        $all = $request->all();
        $shipping->shipping_name = $all['firstname'] . ' ' . $all['lastname'];
        $shipping->shipping_email = $all['email'];
        $shipping->shipping_phone = $all['phone'];
        $city = City::findOrFail($all['city']);
        $district = District::findOrFail($all['district']);
        $wards = Wards::findOrFail($all['wards']);
        $address = $all['address'] . ', ' . $wards->name_wards . ', ' . $district->name_district . ', ' . $city->name_city;
        $shipping->shipping_address = $address;
        $shipping->save();
        $shipping_id = $shipping->shipping_id;
        $customer_id = session('customer_id');


        $order = new Order();
        $order->customer_id = $customer_id;
        $order->shipping_id = $shipping_id;

        if (session('coupon')) {
            $couponn = session('coupon');
            foreach (session('coupon') as $item => $cou) {
                $coupon_code = $cou['coupon_code'];
                $discount = 0;
                if ($cou['coupon_feature'] == 1) {
                    $discount = $cou['coupon_number'] * Cart::subtotal(0, '', '') / 100;
                } else {
                    $discount = $cou['coupon_number'];
                }
            }
            $order->coupon_code = $coupon_code;
            $order->discount = $discount;
            $order->order_total = Cart::subtotal(0, '', '') - $discount;
        } else {
            $couponn = null;
            $order->order_total = Cart::subtotal(0, '', '');
        }

        $order->order_payment = $request->payment;
        $order->order_status = '0';
        $order->order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $order->save();
        $order_id = $order->order_id;

        $cart = Cart::content();
        foreach ($cart as $item) {
            $order_detail = new OrderDetail();
            $order_detail->order_id = $order_id;
            $order_detail->product_id = $item->id;
            $order_detail->quantity = $item->qty;
            $order_detail->product_price = $item->price;
            $order_detail->save();
        }

        $emailJob = new SendEmail($cart, $all['email'], $all['firstname'] . ' ' . $all['lastname'], $all['phone'], $address, $couponn);
        dispatch($emailJob);
        // Mail::to($all['email'])->send(new SendMail($cart));
        Cart::destroy();
        session()->forget('coupon');
        return Redirect::to('/your-order');
    }
    public function select(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == 'city') {
                $select = District::where('matp', $data['city_id'])->orderby('maqh', 'asc')->get();
                $output = '<option value="">Chọn quận, huyện</option>';
                foreach ($select as $item) {
                    $output .= '<option value="' . $item->maqh . '">' . $item->name_district . '</option>';
                }
            } else {
                $output = '<option value="">Chọn xã, phường</option>';
                $select = Wards::where('maqh', $data['city_id'])->orderby('xaid', 'asc')->get();
                foreach ($select as $item) {
                    $output .= '<option value="' . $item->xaid . '">' . $item->name_wards . '</option>';
                }
            }
            echo $output;
        }
    }
    public function your_order()
    {
        $contact = Contact::first();
        $category = Category::all();
        $order = Order::where('customer_id', session('customer_id'))->orderBy('order_id', 'desc')->get();
        return view('pages.cart.your-order', compact('category', 'order', 'contact'));
    }
    public function cancel_your_order($order_id)
    {
        $order = Order::find($order_id);
        $order->order_status = 2;
        $order->save();
        return redirect()->back();
    }
    // back end
    public function confirm_order()
    {
        AuthLogin();
        $all_order = Order::join('customers', 'orders.customer_id', 'customers.id')
            ->select('orders.*', 'customers.customer_name')
            ->where('order_status', 0)
            ->orderby('orders.order_id', 'desc')->paginate(10);
        return view('admin.order.confirm-order', compact('all_order'));
    }
    public function success_order()
    {
        AuthLogin();
        $all_order = Order::join('customers', 'orders.customer_id', 'customers.id')
            ->select('orders.*', 'customers.customer_name')
            ->where('order_status', 1)
            ->orderby('orders.order_id', 'desc')->paginate(10);
        return view('admin.order.confirm-order', compact('all_order'));
    }
    public function cancel_order()
    {
        AuthLogin();
        $all_order = Order::join('customers', 'orders.customer_id', 'customers.id')
            ->select('orders.*', 'customers.customer_name')
            ->where('order_status', 2)
            ->orderby('orders.order_id', 'desc')->paginate(10);
        return view('admin.order.confirm-order', compact('all_order'));
    }
    public function all_order()
    {
        AuthLogin();
        $all_order = Order::join('customers', 'orders.customer_id', 'customers.id')
            ->select('orders.*', 'customers.customer_name')
            ->orderby('orders.order_id', 'desc')->paginate(10);
        return view('admin.order.confirm-order', compact('all_order'));
    }
    public function detail_order($order_id)
    {
        AuthLogin();

        $detail_order = Order::findOrFail($order_id);

        return view('admin.order.detail-order', compact('detail_order'));
    }
    public function agree_order($order_id)
    {
        $order = Order::find($order_id);
        $order->order_status = '1';
        $order->save();
        $statistic = Statistic::where('order_date', $order->order_date)->get();
        if ($statistic) {
            $count_sta = $statistic->count();
        } else {
            $count_sta = 0;
        }

        $sales = $order->order_total;
        $quantity = 0;

        foreach ($order->order_detail as $item) {
            $product = Product::find($item->product->product_id);
            $product_sold = $item->quantity;
            $product->product_quantity = $product->product_quantity - $product_sold;
            $product->product_sale_quantity = $product->product_sale_quantity + $product_sold;
            $product->save();
            $quantity += $item->quantity;
        }

        if ($count_sta > 0) {
            $statistic_update = Statistic::where('order_date', $order->order_date)->first();
            $statistic_update->sales = $statistic_update->sales + $sales;
            $statistic_update->quantity = $statistic_update->quantity + $quantity;
            $statistic_update->total_order = $statistic_update->total_order + 1;
            $statistic_update->save();
        } else {
            $statistic_new = new Statistic();
            $statistic_new->order_date = $order->order_date;
            $statistic_new->sales = $sales;
            $statistic_new->quantity = $quantity;
            $statistic_new->total_order = 1;
            $statistic_new->save();
        }
        return redirect()->back()->with('success', 'Bạn đã xác nhận đơn hàng đơn hàng');
    }
    public function xoa_order($order_id)
    {
        $order = Order::find($order_id);
        $order->order_status = '2';
        $order->save();
        return redirect()->back()->with('success', 'Bạn đã huỷ đơn hàng');
    }
}
