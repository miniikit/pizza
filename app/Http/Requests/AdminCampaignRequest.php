<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCampaignRequest extends FormRequest
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
            'campaign_name' => 'required',
            'campaign_text' => 'required',
            'campaign_note' => 'required',
            'campaign_subject' => 'required|integer',
            'campaign_start_day' => 'required|date',
            'campaign_end_day' => 'required|date',
            'file1' => 'required|file|image:jpg,jpeg|mimes:jpg,jpeg',
            'file2' => 'required|file|image:jpg,jpeg|mimes:jpg,jpeg',
        ];
    }
}
