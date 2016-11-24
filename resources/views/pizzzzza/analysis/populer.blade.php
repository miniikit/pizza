@extends('template/admin')

@section('title', '売れ筋')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/analysis/index.css" media="all" title="no title">
@endsection

@section('main')
    <div class="wrap">
    <h1>売れ筋商品</h1>
<div class="">
  <table class="table">
    <thead>
      <tr>
        <th>順位</th>
        <th>商品名</th>
        <th>売上数</th>
      </tr>
    </thead>
    <tbody>
      <?php for ($i=1; $i <= 5 ; $i++) {  ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td>マルゲリータピザ</td>
        <td>523425</td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<div class="">
  <img src="images/test/popular.jpeg" alt="" />
</div>
</div>
@endsection
