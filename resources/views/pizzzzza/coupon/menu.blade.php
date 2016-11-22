@extends('template.admin')

@section('title', 'Coupon')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('main')
    <div class="wrap">
      <h1>クーポン</h1>
        <div class="text-center">
          <ul>
            <li><a href="/pizzzzza/coupon/list"><input type="button" style="width:30%; margin-bottom:50px; margin-top:30px;" class="btn btn-primary btn-lg" name="name" value="現在期間中"></a></li>
            <li><a href="#"><input type="button" style="width:30%;margin-bottom:50px;"class="btn btn-primary btn-lg" name="name" value="新規発行"></a></li>
            <li><a href="#"><input type="button" style="width:30%;" class="btn btn-primary btn-lg" name="name" value="履歴閲覧"></a></li>
          </ul>

        </div>
    </div>
@endsection