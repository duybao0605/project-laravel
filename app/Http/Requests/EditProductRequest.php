<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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
            //
            'name' => ['required', 'max:255'],
            'price' => ['required', 'max:100'],
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category'=>['required', 'max:100'],
            'brand'=>['required', 'max:100'],
            'status'=>['required', 'max:100'],
            'company'=>['required', 'max:100'],
            'detail'=>['required', 'max:500'],
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
            'image.*'=>'hinh anh',
        ];
    }
}
