<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{

    protected $table = 'states_master';
    protected $fillable = ['state_name'];
}
