@extends('template.admin')

@section('title', 'Coupon')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('main')
    <div class="wrap">
    <h1>開催中クーポン</h1>
      <div class="container">
        <div class="row">
          <?php for ($i=0; $i < 5; $i++) {  ?>
        <form class="" action="#" method="post">
          <table class="table table-bordered" style="margin-top:70px"> <!-- サンプル -->
            <tr><th>ID:</th><td>001</td><th>クーポン名:</th><td>マルゲリータピザ無料!</td><th>担当者:</th><td>001</td></tr>
            <tr><th>シリアル:</th><td>0724545194194</td><th>条件:</th><td>2500</td><th></th><td><input type="submit" name="name" class="btn btn-primary btn-lg" value="削除"></td></tr>
            <tr><th>値引き金額:</th><td>900</td><th>商品プレゼント:</th><td>001</td><th></th><td><input type="submit" name="name" class="btn btn-primary btn-lg" value="編集"></td></tr>
            <tr><th>開始日:</th><td>2016/05/30</td><th>終了日:</th><td>2017/11/23</td><th>制限:</th><td>1回</td></tr>
            <tr><th>登録日時:</th><td>2150/11/11 22:55:44</td><th>更新日時:</th><td>5566/44//99 65:44:55</td><th>対象:</th><td>初回のみ</td></tr>
          </table>
          <?php } ?>
        </form>
        </div>
<div class="text-center" style="margin-top:50px">
  <a href="#" class="btn btn-primary btn-lg">戻る</a>
</div>
    </div><tbody>
      <td>

      </td>
    </tbody>
  </div>
@endsection