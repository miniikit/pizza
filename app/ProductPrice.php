<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    protected $table = 'products_prices_master';
    protected $fillable = ['product_id','product_price','price_change_startdate','price_change_enddate','employee_id'];

    public function product() {
        return $this->belongsTo('App\Product','product_id');
    }
}
