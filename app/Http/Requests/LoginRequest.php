<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public function messages(){
        return[
            'required'=>':attribute khong duoc de trong',
            'max'=>':attribute khong duoc qua :max ki tu',
            'min'=>':attribute kho duong nho hon :min ki tu',
        ];
    }
    public function attributes(){
        return [
            'email'=>'taikhoan',
            'password'=>'matkhau',
        ];
    }
}
