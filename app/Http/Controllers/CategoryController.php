<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Category;

class CategoryController extends Controller
{
    public function add_category()
    {
        AuthLogin();
        $category = Category::where('category_parent', 0)->get();
        return view('admin.category.add-category', compact('category'));
    }
    public function all_category()
    {
        AuthLogin();
        $category = Category::all();
        $categorypa = Category::paginate(10);
        return view('admin.category.all-category', compact('category', 'categorypa'));
    }
    public function save_category(Request $request)
    {
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->category_slug = $request->category_slug. '-' . date('His');
        $category->category_desc = $request->category_desc;
        $category->category_status = $request->category_status;
        $category->category_parent = $request->category_parent;
        $category->save();
        Session::flash('success', 'Bạn đã thêm danh mục');
        return Redirect::to('/admin/category/all-category');
    }
    public function edit_category($category_id)
    {
        AuthLogin();
        $cate = Category::where('category_id', $category_id)->first();
        $category = Category::where('category_parent', 0)->get();
        return view('admin.category.edit-category', compact('cate', 'category'));
    }
    public function update_category(Request $request)
    {
        $category_id = $request->category_id;

        $category = Category::find($category_id);
        $category->category_name = $request->category_name;
        $category->category_slug = $request->category_slug;
        $category->category_desc = $request->category_desc;
        $category->category_parent = $request->category_parent;
        $category->save();
        Session::flash('success', 'Bạn đã cập nhật danh mục ' . $request->category_name);
        return Redirect::to('/admin/category/all-category');
    }
    public function delete_category($category_id)
    {
        $category = Category::find($category_id);
        $category->delete();
        Session::flash('success', 'Bạn đã xoá danh mục ');
        return Redirect::to('/admin/category/all-category');
    }
    public function active_category($category_id)
    {
        $category = Category::find($category_id);
        $category->category_status = 1;
        $category->save();
        Session::flash('success', 'Hiển thị danh mục ' . $category->category_name);
        return Redirect::to('/admin/category/all-category');
    }
    public function unactive_category($category_id)
    {
        $category = Category::find($category_id);
        $category->category_status = 0;
        $category->save();
        Session::flash('success', 'Ẩn danh mục ' . $category->category_name);
        return Redirect::to('/admin/category/all-category');
    }
}
