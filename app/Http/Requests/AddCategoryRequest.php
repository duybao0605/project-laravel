<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCategoryRequest extends FormRequest
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
            
            'category'=>'required|max:100',
        ];
    }

    public function messages(){
        return[
            'category'=>':attribute khong duoc de trong',
            'max'=>':attribute khong duoc qua :max ki tu',
        ];
    }
    
}
