<?php

namespace App\Http\Requests\Admin\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required|min:3|max:100',
            'brand' => 'required|min:2|max:50',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'quntity' => 'required|numeric',
            'discount' => 'required|numeric',
            'limited' => 'required|numeric',
            'image_path' => 'image|mimes:png,jpg,jpeg,webp',
            'description' => 'required|min:10',
        ];
    }
}
