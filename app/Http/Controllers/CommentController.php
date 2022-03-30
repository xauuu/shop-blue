<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function show_comment()
    {
        $comment = Comment::where('reply_id', 0)->orderBy('comment_id', 'desc')->paginate(10);
        return view('admin.cmt.show-cmt', compact('comment'));
    }
    public function show_reply($comment_id)
    {
        $comment = Comment::where('reply_id', $comment_id)->orderBy('comment_id', 'asc')->get();
        return view('admin.cmt.show-reply', compact('comment', 'comment_id'));
    }
    public function add_reply(Request $request)
    {
        $cmt = Comment::find($request->cmt_id);
        $date = Date('d \t\h\á\n\g m\, Y');
        $comment = new Comment();
        $comment->product_id = $cmt->product_id;
        $comment->customer_id = 5;
        $comment->comment_content = $request->content;
        $comment->comment_time = $date;
        $comment->reply_id = $request->cmt_id;
        $comment->save();
        return redirect()->back()->with('success', 'Đã trả lời bình luận');
    }
}
