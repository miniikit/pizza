<?php


namespace App\Service;
use App\User;

class PhoneOrderService
{
    public function searchPhoneNumber($number) {

        $user = User::with('gender')->where('phone','=',$number)->get();

        return $user;

    }

}