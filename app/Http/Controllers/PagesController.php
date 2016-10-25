<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function company(){ return view('company/index'); }
    public function privacypolicy(){ return view('privacypolicy/index'); }
    public function faq(){ return view('faq/index'); }
}
