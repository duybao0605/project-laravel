<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AddCategoryRequest;

use App\Category;


class CategoryController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware('auth');
    }

	public function index(){
		// $data_country = DB::table('country')->get()->toArray();
        
        return view('admin.category.index',compact('data'));
    }

	public function add(){
		return view('admin.category.add');
	}

	public function insert(AddCategoryRequest $request)
    {
        $data = $request->all();
        $category = new Category();
        $category->name = $data['category'];
          
        $category->save();
        

        return view('admin.category.index');
    }
    
    public function delete(){
    	$id = $_GET['id'];
        Category::where('id',$id)->delete();
        
        return view('admin.category.index');
    }
}
