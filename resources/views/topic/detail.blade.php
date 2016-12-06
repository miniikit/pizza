
@extends('template/master')

@section('title', 'キャンペーン詳細')

@section('css')
    <link rel="stylesheet" href="/css/topic/detail.css" media="all" title="no title">
@endsection

@section('plug')

@endsection

@section('main')
    <div class="container wrap">
      <div class="title">
        <h1>キャンペーン詳細</h1>
      </div>
        <div class="campaignBox">
          <ul>
            <li class="box1">
              <img class="image" src="{{ $campaign->campaign_image }}" alt="" />
            </li>
            <li class="box2">
              <div class="box3">
                <h1>キャンペーンタイトル</h1>
              </div>
              <div class="box-text">
                <h2>{{ $campaign->campaign_title }}</h2>
              </div
            </li>
            <li class="box2">
              <div class="box3">
                <h1>キャンペーン期間</h1>
              </div>
              <div class="box-text">
                <h2>{{ $campaign->campaign_start_day }}~{{ $campaign->campaign_end_day }}</h2>
              </div>
            </li>
            <li class="box2">
              <div class="box3">
                <h1>キャンペーン対象者</h1>
              </div>
              <div class="box-text">
                <h2>{{ $campaign->campaign_subject }}</h2>
              </div>
            </li>
            <li class="box2">
              <div class="box3">
                <h1>キャンペーン内容</h1>
              </div>
              <div class="box-text">
                <h2>{{ $campaign->campaign_text }}</h2>
              </div>
            </li>
            <li class="box2">
              <div class="box3">
                <h1>注意事項</h1>
              </div>
              <div class="box-text">
                <h2>{{ $campaign->campaign_note }}</h2>
              </div>
            </li>
         </ul>
       </div>
       <div class="ac">
         <div class="button"><a href="/topic">戻る</a></div>
         <div class="button"><a href="/">TOPへ</a></div>
         </div>
       </div>
    </div>
@endsection

@section('scrip')

@endsection
