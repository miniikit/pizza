<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temporarily extends Model
{
    protected $table = 'temporaries_users_master';
    protected $fillable = ['temporary_user_name','temporary_user_kana','temporary_user_postal','temporary_user_address1','temporary_user_address2','temporary_user_address3','temporary_user_tel'];
}
