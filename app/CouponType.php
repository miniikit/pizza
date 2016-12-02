<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CouponType extends Model
{
    protected $table = 'coupons_types_master';
    protected $fillable = ['id','coupon_type'];

}
