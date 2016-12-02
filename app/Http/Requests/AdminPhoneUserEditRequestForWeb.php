<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


/*
 *
 *  電話注文時、既に会員情報が登録されている場合に、それを編集する処理（Web）
 *
 * */

class AdminPhoneUserEditRequestForWeb extends FormRequest
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
            'name' => 'required|max:50',
            'name_katakana' => 'required|max:100',
            'postal' => 'required|size:7|string',
            'address1' => 'required|max:255',
            'address2' => 'required|max:255',
            'address3' => 'max:255',
            'phone' => 'required|string|between:10,11',
            'gender' => 'required',
            'email' => 'required|email',
        ];
    }
}
