<?php


namespace App\Service;

use Illuminate\Support\Facades\Mail;


class ContactService
{

    public function send($data) {

        Mail::send('mail.contact', $data, function($message) use($data) {

            $message->to($data["email"])->subject('お問い合わせ');

        });

    }

}