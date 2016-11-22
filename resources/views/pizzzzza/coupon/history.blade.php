@extends('template.admin')

@section('title', 'Coupon')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('main')
    <div class="wrap">
    <h1>過去クーポン一覧</h1>
      <div class="container">
        <div class="table" style="margin-top:15px">
  <table class="table"> <!-- サンプル -->
    <thead>
      <tr>
        <th>クーポンID</th>
        <th>クーポン名</th>
        <th>シリアル番号</th>
        <th>条件金額</th>
        <th>値引き金額</th>
        <th>プレゼント商品</th>
        <th>上限</th>
        <th>対象者</th>
        <th>登録日</th>
        <th>開始日</th>
        <th>終了日</th>
        <th>担当者</th>
      </tr>
    </thead>
    <tbody>
      <?php for ($i=0; $i < 20 ; $i++) { ?>
      <tr>
          <td><?php echo $i ; ?></td>
          <td>マルゲリータピザ無料!</td>
          <td>19191145147</td>
          <td>2000</td>
          <td>1000</td>
          <td>000</td>
          <td>無制限</td>
          <td>全員</td>
          <td>1111/22/11 11:22:33</td>
          <td>4444/22/11</td>
          <td>4456/88/45</td>
          <td>003</td>
      </tr>
        <?php } ?>
    </tbody>
  </div>
  </table>
<div class="text-center">
  <a href="/pizzzzza/coupon/list" class="btn btn-primary btn-lg">戻る</a>
</div>
    </div>
  </div>
@endsection