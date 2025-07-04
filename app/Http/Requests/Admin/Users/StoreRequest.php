<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'first_name'=>'required|string|min:3|max:255', 
            'last_name'=>'required|string|min:3|max:255',
            'email'=>'required|email|min:3|max:255|unique:users,email',
            'city'=>'required|string|min:2|max:255', 
            'phone'=>'required|digits:11|unique:users,phone',
            'address'=>'required|string|min:3|max:255', 
            'role'=>'required|in:admin,user',
        ];
    }
}
