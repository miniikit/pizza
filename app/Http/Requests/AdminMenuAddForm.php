<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminMenuAddForm extends FormRequest
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
            'product_name' => 'required|max:255',
            'product_text' => 'required',
            'product_price' => 'required|integer',
            'product_img' => 'required|max:1500|mimes:jpg,jpeg,png,bmp',
            'product_genre_id' => 'required',
            'product_sales_start_day' => 'required|date',
            'product_sales_end_day' => 'date',
        ];
    }
}
