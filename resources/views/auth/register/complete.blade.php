@extends('template.auth')

@section('title', '登録完了')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('main')
<div class="container">
  <div class="col-md-8 col-md-offset-2">
  <div class="panel panel-default">
    <div class="panel-body">
      <h2>会員完了しました!</h2>
      この度は、OIC PIZZAをご利用いただき、誠にありがとうございます。<br>
      次回から、この会員情報をご利用ください。<br>
      <div class="text-center">
      <a href="/" class="btn btn-primary">TOPへ</a>
      <a href="/login" class="btn btn-success">ログイン</a>
      </div>
    </div>
  </div>
  </div>
</div>
@endsection
