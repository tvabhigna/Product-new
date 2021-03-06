<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            'name'              => 'required',
	        // 'image'             => 'required|mimes:jpg,jpeg,png',
            'category_id'       => 'required',
            'status'            =>  'required',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'             => 'Name is required!',
            'category_id.required'      => 'Category is required!',
            'status.required'           => 'Status is required!',
            'image.required'            => 'Image is required!',
            
        ];
    }
}
