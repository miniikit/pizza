<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Service\ContactService;

class ContactController extends Controller
{
    //

    public function index() {

      return view('contact.index');

    }

   public function send(ContactRequest $request)
   {

       $data = $request->all();


       $contact = new ContactService();

       $contact->send($data);

       return view('contact.complete');

   }

}