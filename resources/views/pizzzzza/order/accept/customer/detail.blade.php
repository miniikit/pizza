@extends('template.admin')

@section('title', '電話注文')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('main')
    <div class="wrap">
      <h1>お客様情報確認</h1>
      <div class="form-group table-responsive">
        <table class="table">
          <tbody>
            <tr>
              <th class="text-center" style="padding-top:12px;"><label for="">名前(漢字)</label></th>
              <td>有村千賀</td>
            </tr>
            <tr>
              <th class="text-center" style="padding-top:12px;"><label for="">名前(カナ)</label></th>
              <td>アリムラチカ</td>
            </tr>
            <tr>
              <th class="text-center" style="padding-top:12px;"><label for="">郵便番号</label></th>
              <td>6801010</td>
            </tr>
            <tr>
              <th class="text-center" style="padding-top:12px;"><label for="">都道府県</label></th>
              <td>ほか移動</td>
            </tr>
            <tr>
              <th class="text-center" style="padding-top:12px;"><label for="">市区町村</label></th>
              <td><input class="form-control" type="text" name="name" value="" placeholder="市区町村"></td>
            </tr>
            <tr>
              <th class="text-center" style="padding-top:12px;"><label for="">番地</label></th>
              <td><input class="form-control" type="text" name="name" value="" placeholder="番地"></td>
            </tr>
            <tr>
              <th class="text-center" style="padding-top:12px;"><label for="">建物名</label></th>
              <td><input class="form-control" type="text" name="name" value="" placeholder="建物名"></td>
            </tr>
            <tr>
              <th class="text-center" style="padding-top:12px;"><label for="">電話番号</label></th>
              <td><input class="form-control"  type="number" name="name" value="" placeholder=""></td>
            </tr>
          </tbody>

        </table>
        <div class="text-center">
          <button type ="button" style="margin-top:20px;" class="btn btn-primary btn-lg"name="button">戻る</button>
          <button type ="button" style="margin-top:20px;" class="btn btn-primary btn-lg"name="button">次へ</button>
        </div>
        <div class="text-right">
          <button type ="button" style="margin-top:20px;" class="btn btn-primary btn-lg"name="button">編集</button>
        </div>

      </div>
    </div>
@endsection
