<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminAnalysisPopularRequest extends FormRequest
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
            'genre' => 'required',
            'gender' => 'required',
            'member_type' => 'required',
            'period' => 'required',
            'start_date' => 'required_if:period,check|date',
            'end_date' => 'required_if:period,check|date|after:start_date',
            'older' => 'required',
        ];
    }
}
