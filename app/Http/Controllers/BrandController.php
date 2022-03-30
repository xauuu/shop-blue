<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Brand;

class BrandController extends Controller
{
    public function add_brand()
    {
        AuthLogin();
        return view('admin.brand.add-brand');
    }
    public function all_brand()
    {
        AuthLogin();
        $brand = Brand::all();
        return view('admin.brand.all-brand', compact('brand'));
    }
    public function save_brand(Request $request)
    {
        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->brand_slug = $request->brand_slug. '-' . date('His');
        $brand->brand_desc = $request->brand_desc;
        $brand->brand_status = $request->brand_status;
        $brand->save();
        Session::flash('success', 'Bạn đã thêm thương hiệu ' . $request->brand_name);
        return Redirect::to('/admin/brand/all-brand');
    }
    public function active_brand($brand_id)
    {
        $brand = Brand::find($brand_id);
        $brand->brand_status = 1;
        $brand->save();
        Session::flash('success', 'Hiển thị thương hiệu ' . $brand->brand_name);
        return Redirect::to('/admin/brand/all-brand');
    }
    public function unactive_brand($brand_id)
    {
        $brand = Brand::find($brand_id);
        $brand->brand_status = 0;
        $brand->save();
        Session::flash('success', 'Ẩn thương hiệu ' . $brand->brand_name);
        return Redirect::to('/admin/brand/all-brand');
    }
    public function delete_brand($brand_id)
    {
        $brand = Brand::find($brand_id);
        $brand->delete();
        Session::flash('success', 'Bạn đã xoá thương hiệu ');
        return Redirect::to('/admin/brand/all-brand');
    }
    public function edit_brand($brand_id)
    {
        AuthLogin();
        $brand = Brand::find($brand_id);
        return view('admin.brand.edit-brand', compact('brand'));
    }
    public function update_brand(Request $request)
    {
        $brand_id = $request->brand_id;
        $brand = Brand::find($brand_id);
        $brand->brand_name = $request->brand_name;
        $brand->brand_slug = $request->brand_slug;
        $brand->brand_desc = $request->brand_desc;
        $brand->save();
        Session::flash('success', 'Bạn đã cập nhật thương hiệu ' . $brand->brand_name);
        return Redirect::to('/admin/brand/all-brand');
    }

}
