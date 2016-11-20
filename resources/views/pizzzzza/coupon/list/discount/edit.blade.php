@extends('template.admin')

@section('title', '値引クーポン編集画面')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('main')
      <div class="wrap">
        <h1>クーポン編集(値引き)</h1>
          <div class="form-group table-responsive">
            <table class="table">
              <tbody>
                <tr>
                  <th class="text-center" style="padding-top:12px;"><label for="">クーポン名</label></th>
                  <td><input class="form-control" type="text" name="name" value=""></td>
                </tr>
                <tr>
                  <th class="text-center" style="padding-top:12px;"><label for="">シリアルコード</label></th>
                  <td><input class="form-control" type="text" name="name" value="" readonly=""></td>
                </tr>
                <tr>
                  <th class="text-center" style="padding-top:12px;"><label for="">値引き金額</label></th>
                  <td><input class="form-control" style="width:30%;" type="text" name="name" value="" readonly=""></td>
                </tr>
                <tr>
                  <th class="text-center" style="padding-top:12px;"><label for="">使用条件</label></th>
                  <td><input class="form-control" placeholder="円以上" type="text" name="name" value="" style="width:30%"></td>
                </tr>
                <tr>
                  <th class="text-center" style="padding-top:12px;"><label for="">使用開始日</label></th>
                  <td><input class="form-control" type="date" name="name" value="" size="5" style="width:30%"></td>
                </tr>
                <tr>
                  <th class="text-center" style="padding-top:12px;"><label for="">使用終了日</label></th>
                  <td><input class="form-control" type="date" name="name" value="" size="5" style="width:30%"></td>
                </tr>
                <tr>
                  <th class="text-center" style="padding-top:12px;"><label for="">使用終了日</label></th>
                  <td><input type="radio" name="name" value="">指定しない</td>
                </tr>
                <tr>
                  <th class="text-center" style="padding-top:12px;"><label for="">上限回数</label></th>
                  <td><input class="form-control" type="text" name="name" placeholder="回" value="" style="width:10%" readonly=""></td>
                </tr>
                <tr>
                  <th class="text-center" style="padding-top:12px;"><label for="">上限回数</label></th>
                  <td><input type="radio" name="name" value="">指定しない</td>
                </tr>
                <tr>
                  <th class="text-center" style="padding-top:12px;"><label for="">対象者</label></th>
                  <td><input  type="radio" name="name" value="">全員
                  <input type="radio" name="name" value="">新規</td>
                </tr>
              </tbody>
            </table>

          </div>
          <div id="menuedit_button">
            <button type="button" class="btn btn-primary btn-lg"name="button">戻る</button>
            <button type="button" class="btn btn-primary btn-lg"name="button">確認</button>
          </div>
      </div>
@endsection