<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AdminCampaignsController extends Controller
{
    // キャンペーン一覧
    public function index(){
        return view('pizzzzza.campaign.index');
    }

    // キャンペーン履歴
    public function history(){
        return view('pizzzzza.campaign.history');
    }

    // キャンペーン詳細
    public function show($id){
        return view('pizzzzza.campaign.show',compact('id'));
    }

    // キャンペーン追加
    public function add(){
        return view('pizzzzza.campaign.add');
    }

    // キャンペーン更新
    public function edit($id){
        return view('pizzzzza.campaign.edit');
    }

    // キャンペーン更新処理
    public function update($id){

    }

    // キャンペーン削除処理
    public function delete($id){

    }

    // キャンペーン追加処理
    public function store(Request $request){

    }

}
