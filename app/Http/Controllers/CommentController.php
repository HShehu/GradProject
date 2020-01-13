<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Comment;

class CommentController extends Controller
{
     public function store(Request $request)
    {
        $comment = new Comment;
        $comment->body = $request->get('comment_body');
        $comment->user()->associate($request->user());
        $blog = Blog::find($request->blog_id);
        $blog->comments()->save($comment);

        return back();
    }

    //  public function replyStore(Request $request)
    // {
    //     $reply = new Comment();
    //     $reply->body = $request->get('comment_body');
    //     $reply->user()->associate($request->user());
    //     $reply->parent_id = $request->get('comment_id');
    //     $blog = Blog::find($request->get('blog_id'));

    //     $blog->comments()->save($reply);

    //     return back();

    // }
}
