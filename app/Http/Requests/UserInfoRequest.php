<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserInfoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
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
            'name'=>'required|max:191',
            'password'=>'max:191',
            'phone'=>'required|max:11',
            'address'=>'required|max:191',
            'country'=>'required|max:191',
            'avatar'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages(){
        return[
            'required'=>':attribute khong duoc de trong',
            'max'=>':attribute khong duoc qua :max ki tu',
            'unique'=>':attribute da co nguoi su dung',
        ];
    }
    public function attributes(){
        return [
            'name'=>'ten',
            'email'=>'email',
            'password'=>'mat khau',
            'phone'=>'so dien thoai',
            'address'=>'dia chi',
            'country'=>'quoc gia',
            'avatar'=>'anh dai dien',
        ];
    }
}
