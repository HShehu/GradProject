<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Comment;
use App\User;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->body = $request->get('comment_body');
        $comment->user()->associate($request->user());
        $blog = Blog::find($request->blog_id);
        $blog->comments()->save($comment);

        return back()->with(
            'success',
            'Comment successfully added.'
        );
        ;
    }


    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $user = User::where('id', $comment->user_id);
        $comment->delete();
        return redirect()->back()->with(
            'success',
            ' Comment successfully deleted.'
        );
    }

    public function admin()
    {
        $blogs = Blog::all(); //Get all permissions
        $comments = Comment::all();

        return view('comments.admin-view')->with(['comments'=> $comments,'blogs'=>$blogs]);
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
