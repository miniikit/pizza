
@extends('template/master')

@section('title', 'キャンペーン詳細')

@section('css')
    <link rel="stylesheet" href="/css/topic/detail.css" media="all" title="no title">
@endsection

@section('plug')

@endsection

@section('main')
    <div class="container wrap">
      <h1>キャンペーン詳細</h1>
        <div class="campaignBox">
        <ul>
          <li class="box1">
            <img class="image" src="{{ $campaign->campaign_image }}" alt="" />
          </li>
          <li class="box2">
            <div class="title">
              <h1>{{ $campaign->campaign_title }}</h1>
            </div>
          </li>
          <li class="box3">
            <div class="term">
              <h1>キャンペーン期間:{{ $campaign->campaign_start_day }}~{{ $campaign->campaign_end_day }}</h1>
            </div>
          </li>
          <li class="box4">
            <div class="subject">
              <h1>キャンペーン対象者:{{ $campaign->campaign_subject }}</h1>
            </div>
          </li>
          <li class="box5">
            <div class="text">
              <h1>キャンペーン内容:{{ $campaign->campaign_text }}</h1>
            </div>
          </li>
          <li class="box6">
            <div class="note">
              <h1>注意事項:{{ $campaign->campaign_note }}</h1>
            </div>
          </li>
       </ul>
       </div>


    </div>
@endsection

@section('scrip')

@endsection
