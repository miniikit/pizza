<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MypageForm extends FormRequest
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
            'name' => 'required|unique:posts|max:255',
            'name_katakana' => 'required|unique:posts|',
            'postal' => 'required|unique:posts|size:7|integer',
            'address1' => 'required|unique:posts|',
            'address2' => 'required|unique:posts|',
            'address3' => 'unique:posts|',
            'birthday' => 'required|unique:posts|',
            'phone' => 'required|unique:posts|integer',
            'gender' => 'required|unique:posts|',
            'email' => 'required|unique:posts|email',
            'new_password' => 'required|unique:posts|new_password_confirm|min:6',
            'new_password_confirm' => 'required|unique:posts|new_password',
            'confirm_password' => 'required|unique:posts|'
        ];
    }
}
