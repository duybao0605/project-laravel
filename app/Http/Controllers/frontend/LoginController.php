<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Http\Requests\SignupRequest;
use App\Http\Requests\LoginRequest;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;



class LoginController extends Controller
{
	  //sign up 
    public function show()
    {	
    	return view('frontend.login.signup');
        
    }
    public function create(SignupRequest $request)
    {
    	  $data = $request->all();
        $user = new User();

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->phone = $data['phone'];
        $user->address = $data['address'];
        $user->country = $data['country'];
        $user->level = 0;

  	  	$file = $request->avatar;

        if(!empty($file)){
          $data['avatar'] = $file->getClientOriginalName();
          $user->avatar = $data['avatar'];
        }
        

        if($user->save()){
          if(!empty($file)){
            $file->move("upload/user/avatar",$file->getClientOriginalName());
          }
          return redirect()->back()->with('success',__('create account succes'));

        }else{
          return redirect()->back()->withErrors('create account error');
        }

    }

    // login
    public function show2()
    {	
    	return view('frontend.login.log');
    }
    public function login2(LoginRequest $request)
    { 
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect("/blog/list");
        }else{
          return redirect()->back()->withErrors('Login error, Email or Password is not correct');
        }
    }

    // logout
    public function logout2(Request $request) {
      Auth::logout();
      session()->flush();
      return redirect('/log');
    }

}
