<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCampaignEditRequest extends FormRequest
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
            'campaign_end_day' => 'required|date',
            'file1' => 'file|image:jpg,jpeg|mimes:jpg,jpeg', //変更がない場合は送られてこない
            'file2' => 'file|image:jpg,jpeg|mimes:jpg,jpeg', //変更がない場合は送られてこない
        ];
    }
}
