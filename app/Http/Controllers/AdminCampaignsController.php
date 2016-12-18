<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Service\AdminCampaignService;
use App\Http\Requests\AdminCampaignRequest;
use App\Http\Requests\AdminCampaignEditRequest;


class AdminCampaignsController extends Controller
{
    // キャンペーン一覧 k
    public function index(){

        $Campaign = new AdminCampaignService();
        $campaigns = $Campaign->getAll();

        return view('pizzzzza.campaign.index',compact('campaigns'));
    }

    // キャンペーン履歴
    public function history(){
        return view('pizzzzza.campaign.history');
    }

    // キャンペーン詳細 k
    public function show($id){

        $Campaign = new AdminCampaignService();
        $campaign = $Campaign->getOne($id);

        return view('pizzzzza.campaign.show',compact('campaign','id'));
    }

    // キャンペーン追加
    public function add(){
        return view('pizzzzza.campaign.add');
    }

    // キャンペーン編集 k
    public function edit($id){

        $Campaign = new AdminCampaignService();
        $campaign = $Campaign->getOne($id);

        return view('pizzzzza.campaign.edit',compact('campaign','id'));
    }

    // キャンペーン更新処理 画像が反映されない
    public function update(AdminCampaignEditRequest $request,$id){
        // campaign_start_dateは送られてこない。 campaign_image、campaign_bannerは更新がある場合のみ送られてくる。

        $Campaign = new AdminCampaignService();
        $campaign = $Campaign->update($request,$id);

        if(count($campaign) >= 1) {
            flash('クーポンの更新が完了しました。', 'success');
        }else{
            flash('クーポンの更新に失敗しました。','danger');
        }

        return redirect()->route('adminCampShow',$id);
    }

    // キャンペーン削除処理
    public function delete($id){

    }

    // キャンペーン追加処理 画像が反映されない
    public function store(AdminCampaignRequest $request){

        $Campaign = new AdminCampaignService();
        $id = $Campaign->insert($request);

        if(count($id) >= 1) {
            flash('クーポンの作成が完了しました。', 'success');
        }else{
            flash('クーポンの作成に失敗しました。','danger');
        }

        return redirect()->route('adminCampShow',$id);
    }

}
