<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'orders_details_table';

    protected $primaryKey = ['id', 'product_id'];

    public $incrementing = false;

    protected $fillable = ['id','product_id','number'];

}
