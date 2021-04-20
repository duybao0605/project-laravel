<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AddBrandRequest;

use App\Brand;


class BrandController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware('auth');
    }

	public function index(){
		// $data_country = DB::table('country')->get()->toArray();
        return view('admin.brand.index',compact('data'));
    }

	public function add(){
		return view('admin.brand.add');
	}

	public function insert(AddBrandRequest $request)
    {
        $data = $request->all();
        $brand = new Brand();
        $brand->name = $data['brand'];
          
        $brand->save();
        

        return view('admin.brand.index');
    }
    
    public function delete(){
    	$id = $_GET['id'];
        Brand::where('id',$id)->delete();
        
        return view('admin.brand.index');
    }
}
