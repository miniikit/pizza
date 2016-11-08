@extends('template/admin')

@section('title', 'メニュー追加画面')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('main')
    <h1>メニュー追加画面</h1>
    <div class="form-group" id="menuadd">
      <ul>
        <li><label for="">商品名</label><input class="form-control" type="text" name="name" value=""></li>
        <li><label for="">ジャンル</label><select name="example2">
          <option value="---">-----</option>
          <option value="選択肢1">メイン</option>
          <option value="選択肢2">ドリンク</option>
          <option value="選択肢3">サイド</option>
        </select></li>
        <li><label for="">価格</label><input class="form-control" type="number" name="name" value=""></li>
        <li><label for="example-date-input">販売開始日</label><input class="form-control" id="example-date-input" type="date" name="name" value="" size="5"></li>
        <li><label for="example-date-input">販売終了日</label><input class="form-control" id="example-date-input" type="date" name="name" value="" size="5"></li>
        <li><label for="">商品画像</label><input class="fotm-control" type="file" name"name" value""></li>
        <li><label for="">商品説明文</label><textarea class="form-control" id="exampleTextarea" rows="6" maxlength="255" ></textarea></li>
      </ul>
    </div>
      
      <div id="menuedit_button">
      <button type="button" class="btn btn-primary btn-lg"name="button">戻る</button>
      <button type="button" class="btn btn-primary btn-lg"name="button">確認</button>
      </div>

@endsection
