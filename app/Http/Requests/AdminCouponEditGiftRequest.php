<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCouponEditGiftRequest extends FormRequest
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
            'coupon_name' => 'required',
            'coupon_num' => 'required|regex:/^[a-zA-Z0-9-]+$/', //半角英数とハイフン
            'coupon_end_date' => 'required|date',
            'coupon_conditions_first' => 'required',
            'coupon_max' => 'numeric',
            'coupon_conditions_price' => 'required|numeric',
        ];
    }
}
