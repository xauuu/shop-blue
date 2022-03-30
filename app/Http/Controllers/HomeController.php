<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Customer;
use App\Models\Customer_Social;
use App\Models\Faq;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Slider;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\File;
use Socialite;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        $category = Category::all();
        $product_latest = Product::latest()->limit(8)->get();
        $product_sale = Product::orderBy('product_sale_quantity', 'desc')->take(8)->get();
        $slider = Slider::all();
        $contact = Contact::first();
        $sale = Sale::where('sale_status', 1)->first();
        return view('pages.home', compact('category', 'product_latest', 'product_sale', 'slider', 'contact', 'sale'));
    }
    public function shop()
    {
        $customer_id = Session::get('customer_id') != null ? Session::get('customer_id') : 0;
        $cook = Cookie::get($customer_id);
        $page = isset($cook) ? $cook : 12;
        $category = Category::where('category_status', 1)->get();
        $brand = Brand::where('brand_status', 1)->get();
        $contact = Contact::first();
        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
            if ($sort == 'tang_dan') {
                $product = Product::where('product_status', 1)
                    ->orderBy('product_discount', "ASC")
                    ->paginate($page)->appends(request()->query());
            } elseif ($sort == 'giam_dan') {
                $product = Product::where('product_status', 1)
                    ->orderBy('product_discount', "DESC")
                    ->paginate($page)->appends(request()->query());
            } elseif ($sort == 'a_z') {
                $product = Product::where('product_status', 1)
                    ->orderBy('product_name', "ASC")
                    ->paginate($page)->appends(request()->query());
            } elseif ($sort == 'z_a') {
                $product = Product::where('product_status', 1)
                    ->orderBy('product_name', "DESC")
                    ->paginate($page)->appends(request()->query());
            }
        } elseif (isset($_GET['min']) && isset($_GET['max'])) {
            $min = $_GET['min'] * 1000;
            $max = $_GET['max'] * 1000;

            $product = Product::where('product_status', 1)
                ->whereBetween('product_discount', [$min, $max])
                ->paginate($page)->appends(request()->query());
        } else {
            $product = Product::where('product_status', 1)->paginate($page);
        }
        return view('pages.categories.show-product', compact('product', 'category', 'brand', 'contact'));
    }
    public function category($category_slug)
    {
        $category = Category::where('category_status', 1)->get();
        $brand = Brand::where('brand_status', 1)->get();
        $contact = Contact::first();
        $customer_id = Session::get('customer_id') != null ? Session::get('customer_id') : 0;
        $cook = Cookie::get($customer_id);
        $page = isset($cook) ? $cook : 6;

        $cate_slug = Category::where('category_slug', $category_slug)->first();
        $category_id = $cate_slug->category_id;

        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
            if ($sort == 'tang_dan') {
                $product = Product::join('categories', 'categories.category_id', 'products.category_id')
                    ->where(function ($query) use ($category_id) {
                        return $query->where('products.category_id', $category_id)
                            ->orWhere('category_parent', $category_id);
                    })->where('product_quantity', '>', 0)
                    ->orderBy('product_discount', "ASC")
                    ->paginate($page)->appends(request()->query());
            } elseif ($sort == 'giam_dan') {
                $product = Product::join('categories', 'categories.category_id', 'products.category_id')
                    ->where(function ($query) use ($category_id) {
                        return $query->where('products.category_id', $category_id)
                            ->orWhere('category_parent', $category_id);
                    })->where('product_quantity', '>', 0)
                    ->orderBy('product_discount', "DESC")
                    ->paginate($page)->appends(request()->query());
            } elseif ($sort == 'a_z') {
                $product = Product::join('categories', 'categories.category_id', 'products.category_id')
                    ->where(function ($query) use ($category_id) {
                        return $query->where('products.category_id', $category_id)
                            ->orWhere('category_parent', $category_id);
                    })->where('product_quantity', '>', 0)
                    ->orderBy('product_name', "ASC")
                    ->paginate($page)->appends(request()->query());
            } elseif ($sort == 'z_a') {
                $product = Product::join('categories', 'categories.category_id', 'products.category_id')
                    ->where(function ($query) use ($category_id) {
                        return $query->where('products.category_id', $category_id)
                            ->orWhere('category_parent', $category_id);
                    })->where('product_quantity', '>', 0)
                    ->orderBy('product_name', "DESC")
                    ->paginate($page)->appends(request()->query());
            }
        } elseif (isset($_GET['min']) && isset($_GET['max'])) {
            $min = $_GET['min'] * 1000;
            $max = $_GET['max'] * 1000;

            $product = Product::join('categories', 'categories.category_id', 'products.category_id')
                ->where(function ($query) use ($category_id) {
                    return $query->where('products.category_id', $category_id)
                        ->orWhere('category_parent', $category_id);
                })->where('product_quantity', '>', 0)
                ->whereBetween('product_discount', [$min, $max])
                ->paginate($page)->appends(request()->query());
        } else {
            $product = Product::join('categories', 'categories.category_id', 'products.category_id')
                ->where(function ($query) use ($category_id) {
                    return $query->where('products.category_id', $category_id)
                        ->orWhere('category_parent', $category_id);
                })->where('product_quantity', '>', 0)->paginate($page);
        }

        return view('pages.categories.show-product', compact('product', 'category', 'brand', 'contact'));
    }
    public function brand($brand_slug)
    {
        $customer_id = Session::get('customer_id') != null ? Session::get('customer_id') : 0;
        $cook = Cookie::get($customer_id);
        $page = isset($cook) ? $cook : 6;
        $contact = Contact::first();
        $category = Category::where('category_status', 1)->get();
        $brand = Brand::where('brand_status', 1)->get();

        $b_slug = Brand::where('brand_slug', $brand_slug)->first();
        $brand_id = $b_slug->brand_id;

        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
            if ($sort == 'tang_dan') {
                $product = Product::where('brand_id', $brand_id)
                    ->where('product_status', 1)
                    ->orderBy('product_discount', "ASC")
                    ->paginate($page)->appends(request()->query());
            } elseif ($sort == 'giam_dan') {
                $product = Product::where('brand_id', $brand_id)
                    ->where('product_status', 1)
                    ->orderBy('product_discount', "DESC")
                    ->paginate($page)->appends(request()->query());
            } elseif ($sort == 'a_z') {
                $product = Product::where('brand_id', $brand_id)
                    ->where('product_status', 1)
                    ->orderBy('product_name', "ASC")
                    ->paginate($page)->appends(request()->query());
            } elseif ($sort == 'z_a') {
                $product = Product::where('brand_id', $brand_id)
                    ->where('product_status', 1)
                    ->orderBy('product_name', "DESC")
                    ->paginate($page)->appends(request()->query());
            }
        } elseif (isset($_GET['min']) && isset($_GET['max'])) {
            $min = $_GET['min'] * 1000;
            $max = $_GET['max'] * 1000;

            $product = Product::where('brand_id', $brand_id)
                ->where('product_status', 1)
                ->whereBetween('product_discount', [$min, $max])
                ->paginate($page)->appends(request()->query());
        } else {
            $product = Product::where('brand_id', $brand_id)
                ->where('product_status', 1)
                ->paginate($page);
        }

        return view('pages.categories.show-product', compact('product', 'category', 'brand', 'contact'));
    }
    public function tag($tag)
    {
        $customer_id = Session::get('customer_id') != null ? Session::get('customer_id') : 0;
        $cook = Cookie::get($customer_id);
        $page = isset($cook) ? $cook : 6;
        $contact = Contact::first();
        $category = Category::where('category_status', 1)->get();
        $brand = Brand::where('brand_status', 1)->get();

        $product = Product::where('product_status', 1)
            ->where('product_name', 'LIKE', '%' . $tag . '%')
            ->orWhere('product_tag', 'LIKE', '%' . $tag . '%')
            ->orWhere('product_slug', 'LIKE', '%' . $tag . '%')
            ->paginate($page);
        return view('pages.categories.show-product', compact('product', 'category', 'brand', 'contact'));
    }
    public function login()
    {
        return view('pages.login');
    }
    public function logout()
    {
        Session::put('customer_id', null);
        Session::put('customer_name', null);
        Session::put('customer_avatar', null);
        session()->forget('coupon');
        return Redirect::back();
    }
    public function check_login(Request $request)
    {
        $email = $request->email;
        $pass = md5($request->pass);

        $user = Customer::where('customer_email', $email)->where('customer_pass', $pass)->first();
        if ($user) {
            if ($user->customer_status == 0) {
                Session::put('customer_id', $user->id);
                Session::put('customer_name', $user->customer_name);
                return Redirect::to(session('backUrl'));
            } else {
                Session::flash('error', "Tài khoản của bạn đã bị khoá");
                Session::put('customer_id', null);
                Session::put('customer_name', null);
                return Redirect::to('/login-customer');
            }
        } else {
            Session::flash('error', "Bạn nhập sai email hoặc mật khẩu");
            Session::put('customer_id', null);
            Session::put('customer_name', null);
            return Redirect::to('/login-customer');
        }
    }
    public function registration()
    {
        return view('pages.registration');
    }
    public function check_registration(Request $request)
    {
        $email = $request->email;
        $name = $request->name;
        $pass = md5($request->pass);

        $user = Customer::where('customer_email', $email)->first();
        if ($user) {
            Session::flash('error', "Email này đã được đăng kí");
            return Redirect::to('/registration');
        } else {
            $customer = new Customer();
            $customer->customer_email = $email;
            $customer->customer_name = $name;
            $customer->customer_pass = $pass;
            $customer->customer_status = 0;

            $customer->save();
            return Redirect::to('/login-customer');
        }
    }
    public function search_ajax(Request $request)
    {
        if (is_numeric($request->search)) {
            $val1 = $request->search - $request->search * 15 / 100;
            $val2 = $request->search + $request->search * 15 / 100;
            $search = Product::whereBetween('product_discount', [$val1, $val2])->take(5)->get();
        } else {
            $search = Product::where('product_name', 'like', "%{$request->search}%")->take(5)->get();
        }
        $output = '<ul class="dropdown-menu search">';
        if (count($search)) {
            foreach ($search as $item) {
                $output .= '
                    <li>
                        <a class="dropdown-item" href="' . url('/product-detail/' . $item->product_slug) . '">
                        <span>' . $item->product_name . ' -&nbsp</span>
                        <span> ' . number_format($item->product_discount) . ' VND</span>
                        </a>
                    </li>';
            }
        } else {
            $output .= '<li>Không có kết quả</li>';
        }

        $output .= '</ul>';
        echo $output;
    }
    public function search(Request $request)
    {
        $customer_id = Session::get('customer_id') != null ? Session::get('customer_id') : 0;
        $cook = Cookie::get($customer_id);
        $page = isset($cook) ? $cook : 6;

        $category = Category::where('category_status', 1)->get();
        $brand = Brand::where('brand_status', 1)->get();

        if (is_numeric($request->search)) {
            $val1 = $request->search - $request->search * 15 / 100;
            $val2 = $request->search + $request->search * 15 / 100;
            $product = Product::whereBetween('product_discount', [$val1, $val2])->paginate($page);
            $mess = "Kết quả tìm kiếm cho giá sản phẩm từ: " .  number_format($request->search) . " VND";
        } else {
            $product = Product::where('product_name', 'like', "%{$request->search}%")->paginate($page);
            $mess = "Kết quả tìm kiếm cho từ khoá: " . "'" . $request->search . "'";
        }
        return view('pages.categories.product-search', compact('category', 'brand', 'product', 'mess'));
    }
    public function paginate(Request $request)
    {
        $page = $request->page;
        $id = Session::get('customer_id');
        Cookie::queue($id, $page, 3600 * 24 * 7);
    }
    public function contact()
    {
        $category = Category::all();
        $contact = Contact::first();
        return view('pages.contact', compact('category', 'contact'));
    }
    public function faq()
    {
        $category = Category::all();
        $contact = Contact::first();
        $faq = Faq::all();
        return view('pages.faq', compact('category', 'contact', 'faq'));
    }
    // login facebook
    public function login_facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook()
    {
        $provider = Socialite::driver('facebook')->user();
        $account = Customer_Social::where('provider', 'facebook')->where('provider_user_id', $provider->getId())->first();
        if ($account) {
            //login in vao trang quan tri
            $account_name = Customer::where('id', $account->user)->first();
            Session::put('customer_name', $account_name->customer_name);
            Session::put('customer_avatar', $account_name->customer_avatar);
            Session::put('customer_id', $account_name->id);
            return redirect(session('backUrl'));
        } else {

            $customer_social = new Customer_Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Customer::where('customer_email', $provider->getEmail())->first();

            if (!$orang) {
                $orang = Customer::create([
                    'customer_name' => $provider->getName(),
                    'customer_email' => $provider->getEmail(),
                    'customer_avatar' => $provider->getAvatar(),
                    'customer_pass' => '0',
                    'customer_status' => 0
                ]);
            }
            $customer_social->login()->associate($orang);
            $customer_social->save();

            $account_name = Customer::where('id', $customer_social->user)->first();

            Session::put('customer_name', $account_name->customer_name);
            Session::put('customer_avatar', $account_name->customer_avatar);
            Session::put('customer_id', $account_name->id);
            return redirect(session('backUrl'));
        }
    }

    public function login_google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback_google()
    {
        $provider = Socialite::driver('google')->user();
        $account = Customer_Social::where('provider', 'google')->where('provider_user_id', $provider->getId())->first();
        if ($account) {
            $account_name = Customer::where('id', $account->user)->first();
            Session::put('customer_name', $account_name->customer_name);
            Session::put('customer_avatar', $account_name->customer_avatar);
            Session::put('customer_id', $account_name->id);
            return redirect(session('backUrl'));
        } else {

            $customer_social = new Customer_Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'google'
            ]);

            $orang = Customer::where('customer_email', $provider->getEmail())->first();

            if (!$orang) {
                $orang = Customer::create([
                    'customer_name' => $provider->getName(),
                    'customer_email' => $provider->getEmail(),
                    'customer_avatar' => $provider->getAvatar(),
                    'customer_pass' => '0',
                    'customer_status' => 0
                ]);
            }
            $customer_social->login()->associate($orang);
            $customer_social->save();

            $account_name = Customer::where('id', $customer_social->user)->first();

            Session::put('customer_name', $account_name->customer_name);
            Session::put('customer_avatar', $account_name->customer_avatar);
            Session::put('customer_id', $account_name->id);
            return redirect(session('backUrl'));
        }
    }
    public function my_account()
    {
        $contact = Contact::first();
        $category = Category::all();
        $customer = Customer::where('id', session('customer_id'))->first();
        return view('pages.my-account', compact('category', 'customer', 'contact'));
    }
    public function update_account(Request $request)
    {
        $customer = Customer::find(session('customer_id'));
        $customer->customer_name = $request->name;
        $customer->customer_email = $request->email;
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $name = vn_to_str($request->name);
            $img_name = $name . '-' . 'avatar' . '-' . date('mdYHis') . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/avatar', $img_name);
            $customer->customer_avatar = url('/') . '/uploads/avatar/' . $img_name;
            Session::put('customer_avatar', url('/') . '/uploads/avatar/' . $img_name);
        }
        $customer->save();
        return redirect()->back();
    }
}
