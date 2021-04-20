<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AddCountryRequest;

use App\Countries;


class CountryController extends Controller
{
    //
    
     public function __construct()
    {
        $this->middleware('auth');
    }

	public function index(){
		// $data_country = DB::table('country')->get()->toArray();
        
        return view('admin.country.index');
    }

	public function add(){
		return view('admin.country.add');
	}

	public function insert(AddCountryRequest $request)
    {
        $data = $request->all();
        $countries = new Countries();
        $countries->name = $data['country'];
          
        $countries->save();
        

        return view('admin.country.index');
    }
    
    public function delete(){
    	$id = $_GET['id'];
        Countries::where('id',$id)->delete();
        
        return view('admin.country.index');
    }
}
