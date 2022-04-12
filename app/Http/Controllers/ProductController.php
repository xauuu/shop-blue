<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Storage;

class ProductController extends Controller
{
    public function add_product()
    {
        AuthLogin();
        $category = Category::all();
        $brand = Brand::all();
        return  view('admin.product.add-product', compact('category', 'brand'));
    }
    public function all_product()
    {
        AuthLogin();
        if (isset($_GET['entries'])) {
            $paginate = $_GET['entries'];
            $product = Product::orderBy('product_order', 'asc')->paginate($paginate);
        } else {
            $product = Product::orderBy('product_order', 'asc')->paginate(5);
        }
        return view('admin.product.all-product', compact('product'));
    }
    public function save_product(Request $request)
    {
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->product_name = $request->product_name;
        $product->product_slug = $request->product_slug . '-' . date('mdYHis');;
        $product->product_tag = $request->product_tag;
        $product->product_desc = $request->product_desc;
        $product->product_quantity = $request->product_quantity;
        $product->product_price = $request->product_price;
        $product->product_discount = $request->product_discount;
        $product->product_detail = $request->product_detail;
        $product->product_status = $request->product_status;

        if ($request->hasFile('product_img')) {
            $file = $request->product_img;
            $name = vn_to_str($request->product_name);
            $img_name = $name . '-' . date('mdYHis') . '.' . $file->getClientOriginalExtension();
            // $file->move('uploads/product', $img_name);
            $product->img_name = $img_name;
            $product->product_img = $this->upload_to_drive($img_name, $file);
            $product->save();
        }
        Session::flash('success', 'Thêm sản phẩm thành công');
        return Redirect::to('admin/product/all-product');
    }
    public function product_status($product_id)
    {
        $product = Product::find($product_id);
        if ($product->product_status == 0) {
            $product->product_status = 1;
            $product->save();
            Session::flash('success', 'Hiển thị sản phẩm ' . $product->product_name);
        } else {
            $product->product_status = 0;
            $product->save();
            Session::flash('success', 'Ẩn sản phẩm ' . $product->product_name);
        }
        return Redirect::to('admin/product/all-product');
    }
    public function delete_product($product_id)
    {
        $product = Product::find($product_id);
        $this->delete_from_drive($product->img_name);
        $product->delete();
        Session::flash('success', 'Đã xoá sản phẩm ' . $product->product_name);
        return Redirect::to('admin/product/all-product');
    }
    public function edit_product($product_id)
    {
        AuthLogin();
        $product = Product::find($product_id);
        $category = Category::all();
        $brand = Brand::all();
        return view('admin.product.edit-product', compact('product', 'category', 'brand'));
    }
    public function update_product(Request $request)
    {
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        $pro_img = $product->product_img;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->product_name = $request->product_name;
        $product->product_slug = $request->product_slug . '-' . date('mdYHis');
        $product->product_tag = $request->product_tag;
        $product->product_quantity = $request->product_quantity;
        $product->product_desc = $request->product_desc;
        $product->product_price = $request->product_price;
        $product->product_discount = $request->product_discount;
        $product->product_detail = $request->product_detail;
        if ($request->hasFile('product_img')) {
            $this->delete_from_drive($product->img_name);
            $file = $request->product_img;
            $name = vn_to_str($request->product_name);
            $img_name = $name . '-' . date('mdYHis') . '.' . $file->getClientOriginalExtension();
            $product->product_img = $this->upload_to_drive($img_name, $file);
            $product->img_name =  $img_name;
        }
        $product->save();
        Session::flash('success', 'Đã cập nhập sản phẩm ' . $product->product_name);
        return Redirect::to('admin/product/all-product');
    }
    public function search_product(Request $request)
    {
        $product = Product::where('product_name', 'LIKE', '%' . $request->search . '%')->paginate(5);
        if (!$product->isEmpty()) {
            return view('admin.product.all-product', compact('product'));
        } else {
            return redirect()->back()->with('success', 'Không tìm thấy từ khoá ' . $request->search);
        }
    }
    public function comment($product_id)
    {
        $product = Product::find($product_id);
        return view('admin.product.comment', compact('product'));
    }
    public function delete_comment($comment_id)
    {
        $cmt = Comment::find($comment_id);
        $cmt->delete();
        return redirect()->back()->with('success', 'Đã xoá bình luận');
    }
    // end backend
    //
    public function arrange_product(Request $request)
    {
        $product_id = $request->page_id_array;

        foreach ($product_id as $key => $value) {
            $product = Product::find($value);
            $product->product_order = $key;
            $product->save();
        }
    }

    public function upload_to_drive($file_name, $file_data)
    {
        $contents = collect(Storage::cloud()->listContents('/', true));
        $dir = $contents->where('type', '=', 'dir')
            ->where('filename', '=', 'Product')
            ->first();
        $file_name = $dir['path'] . "/" . $file_name;
        Storage::cloud()->put($file_name, file_get_contents($file_data));
        $url = Storage::cloud()->url($file_name);
        return $url;
    }

    private function delete_from_drive($filename)
    {
        $contents = collect(Storage::cloud()->listContents("/", true));
        $file = $contents
            ->where('type', '=', 'file')
            ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
            ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
            ->first();
        if(isset($file)) {
            Storage::cloud()->delete($file['path']);
        }
    }
}
