<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Service\AdminCampaignService;
use App\Http\Requests\AdminCampaignRequest;
use App\Http\Requests\AdminCampaignEditRequest;


class AdminCampaignsController extends Controller
{
    // キャンペーン一覧
    public function index(){

        $Campaign = new AdminCampaignService();
        $campaigns = $Campaign->getNowAll();

        return view('pizzzzza.campaign.index',compact('campaigns'));
    }

    // キャンペーン履歴
    public function history(){

        $Campaign = new AdminCampaignService();
        $campaigns = $Campaign->getAll();

        return view('pizzzzza.campaign.history',compact('campaigns'));
    }

    // キャンペーン詳細
    public function show($id){

        $Campaign = new AdminCampaignService();
        $campaign = $Campaign->getOne($id);

        return view('pizzzzza.campaign.show',compact('campaign','id'));
    }

    // キャンペーン追加
    public function add(){
        return view('pizzzzza.campaign.add');
    }

    // キャンペーン編集
    public function edit($id){

        $Campaign = new AdminCampaignService();
        $campaign = $Campaign->getOne($id);

        return view('pizzzzza.campaign.edit',compact('campaign','id'));
    }

    // キャンペーン更新処理
    public function update(AdminCampaignEditRequest $request,$id){
        // campaign_start_dateは送られてこない。 campaign_image、campaign_bannerは更新がある場合のみ送られてくる。

        $Campaign = new AdminCampaignService();
        $campaign = $Campaign->update($request,$id);

        if(count($campaign) >= 1) {
            flash('キャンペーンの更新が完了しました。', 'success');
        }else{
            flash('キャンペーンの更新に失敗しました。','danger');
        }

        return redirect()->route('adminCampShow',$id);
    }

    // キャンペーン削除処理
    public function delete($id){
        
        $Campaign = new AdminCampaignService();
        $delete = $Campaign->delete($id);

        if(count($delete) >= 1) {
            flash('キャンペーンの削除が完了しました。', 'success');
        }else{
            flash('キャンペーンの削除に失敗しました。','danger');
        }

        return redirect()->route('adminCampShow',$id);
    }

    // キャンペーン追加処理
    public function store(AdminCampaignRequest $request){

        $Campaign = new AdminCampaignService();
        $id = $Campaign->insert($request);

        if(count($id) >= 1) {
            flash('キャンペーンの作成が完了しました。', 'success');
        }else{
            flash('キャンペーンの作成に失敗しました。','danger');
        }

        return redirect()->route('adminCampShow',$id);
    }

}
