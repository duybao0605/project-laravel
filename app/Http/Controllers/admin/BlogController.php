<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EditBlogRequest;

use App\Blog;

class BlogController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
      $data = DB::table('blog')->get();
    	return view("admin.blog.list",compact('data'));

      
    ]);


    }
    public function add(){
    	return view("admin.blog.add");
    }
	  public function insert(AddBlogRequest $request){
    	$data = $request->all();

    	$blog = new Blog();
        $blog->title = $data['title'];

        $file = $request->image;
        if(!empty($file)){
        	$blog['image'] = $file->getClientOriginalName();
        }

        $blog->description = $data['description'];
        $blog->content = $data['content'];
        //dd($data);
        if($blog->save()){
       		if(!empty($file)){
       			$file->move("upload/user/blog-img",$file->getClientOriginalName());
       			return redirect("/admin/blog/list")->with('success',__('Add Blog succes'));
       		}
       	}else{
       		return redirect()->back()->withErrors('Add Blog file error');
       	}

    }


    public function edit(Request $request, $id){

      $data = Blog::find($id);
      return view("admin.blog.edit",compact('data'));
    }

    public function update(EditBlogRequest $request, $id){
      $data = $request->all();

      $blog = Blog::findOrFail($id);

      $file = $request->image;

      if(!empty($file)){
        $data['image'] = $file->getClientOriginalName();
        $data['image'] = $data['image'];
      }else{
        $data['image']= $blog->image;
      }

      // if($data['image']){
        
      // }

      if($blog->update($data)){
          if(!empty($file)){
            $file->move("upload/user/blog-img",$file->getClientOriginalName());
          }
          return redirect()->back()->with('success',__('Edit profile succes'));
          
      }else{
        return redirect()->back()->withErrors('Delete file error');
      }

    }

    public function delete($id){
        if (Blog::where('id',$id)->delete()) {
          # code...
          return redirect()->back()->with('success',__('Delete profile succes'));
        }else{
          return redirect()->back()->withErrors('Delete file error');
        }
        
        
    }
}
