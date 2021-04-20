<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'phone'=>['required','max:10'],
            'address'=>['required','max:255'],
            'country'=>['required','max:100'],
            'avatar'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(){
        return[
            'required'=>':attribute khong duoc de trong',
            'max'=>':attribute khong duoc qua :max ki tu',
            'min'=>':attribute kho duong nho hon :min ki tu',
            'unique'=>':attribute nay da co nguoi su dung',
        ];
    }
    public function attributes(){
        return [
            'email'=>'taikhoan',
            'name'=>'ten',
            'password'=>'matkhau',
        ];
    }
}
