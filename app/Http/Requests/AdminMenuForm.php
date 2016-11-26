<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminMenuForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|integer',
            'product_name' => 'required|max:50',
            'product_text' => 'required|max:100',
            'product_price' => 'required|integer',
            'product_img' => 'mimes:jpg,jpeg,png,bmp',
            'product_genre_id' => 'required',
            'product_sales_start_day' => 'date',
            'product_sales_end_day' => 'date'
        ];
    }
}
