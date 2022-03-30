<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Faq;
use App\Models\Sale;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class PageController extends Controller
{
    // slider
    public function add_slider()
    {
        return  view('admin.slider.add-slider');
    }
    public function save_slider(Request $request)
    {
        $slider = new Slider();
        $slider->slider_name = $request->slider_name;
        $slider->slider_title = $request->slider_title;
        $slider->slider_discount = $request->slider_discount;
        $slider->slider_content = $request->slider_content;

        $file = $request->slider_img;
        $name = vn_to_str($request->slider_title);
        $img_name = $name . '-' . date('mdYHis') . '.' . $file->getClientOriginalExtension();
        $file->move('uploads/slider', $img_name);
        $slider->slider_img = $img_name;

        $slider->save();
        return Redirect::back();
    }
    public function all_slider()
    {
        $slider = Slider::all();
        return view('admin.slider.all-slider', compact('slider'));
    }
    public function delete_slider($slider_id)
    {
        $slider = Slider::find($slider_id);
        $slider->delete();
        return redirect()->back()->with('success', "Đã xoá slider");
    }
    public function edit_slider($slider_id)
    {
        $slider = Slider::find($slider_id);
        return view('admin.slider.edit-slider', compact('slider'));
    }
    public function update_slider(Request $request)
    {
        $slider = Slider::find($request->slider_id);
        $img = $slider->slider_img;
        $slider->slider_name = $request->slider_name;
        $slider->slider_title = $request->slider_title;
        $slider->slider_discount = $request->slider_discount;
        $slider->slider_content = $request->slider_content;
        if ($request->hasFile('slider_img')) {
            $file = $request->slider_img;
            $name = vn_to_str($request->slider_title);
            $img_name = $name . '-' . date('mdYHis') . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/slider', $img_name);
            $slider->slider_img = $img_name;

            $image_path = public_path("uploads/slider/" . $img);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        $slider->save();
        return Redirect::to('/admin/slider/all-slider')->with('success', "Đã cập nhật slider");
    }
    // faq
    public function add_faq()
    {
        return  view('admin.faq.add-faq');
    }
    public function save_faq(Request $request)
    {
        $faq = new Faq();
        $faq->faq_question = $request->faq_question;
        $faq->faq_answer = $request->faq_answer;

        $faq->save();
        return Redirect::to('admin/faq/all-faq')->with('success', 'Đã thêm câu hỏi mới');
    }
    public function all_faq()
    {
        $faq = Faq::all();
        return view('admin.faq.all-faq', compact('faq'));
    }
    public function delete_faq($faq_id)
    {
        $faq = Faq::find($faq_id);
        $faq->delete();
        return redirect()->back()->with('success', "Đã xoá câu hỏi");
    }
    public function edit_faq($faq_id)
    {
        $faq = Faq::find($faq_id);
        return view('admin.faq.edit-faq', compact('faq'));
    }
    public function update_faq(Request $request)
    {
        $faq = Faq::find($request->faq_id);
        $faq->faq_question = $request->faq_question;
        $faq->faq_answer = $request->faq_answer;
        $faq->save();
        return Redirect::to('/admin/faq/all-faq')->with('success', "Đã cập nhật câu hỏi");
    }

    // sale
    public function add_sale()
    {
        $product = Product::all();
        return  view('admin.sale.add-sale', compact('product'));
    }
    public function save_sale(Request $request)
    {
        $this->validation($request);
        $sale = new Sale();
        $sale->sale_name = $request->sale_name;
        $sale->product_id = $request->product_id;
        $sale->sale_percent = $request->sale_percent;
        $sale->sale_time = $request->sale_time;
        $sale->sale_status = 1;

        $file = $request->sale_img;
        $img_name = vn_to_str($request->sale_name) . '-' . date('mdYHis') . '.' . $file->getClientOriginalExtension();
        $file->move('uploads/sale', $img_name);
        $sale->sale_img = $img_name;

        $product = Product::find($request->product_id);
        $product->product_discount = $product->product_price - $product->product_price * $request->sale_percent / 100;
        $product->save();

        $sale->save();
        return Redirect::to('admin/sale/all-sale')->with('success', 'Đã thêm siêu sale mới');
    }
    public function all_sale()
    {
        $this->te();
        $sale = Sale::all();
        return view('admin.sale.all-sale', compact('sale'));
    }
    public function delete_sale($sale_id)
    {
        $sale = Sale::find($sale_id);
        $product = Product::find($sale->product_id);
        $product->product_discount = $product->product_price;
        $product->save();
        $sale->delete();
        return redirect()->back()->with('success', "Đã xoá siêu sale " . $sale->sale_name);
    }
    public function edit_sale($sale_id)
    {
        $product = Product::all();
        $sale = Sale::find($sale_id);
        return view('admin.sale.edit-sale', compact('sale', 'product'));
    }
    public function update_sale(Request $request)
    {
        $sale = Sale::find($request->sale_id);
        $sale->sale_name = $request->sale_name;
        $sale->product_id = $request->product_id;
        $sale->sale_percent = $request->sale_percent;
        $sale->sale_time = $request->sale_time;
        $sale->sale_status = 1;

        if ($request->hasFile('sale_img')) {
            $file = $request->sale_img;
            $img_name = vn_to_str($request->sale_name) . '-' . date('mdYHis') . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/sale', $img_name);
            $sale->sale_img = $img_name;
        }

        $product = Product::find($request->product_id);
        $product->product_discount = $product->product_price - $product->product_price * $request->sale_percent / 100;
        $product->save();

        $sale->save();
        return Redirect::to('/admin/sale/all-sale')->with('success', "Đã cập nhật siêu sale " . $sale->sale_name);
    }
    public function validation($request)
    {
        return $this->validate($request, [
            'sale_name' => 'required|max:255',
            'sale_percent' => 'required|max:255',
            'sale_time' => 'required|max:255'
        ]);
    }
    public function te()
    {
        $sale = Sale::where('sale_status', 1)->get();
        $day = Carbon::now('Asia/Ho_Chi_Minh')->format('Y/m/d');
        foreach ($sale as $item) {
            if ($day > $item->sale_time) {
                $update_sale = Sale::find($item->sale_id);
                $update_sale->sale_status = 0;

                $product = Product::find($item->product_id);
                $product->product_discount = $product->product_price;
                $product->save();

                $update_sale->save();
            }
        }
    }
}
