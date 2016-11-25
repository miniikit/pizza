@extends('template.admin')

@section('title', '電話注文')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('main')
<div class="wrap">
<h1>電話注文</h1>
<div id="tel">
<form class="" action="index.html" method="post">
<div class="form-group">
<input type="text" class="form-control" placeholder="電話番号を入力してください" name="tel" value="" >
</div>
<button type="button" class="btn btn-primary btn-lg btn-block">確認</button>
</form>
</div>
</div>
@endsection
