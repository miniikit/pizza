<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $table = 'employees_master';
    protected $fillable = ['users_id','emoloyee_agreement_date','emoloyee_agreement_enddate'];
    protected $dates = ['deleted_at'];

    public function user() {
        return $this->belongsTo('App\User','users_id');
    }



}
