<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function maanComment()
    {
        $comments = Comment::latest()->paginate(10);
        return view('admin.pages.comment.comment',compact('comments'));
    }

    public function maanNewComment(Request $request)
    {
        $request->validate([
            'message'  => 'required|string|max:255',
            'name'     => 'required',
            'email'    => 'required|email',
        ]);
        Comment::addComment($request);
        return redirect()->back()->with('message', 'Comment posted successfully.');
    }
    public function maanDeleteComment($id)
    {
        $this->comment = Comment::find($id);
        $this->comment->delete();
        return redirect()->back()->with('error', 'Data Deleted');
    }
    public function maanCommentStatus($id)
    {
        $this->statusComment = Comment::findOrFail($id);
        $this->statusComment->status = $this->statusComment->status == 1 ? 0 : 1;
        $this->statusComment->save();
        return redirect()->back()->with('message', 'Status changed successfully');
    }
}
