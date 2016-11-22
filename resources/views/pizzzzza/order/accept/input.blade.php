@extends('template.admin')

@section('title', '電話注文')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('main')
    <div class="wrap">
      <h1>電話番号受付</h1>
      <div id="tel">
        <h2 class="text-center">顧客情報確認</h2>
        <h3 class="text-center">電話番号入力</h3>
        <form class="form-inline">

          <div class="form-group">
              <input class="form-control"  type="text" name="name" value="">-
          </div>

          <div class="form-group">
              <input type="text" name="password" class="form-control">-
          </div>

          <div class="form-group">
              <input type="text" name="password" class="form-control">
          </div>
            <button type style="margin-top:20px;" ="button" class="btn btn-primary btn-lg"name="button">確認</button>
          </form>

      </div>
    </div>
@endsection
