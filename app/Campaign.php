<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'campaigns_master';
    protected $fillable = ['campaign_title','campaign_image','campaign_text','campaign_note','campaign_subject','campaign_start_day','campaign_end_day'];
}
