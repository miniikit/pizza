<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
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
            'name' => 'required|max:50',
            'kana' => 'required|max:100',
            'birthday' => 'required|date',
            'gender_id' => 'required',
            'postal' => 'required|size:7|string',
            'address1' => 'required|max:255',
            'address2' => 'required|max:255',
            'address3' => 'max:255',
            'phone' => 'required|string|between:10,11',
            'email' => 'required|email',
            'emoloyee_agreement_enddate' => 'date',
        ];
    }
}
