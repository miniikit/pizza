<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Service\AdminCampaignService;
use App\Http\Requests\AdminCampaignRequest;


class AdminCampaignsController extends Controller
{
    // キャンペーン一覧
    public function index(){

        $Campaign = new AdminCampaignService();
        $campaigns = $Campaign->getAll();

        return view('pizzzzza.campaign.index',compact('campaigns'));
    }

    // キャンペーン履歴
    public function history(){
        return view('pizzzzza.campaign.history');
    }

    // キャンペーン詳細
    public function show($id){

        $Campaign = new AdminCampaignService();
        $campaign = $Campaign->getOne($id);

        return view('pizzzzza.campaign.show',compact('campaign'));
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
    public function store(AdminCampaignRequest $request){
        dd($request->all());

        $camp = new AdminCampaignService();
        $camp->insert($request);
    }

}
