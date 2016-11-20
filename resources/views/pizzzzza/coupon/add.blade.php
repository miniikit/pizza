@extends('template.admin')

@section('title', 'Coupon')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('main')
    <div class="wrap">
      <h1>クーポン新規発行</h1>
        <div class="text-center">
          <ul>
            <li><a href="#"><input type="button" style="width:30%; margin-bottom:50px; margin-top:30px;" class="btn btn-primary btn-lg" name="name" value="値引き"></a></li>
            <li><a href="#"><input type="button" style="width:30%;margin-bottom:50px;"class="btn btn-primary btn-lg" name="name" value="プレゼント"></a></li>
          </ul>

        </div>
        <div class="text-left">
          <button type="button" class="btn btn-primary btn-lg"name="button">戻る</button>
        </div>
    </div>
@endsection