<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupontype extends Model
{
    protected $table = 'coupons_types_master';
    protected $fillable = ['coupon_type'];

}
