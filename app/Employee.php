<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees_master';
    protected $fillable = ['users_id','emoloyee_agreement_date','emoloyee_agreement_enddate'];

    public function user() {
        return $this->belongsTo('App\User','users_id');
    }

}
