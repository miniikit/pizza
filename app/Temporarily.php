<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temporarily extends Model
{
    protected $table = 'temporaries_members_master';
    protected $fillable = ['temporary_member_name','temporary_member_kana','temporary_member_postel','temporary_member_address1','temporary_member_address2','temporary_member_address3','temporary_member_tel'];
}
