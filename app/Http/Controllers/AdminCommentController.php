<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    //
    public function index(){
        $comments = Comment::orderBy('created_at','desc')->get();
        return view('admin.comments',compact('comments'));
    }
    public function destroy($id){
        $comment = Comment::find($id);
        $comment->delete();
        return redirect('/admin/comments');
    }
}
