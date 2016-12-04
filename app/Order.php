<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders_master';
    protected $fillable = ['order_date','order_appointment_date','coupon_id','state_id','user_id'];

    public function detail() {
        return $this->hasMany('App\OrderDetail','id');
    }

    public function user() {
        return $this->belongsTo('App\User','user_id');
    }

    public function coupon() {
        return $this->belongsTo('App\Coupon','coupon_id');
    }

    public function state() {
        return $this->belongsTo('App\State','state_id');
    }

}
