<?php
/**
 * Created by PhpStorm.
 * User: minion
 * Date: 2016/11/15
 * Time: 14:17
 */


//セッションIDからユーザIDを取得するのが、セッション内不明のため、まだ。

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