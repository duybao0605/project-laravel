<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\UserInfoRequest;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    //
    public function show(){

    	return view('frontend.login.user_profile');
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
        

    }
}

