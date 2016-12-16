<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Notifications\CustomPasswordReset;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'kana', 'email', 'password', 'postal', 'address1', 'address2', 'address3', 'phone', 'gender_id', 'birthday', 'authority_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function gender() {
        return $this->belongsTo('App\Gender','gender_id');
    }


    public function sendPasswordResetNotification($token) {
        $this->notify(new CustomPasswordReset($token));
    }
  
    public function scopeSearchUser($query, $key)
    {
        if (!empty($key)) {
            $query = $query->where('name','like',"%$key%");
        }

        return $query;
    }

}
