<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genres_master';
    protected $fillable = ['genre_name'];

}
