<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductPrice;

class OrderDetail extends Model
{
    protected $table = 'orders_details_table';

    protected $primaryKey = ['id', 'price_id'];

    public $incrementing = false;

    protected $fillable = ['id','price_id','number'];

    public function productPrice() {
        return $this->belongsTo('App\ProductPrice','price_id');
    }

}
