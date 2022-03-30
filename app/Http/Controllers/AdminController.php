<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Statistic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use function GuzzleHttp\json_encode;

class AdminController extends Controller
{

    public function index()
    {
        AuthLogin();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $statistic = Statistic::where('order_date', $now)->first();
        $new_order = Order::where('order_date', $now)->where('order_status', 0)->get();
        $product_view = Product::all();
        return view('admin.admin-home', compact('statistic', 'product_view', 'new_order'));
    }
    public function statistic()
    {
        AuthLogin();
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $day = $now->toDateString();
        $this_week = $now->startOfWeek()->toDateString();
        $this_month = $now->startOfMonth()->toDateString();
        $statistic_week = Statistic::selectRaw('SUM(sales) as sales')
            ->selectRaw('SUM(quantity) as qty')
            ->selectRaw('SUM(total_order) as total')
            ->whereBetween('order_date', [$this_week, $day])->first();
        $statistic_month = Statistic::selectRaw('SUM(sales) as sales')
            ->selectRaw('SUM(quantity) as qty')
            ->selectRaw('SUM(total_order) as total')
            ->whereBetween('order_date', [$this_month, $day])->first();
        $statistic_total = Statistic::selectRaw('SUM(sales) as sales')
            ->selectRaw('SUM(quantity) as qty')
            ->selectRaw('SUM(total_order) as total')->first();
        return view('admin.statistic.statistic', compact('statistic_week', 'statistic_month', 'statistic_total'));
    }
    public function customer()
    {
        AuthLogin();
        $user = Customer::all();
        return view('admin.user.show-user', compact('user'));
    }
    public function delete_customer($customer_id)
    {
        $user = Customer::find($customer_id);
        $user->delete();
        return redirect()->back()->with('success', 'Bạn đã xoá tài khoản: ' . $user->customer_email);
    }
    public function lock_customer($customer_id)
    {
        $user = Customer::find($customer_id);
        if ($user->customer_status == 0) {
            $user->customer_status = 1;
            $user->save();
            return redirect()->back()->with('success', 'Bạn đã khoá tài khoản: ' . $user->customer_email);
        } else {
            $user->customer_status = 0;
            $user->save();
            return redirect()->back()->with('success', 'Bạn đã mở khoá tài khoản: ' . $user->customer_email);
        }
    }

    public function load_statistic(Request $request)
    {
        $start = $request->start;
        $end = $request->end;

        $statistic = Statistic::whereBetween('order_date', [$start, $end])
            ->orderBy('order_date', 'asc')->get();

        foreach ($statistic as $item) {
            $chart[] = array(
                'order_date' => $item->order_date,
                'profit' => $item->sales,
                'order' => $item->total_order
            );
        }
        echo json_encode($chart);
    }
    public function load_chart()
    {
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $last_day = $now->toDateString();
        $last_7_day = $now->subDays(7)->toDateString();
        $statistic = Statistic::whereBetween('order_date', [$last_7_day, $last_day])
            ->orderBy('order_date', 'asc')->get();

        foreach ($statistic as $item) {
            $chart[] = array(
                'order_date' => $item->order_date,
                'profit' => $item->sales,
                'order' => $item->total_order
            );
        }
        echo json_encode($chart);
    }
    public function contact()
    {
        $contact = Contact::first();
        return view('admin.contact', compact('contact'));
    }
    public function update_contact(Request $request)
    {
        $contact = Contact::first();
        $contact->contact_address = $request->contact_address;
        $contact->contact_phone = $request->contact_phone;
        $contact->contact_email = $request->contact_email;
        $contact->contact_company = $request->contact_company;
        $contact->save();
        return Redirect::back()->with('success', 'Đã cập nhật thông tin liên hệ');
    }
}
