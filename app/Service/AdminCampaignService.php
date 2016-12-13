<?php

namespace App\Service;


class AdminCampaignService
{
    public function insert($request){
        $campaign_name = $request->campaign_name;
        $campaign_text = $request->campaign_text;
        $campaign_note = $request->campaign_note;
        $campaign_subject = $request->campaign_subject;
            dd($request->all());
        return 'a';
    }
}