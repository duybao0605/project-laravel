<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;



class CommentController extends Controller
{
    //

    public function postComment(CommentRequest $request, $id){
    	$idBlog = $id;
    	$comment = new Comment;
    	$comment->idBlog = $idBlog;
    	$comment->level = $request->level;
    	$comment->idUser = Auth::user()->id;
    	$comment->avatar = Auth::user()->avatar;
    	$comment->name = Auth::user()->name;
    	$comment->content = $request->content;


    	if($comment->save()){
    		return redirect()->back()->with('success',__('Comment success'));

       	}else{
       		return redirect()->back()->withErrors('Comment error');
       	}


    }
}
