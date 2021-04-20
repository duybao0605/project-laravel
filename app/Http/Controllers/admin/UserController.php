<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserInfoRequest;

use App\User;
use App\Countries;

use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //

    public function show(){

    	$getCountry = Countries::All()->toArray();
    	return view('admin.user.profile',compact('getCountry'));

    }
    public function edit(UserInfoRequest $request)
    {

        $userId = Auth::id();
        
        $user = User::findOrFail($userId);

        $data = $request->all();
        
        $file = $request->avatar;

        if(!empty($file)){
        	$data['avatar'] = $file->getClientOriginalName();
        }
        if($data['password']){
        	$data['password'] = bcrypt($data['password']);
       	}else{
       		$data['password']= $user->password;
       	}


       	if($user->update($data)){
       		if(!empty($file)){
       			$file->move("upload/user/avatar",$file->getClientOriginalName());
       		}
       		return redirect()->back()->with('success',__('Update profile succes'));

       	}else{
       		return redirect()->back()->withErrors('Update file error');
       	}
        

        return view('admin.user.profile');
    }
}
