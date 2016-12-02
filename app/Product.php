<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products_master';
    protected $fillable = ['product_name','price_id','product_image','product_text','genre_id','sales_start_date','sales_end_date'];
    protected $dates = ['deleted_at'];

    public function productPrice() {
        return $this->belongsTo('App\ProductPrice','price_id');
    }

    public function genre() {
        return $this->belongsTo('App\Genre','genre_id');
    }

}
