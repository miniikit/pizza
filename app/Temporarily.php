<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temporarily extends Model
{
    protected $table = 'temporaries_users_master';
    protected $fillable = ['name','kana','postal','address1','address2','address3','phone'];
}
