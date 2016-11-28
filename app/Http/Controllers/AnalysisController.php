<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AnalysisController extends Controller
{
    public function index() {
        return view('pizzzzza.analysis.earning');
    }

    public function populer(){
        return view('pizzzzza.analysis.populer');
    }

}
