<?php


namespace App\Service;
use App\User;

class PhoneOrderService
{
    public function searchPhoneNumber($phone) {

        $user = User::with('gender')->where('phone','=',$phone)->get();

        return $user;

    }

}