<?php

namespace App\Http\Controllers\Backend\Comments;

use App\Http\Controllers\Controller;
use App\Models\Comments\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
    	$comments = Comment::all();
    	return view('backend.comments.index')->with('comments',$comments);
    }

    public function show($id)
    {
    	$comment = Comment::find($id);
    	return view('backend.comments.show')->with('comment',$comment);
    }
}
