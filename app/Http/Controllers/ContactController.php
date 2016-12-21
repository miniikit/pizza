<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Service\ContactService;

class ContactController extends Controller
{
    protected $contactService;

    /**
     * ContactController constructor.
     * @param $contactService
     */
    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }


    public function index() {

      return view('contact.index');

    }

   public function send(ContactRequest $request)
   {

       $data = $request->all();

       $this->contactService->send($data);

       return view('contact.complete');

   }

}
