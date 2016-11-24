<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AnalysisController extends Controller
{
    public function index() {
        return view('pizzzzza.analysis.index');
    }

    public function analysisPopuler(){
        return view('pizzzzza.analysis.Populer');
    }

    public function analysisEarning(){
        return view('pizzzzza.analysis.Earning');
    }
}
