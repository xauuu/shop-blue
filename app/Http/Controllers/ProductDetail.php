<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Rating;

class ProductDetail extends Controller
{
    public function product_detail($product_slug)
    {
        $category = Category::where('category_status', 1)->get();
        $contact = Contact::first();
        $pro_slug = Product::where('product_slug', $product_slug)->first();
        $product_id = $pro_slug->product_id;

        $detail = Product::find($product_id);
        // luot xem
        $detail->product_view = $detail->product_view + 1;
        $detail->save();
        // end luot xem
        $related = Product::where('category_id', $detail->category_id)->get();
        $rating = Rating::where('product_id', $product_id)->avg('rating');
        $rating = round($rating);
        return view('pages.products.product-detail', compact('category', 'detail', 'related', 'rating', 'contact'));
    }
    public function add_comment(Request $request)
    {
        $all = $request->all();
        $customer_id = session('customer_id');
        $comment = new Comment();
        $date = Date('d \t\h\á\n\g m\, Y');
        $name = session('customer_name');
        $comment->product_id = $all['product_id'];
        $comment->customer_id = $customer_id;
        $comment->comment_content = $all['content'];
        $comment->comment_time = $date;
        $comment->reply_id = 0;
        $comment->save();

        if (session('customer_avatar') != '') {
            $content = '
            <div class="blog__comment__item">
                <div class="blog__comment__item__pic">
                    <img width="85" src="' . session('customer_avatar') . '" alt="">
                </div>
                <div class="blog__comment__item__text">
                    <h6>' . session('customer_name') . '</h6>
                    <p>' . $all['content'] . '</p>
                    <ul>
                        <li><i class="fa fa-clock-o"></i> ' . $date . '</li>
                        <li><i class="fa fa-share"></i> Trả lời</li>
                    </ul>
                </div>
            </div>';
        } else {
            $content = '
            <div class="blog__comment__item">
                <div class="blog__comment__item__pic">
                    <div class="cmt-avt">' . $name[0] . '</div>
                </div>
                <div class="blog__comment__item__text">
                    <h6>' . session('customer_name') . '</h6>
                    <p>' . $all['content'] . '</p>
                    <ul>
                        <li><i class="fa fa-clock-o"></i> ' . $date . '</li>
                        <li><i class="fa fa-share"></i> Trả lời</li>
                    </ul>
                </div>
            </div>';
        }

        echo $content;
    }
    public function reply_comment(Request $request)
    {
        $all = $request->all();
        $customer_id = session('customer_id');
        $comment = new Comment();
        $date = Date('d \t\h\á\n\g m\, Y');
        $name = session('customer_name');

        $comment->product_id = $all['product_id'];
        $comment->customer_id = $customer_id;
        $comment->comment_content = $all['content'];
        $comment->comment_time = $date;
        $comment->reply_id = $all['cmt_id'];
        $comment->save();
        if (session('customer_avatar') != '') {
            $content = '
            <div class="blog__comment__item  mt-4">
                <div class="blog__comment__item__pic">
                    <img width="75" src="' . session('customer_avatar') . '" alt="">
                </div>
                <div class="blog__comment__item__text">
                    <h6>' . session('customer_name') . '</h6>
                    <p>' . $all['content'] . '</p>
                    <ul>
                        <li><i class="fa fa-clock-o"></i> ' . $date . '</li>
                    </ul>
                </div>
            </div>';
        } else {
            $content = '
            <div class="blog__comment__item  mt-4">
                <div class="blog__comment__item__pic">
                    <div class="reply-avt">' . $name[0] . '</div>
                </div>
                <div class="blog__comment__item__text">
                    <h6>' . session('customer_name') . '</h6>
                    <p>' . $all['content'] . '</p>
                    <ul>
                        <li><i class="fa fa-clock-o"></i> ' . $date . '</li>
                    </ul>
                </div>
            </div>';
        }

        echo $content;
    }
    public function add_rating(Request $request)
    {
        if (session('customer_id')) {
            $customer_id = session('customer_id');
            $all = $request->all();
            $check = Rating::where('product_id', $all['product_id'])->where('customer_id', $customer_id)->first();
            if ($check) {
                $rating = Rating::find($check->rating_id);
                $rating->rating = $all['index'];
                $rating->save();
            } else {
                $rating = new Rating();
                $rating->product_id = $all['product_id'];
                $rating->customer_id = $customer_id;
                $rating->rating = $all['index'];
                $rating->save();
            }
        } else {
            echo 'Bạn cần đăng nhập để đánh giá sản phẩm này';
        }
    }
}
