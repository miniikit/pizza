<!DOCTYPE html>
@extends('template/admin')

@section('title', '売れ筋')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/analysis/index.css" media="all" title="no title">
@endsection

@section('main')
    <div class="wrap">
    <h1>売上確認</h1>
    <form class="text" action="#" method="post" class="">
      <div class="text-right">
    <div class="btn-group" data-toggle="buttons">
  <label class="active">
    <input type="submit" autocomplete="off" value="性別" class="btn btn-primary">
  </label>
  <label class="">
    <input type="submit" autocomplete="off" value="年代" class="btn btn-success">
  </label>
  <label class="">
    <input type="submit" autocomplete="off" value="期間" class="btn btn-danger">
  </label>
</div>
</div>
</form>
<div class="">
  <img src="images/test/earnings.png" alt="" />
</div>
<div class="">
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>商品名</th>
        <th>値段</th>
        <th>売上数</th>
        <th>売上金額</th>
      </tr>
    </thead>
    <tbody>
      <?php for ($i=1; $i <= 20 ; $i++) {
      $p = 750 ;  ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td>マルゲリータピザ</td>
        <td><?php echo $p ; ?></td>
        <td>49582</td>
        <td><?php echo 49582*$p ; ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</div>
@endsection
