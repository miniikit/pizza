
@extends('template/master')

@section('title', 'topic')

@section('css')
    <link rel="stylesheet" href="/css/topic/index.css" media="all" title="no title">
@endsection

@section('plug')

@endsection

@section('main')
    <div class="container wrap">
      <h1>キャンペーン一覧</h1>
        @foreach ($campaigns as $campaign)
        <div class="campaignBox">
        <ul>
          <li class="box1"><a href="/topicdetail?id={{ $campaign->id }}"><img class="image"  src="{{ $campaign->campaign_image }}" alt="" /></li></a>
          <li class="box2">
            <div class="box">
              <div class="title">
                <h1>{{ $campaign->campaign_title }}</h1>
              </div>
              <div class="note">
                <h1>{{ $campaign->campaign_note }}</h1>
              </div>
            </div>
          </li>
       </ul>
       </div>
        @endforeach


    </div>
@endsection

@section('scrip')

@endsection
