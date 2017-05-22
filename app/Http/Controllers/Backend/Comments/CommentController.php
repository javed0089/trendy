<?php

namespace App\Http\Controllers\Backend\Comments;

use App\Http\Controllers\Controller;
use App\Models\Comments\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
    	$comments = Comment::paginate(15);
    	return view('backend.comments.index')->with('comments',$comments);
    }

    public function show($id)
    {
    	$comment = Comment::find($id);
    	return view('backend.comments.show')->with('comment',$comment);
    }

    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return back()->with('success','Comment deleted succesfully!');
    }
}
