<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;

class GalleryController extends Controller
{
    public function gallery($product_id)
    {
        AuthLogin();
        $product = Product::find($product_id);
        return view('admin.product.add-gallery', compact('product'));
    }
    public function add_gallery(Request $request)
    {
        $image = $request->file('image');
        $product_id = $request->product_id;
        if ($image) {
            foreach ($image as $item) {
                $gallery = new Gallery();
                $name = current(explode('.', $item->getClientOriginalName()));
                $img_name = $name . '-' . date('mdYHis') . '.' . $item->getClientOriginalExtension();
                $item->move('uploads/product/gallery', $img_name);
                $gallery->gallery_img = $img_name;
                $gallery->product_id = $product_id;
                $gallery->save();
            }
        }
        return Redirect::to('admin/product/gallery/' . $product_id);
    }
    public function delete_ga($gallery_id)
    {
        $gallery = Gallery::find($gallery_id);
        $image_path = public_path("uploads/product/gallery/" . $gallery->gallery_img);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $gallery->delete();
        return Redirect::to('admin/product/gallery/' . $gallery->product_id);
    }
}
