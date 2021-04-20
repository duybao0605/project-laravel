<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rate;
use Illuminate\Support\Facades\Auth;



class RateController extends Controller
{
    //

    public function rate(Request $request){

		

    	$rateUser = Rate::where('idUser', '=', Auth::user()->id)
            			->where('idBlog', '=', $_POST['id'])
            			->get()->toArray();

        

        if($rateUser){
        	echo 'ban da danh gia cho bai viet nay roi';

        	
        }else{
        	$rate = new Rate;
	    	$rate->idBlog = $_POST['id'];
	    	$rate->idUser = Auth::user()->id;
	    	$rate->rate = $_POST['rate'];
	    	if($rate->save()){
	    		echo 'ban da danh gia ok';


	    	}
        }        
        



		

    }
}
