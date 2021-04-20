<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Blog;
use App\Comment;
use App\Rate;
use Illuminate\Support\Facades\Auth;



class BlogController extends Controller
{
    //
    public function list(){
    	$blogs = Blog::paginate(3);
    	return view('frontend.blog.list',['blogs' => $blogs]);

    }
    public function showDetail($id){

    	$comment = Comment::where('idBlog',$id)->get();
    	$count = Comment::where('idBlog',$id)->get()->count();

    	$allComment = Comment::where('idBlog',$id)->get();
    	foreach ($allComment as $value) {
    		# code...
    		if ($value->level > 0) {
    			$reply = $value;
    		}

    		
    	}
        //rate
        $totalRate = Rate::where('idBlog', $id)->get();
        $countRate = Rate::where('idBlog', $id)->count();

        $blogs = Blog::paginate(1);
    	return view('frontend.blog.detail',compact('data','comment','count','reply','totalRate','countRate'),['blogs' => $blogs]);
    }
}
