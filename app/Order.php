<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders_master';
    protected $fillable = ['order_date','order_appointment_date','coupon_id','state_id'];

}
