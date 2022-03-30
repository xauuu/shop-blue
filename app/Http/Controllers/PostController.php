<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\CategoryPost;
use App\Models\Contact;
use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    // category post
    public function add_category_post()
    {
        return view('admin.post.add-category-post');
    }
    public function all_category_post()
    {
        $cate_post = CategoryPost::all();
        return view('admin.post.all-category-post', compact('cate_post'));
    }
    public function save_category_post(Request $request)
    {
        $cate_post = new CategoryPost();
        $cate_post->category_post_name = $request->category_post_name;
        $cate_post->category_post_slug = vn_to_str($request->category_post_name);
        $cate_post->category_post_desc = $request->category_post_desc;
        $cate_post->category_post_status = $request->category_post_status;
        $cate_post->save();
        Session::flash('success', 'Bạn đã thêm danh mục bài viết ' . $request->category_post_name);
        return Redirect::to('/admin/post/all-category-post');
    }
    public function edit_category_post($category_post_id)
    {
        $cate_post = CategoryPost::find($category_post_id);
        return view('admin.post.edit-category-post', compact('cate_post'));
    }
    public function update_category_post(Request $request)
    {
        $cate_post = CategoryPost::find($request->category_post_id);
        $cate_post->category_post_name = $request->category_post_name;
        $cate_post->category_post_slug = vn_to_str($request->category_post_name);
        $cate_post->category_post_desc = $request->category_post_desc;
        $cate_post->save();
        Session::flash('success', 'Bạn đã cập nhât danh mục bài viết ' . $request->category_post_name);
        return Redirect::to('/admin/post/all-category-post');
    }
    public function delete_category_post($category_post_id)
    {
        $cate_post = CategoryPost::find($category_post_id);
        $cate_post->delete();
        Session::flash('success', 'Bạn đã xoá danh mục bài viết ' . $cate_post->category_post_name);
        return Redirect::to('/admin/post/all-category-post');
    }
    public function status_category_post($category_post_id)
    {
        $cate_post = CategoryPost::find($category_post_id);
        if ($cate_post->category_post_status == 0) {
            $cate_post->category_post_status = 1;
            $cate_post->save();
            Session::flash('success', 'Bạn đã hiển thị danh mục bài viết ' . $cate_post->category_post_name);
        } else {
            $cate_post->category_post_status = 0;
            $cate_post->save();
            Session::flash('success', 'Bạn đã ẩn danh mục bài viết ' . $cate_post->category_post_name);
        }
        return Redirect::to('/admin/post/all-category-post');
    }

    // post
    public function add_post()
    {
        $cate_post = CategoryPost::all();
        return view('admin.post.add-post', compact('cate_post'));
    }
    public function all_post()
    {
        $post = Post::all();
        return view('admin.post.all-post', compact('post'));
    }
    public function save_post(Request $request)
    {
        $all = $request->all();
        $post = new Post();
        $post->category_post_id = $all['category_post_id'];
        $post->post_title = $all['post_title'];
        $post->post_slug = $all['post_slug'];
        $post->post_desc = $all['post_desc'];
        $post->post_detail = $all['post_detail'];
        $post->post_meta_keywords = $all['post_meta_keywords'];
        $post->post_meta_desc = $all['post_meta_desc'];
        $post->post_status = $all['post_status'];

        if ($request->hasFile('post_img')) {
            $img = $request->post_img;
            $img_name = vn_to_str($all['post_title']) . '-' . date('dmYHis') . '.' . $img->getClientOriginalExtension();
            $post->post_img = $img_name;
            $img->move('uploads/post-img', $img_name);
        }
        $post->save();
        Session::flash('success', 'Bạn đã thêm bài viết ' . $all['post_title']);
        return Redirect::to('/admin/post/all-post');
    }
    public function edit_post($post_id)
    {
        $cate_post = CategoryPost::all();
        $post = Post::find($post_id);
        return view('admin.post.edit-post', compact('cate_post', 'post'));
    }
    public function update_post(Request $request)
    {
        $all = $request->all();
        $post = Post::find($all['post_id']);
        $postimg = $post->post_img;
        $post->category_post_id = $all['category_post_id'];
        $post->post_title = $all['post_title'];
        $post->post_slug = $all['post_slug'];
        $post->post_desc = $all['post_desc'];
        $post->post_detail = $all['post_detail'];
        $post->post_meta_keywords = $all['post_meta_keywords'];
        $post->post_meta_desc = $all['post_meta_desc'];
        if ($request->hasFile('post_img')) {
            $img = $request->post_img;
            $img_name = vn_to_str($all['post_title']) . '-' . date('dmYHis') . '.' . $img->getClientOriginalExtension();
            $img->move('uploads/post-img', $img_name);
            $post->post_img = $img_name;

            $image_path = public_path("uploads/post-img/" . $postimg);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        $post->save();
        Session::flash('success', 'Bạn đã cập nhât bài viết ' . $all['post_title']);
        return Redirect::to('/admin/post/all-post');
    }
    public function delete_post($post_id)
    {
        $post = Post::find($post_id);
        $post->delete();
        Session::flash('success', 'Bạn đã xoá bài viết ' . $post->post_title);
        return Redirect::to('/admin/post/all-post');
    }
    public function status_post($post_id)
    {
        $post = Post::find($post_id);
        if ($post->post_status == 0) {
            $post->post_status = 1;
            $post->save();
            Session::flash('success', 'Bạn đã hiển thị bài viết ' . $post->post_title);
        } else {
            $post->post_status = 0;
            $post->save();
            Session::flash('success', 'Bạn đã ẩn bài viết ' . $post->post_title);
        }
        return Redirect::to('/admin/post/all-post');
    }
    // end be

    //
    public function blog()
    {
        $contact = Contact::first();
        $category = Category::all();
        $post = Post::orderBy('post_id', 'desc')->get();
        return view('pages.blog.blog', compact('category', 'post', 'contact'));
    }
    public function blog_detail($post_slug)
    {
        $contact = Contact::first();
        $category = Category::all();
        $post_detail = Post::where('post_slug', $post_slug)->first();
        // luot xem
        $post_detail->post_view = $post_detail->post_view + 1;
        $post_detail->save();
        // end luot xem
        $category_post = CategoryPost::all();
        $recent_post = Post::whereNotIn('post_slug', [$post_slug])->latest()->limit(5)->get();
        return view('pages.blog.blog-detail', compact('category', 'post_detail','category_post','recent_post', 'contact'));
    }
    public function add_post_comment(Request $request)
    {
        $post_comment = new PostComment();
        $post_comment->customer_id = session('customer_id');
        $post_comment->post_id = $request->post_id;
        $post_comment->post_comment_content = $request->content;
        $post_comment->post_comment_time = date('d \t\h\á\n\g m, Y');
        $post_comment->save();
        if (session('customer_avatar') != '') {
            $content = '
            <div class="blog__comment__item">
                <div class="blog__comment__item__pic">
                    <img width="85" src="' . session('customer_avatar') . '" alt="">
                </div>
                <div class="blog__comment__item__text">
                    <h6>' . session('customer_name') . '</h6>
                    <p>' . $request->content . '</p>
                    <ul>
                        <li><i class="fa fa-clock-o"></i> ' . date('d \t\h\á\n\g m, Y') . '</li>
                    </ul>
                </div>
            </div>';
        } else {
            $content = '
            <div class="blog__comment__item">
                <div class="blog__comment__item__pic">
                    <div class="cmt-avt">' . session('customer_name')[0] . '</div>
                </div>
                <div class="blog__comment__item__text">
                    <h6>' . session('customer_name') . '</h6>
                    <p>' . $request->content . '</p>
                    <ul>
                        <li><i class="fa fa-clock-o"></i> ' . date('d \t\h\á\n\g m, Y') . '</li>
                    </ul>
                </div>
            </div>';
        }

        echo $content;

    }
}
