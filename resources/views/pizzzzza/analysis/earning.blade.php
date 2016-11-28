<!DOCTYPE html>
@extends('template/admin')

@section('title', '売れ筋')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/analysis/index.css" media="all" title="no title">
@endsection

@section('main')
    <h1>売上確認</h1>
    <div class="dropdown mb">
      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        性別
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
        <li><a href="#">性別</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="#">年代</a></li>
        <li role="separator" class="divider"></li>
        <li><a href="#">期間</a></li>
      </ul>
    </div>
    <div class="ac">
        <img src="http://nmbr.jp/wp/wp-content/uploads/2015/02/mcdonaldhdjp.png" alt="" />
    </div>
    <div class="row">
      <div class="col-md-8">
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
      <div class="col-md-4">.col-md-4</div>
    </div>
@endsection
