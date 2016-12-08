<?php


namespace App\Service;
use App\User;
use Illuminate\Support\Facades\DB;

class PhoneOrderService
{
    public function searchPhoneNumber($phone) {

        $user = User::with('gender')->where('phone','=',$phone)->get();

        return $user;

    }

    public function getUser($id) {
        $user = DB::table('users')->where('id','=',$id)->first();
        //dd($user);
        return $user;
    }

}