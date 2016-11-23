<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use Mail;
use App\Mail\Contacted;

class ContactController extends Controller
{
    //

    public function index() {
      return view('contact.index');
    }

   public function send(Request $request)
   {

       $this->validate($request, [
           'email' => 'required|email',
           'body' => 'required',
       ]);

        $data = $request->all();
        Mail::send(['text' => 'mail.contact'], $data, function($message) use($data){ // useを追加
        $message->to($data["email"])->subject('お問い合わせ');
        });
       return view('contact.complete');
   }

}
