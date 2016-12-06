<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCouponNewDiscountRequest extends FormRequest
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
            'coupon_discount_price' => 'required|min:1',
            'coupon_start_date' => 'required|date',
            'coupon_end_date' => 'required|date',
            'coupon_target' => 'required',
            'coupon_max' => 'required|numeric',
            'coupon_conditions_price' => 'required|numeric',
            'coupon_product_id' => 'required|numeric',
        ];
    }
}
