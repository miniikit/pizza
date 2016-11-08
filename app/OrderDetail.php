<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'orders_details_master';
    protected $fillable = ['product_id','number'];

}
