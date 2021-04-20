<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddBlogRequest extends FormRequest
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
            'title'=>'required|max:150',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description'=>'required|max:200',
            'content'=>'required|max:100000',

        ];
    }

    public function messages(){
        return[
            'required'=>':attribute khong duoc de trong',
            'max'=>':attribute khong duoc qua :max ki tu',
        ];
    }
    public function attributes(){
        return [
            'title'=>'tieu de',
            'image'=>'hinh anh',
            'description'=>'mo ta',
            'content'=>'noi dung',
        ];
    }
}
