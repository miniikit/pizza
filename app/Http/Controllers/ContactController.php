<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Mail;
use App\Mail\Contacted;

class ContactController extends Controller
{
    //

    public function index() {

      return view('contact.index');
    }

    /**
    * メール送信処理
    * @param  Request $request フォームで入力された値
    * @return redirector       入力画面へリダイレクト
    */
   public function send(Request $request)
   {
      //  Mail::to('B5021@oic.jp')->send(new Contacted($request));
        $data = $request->all();
        Mail::send(['text' => 'mail.contact'], $data, function($message) use($data){ // useを追加
        $message->to($data["email"])->subject('お問い合わせ');
        });
        return redirect('/contact');
   }

}
