@extends('template.admin')

@section('title', '注文情報確認')

@section('css')
    <link rel="stylesheet" href="/css/accept/index.css" media="all" title="no title">
    <link rel="stylesheet" href="/css/pizzzzza/phone/index.css" media="all" title="no title">
    <link rel="stylesheet" href="/css/accept/confirm.css" media="all" title="no title">
@endsection

@section('pankuzu')
<ol class="breadcrumb">
    <li><a href="/pizzzzza/order">ホーム</a></li>
    <li><a href="/pizzzzza/order/accept/input">電話注文受付</a></li>
    <li><a href="/pizzzzza/order/accept/customer/{id}/show">お客様情報確認</a></li>
    <li><a href="/pizzzzza/order/accept/item/{id}/select">商品選択</a></li>
    <li class="active">注文情報確認</li>
</ol>
@endsection

@section('main')
    <div class="wrap">
        <h1>注文情報確認</h1>
        <form action="" method="post">

          <div class="info">
            <table class="table table-bordered">
              <!-- お客様情報 -->
                <tr>
                    <th>名前</th>
                    <th>住所</th>
                    <th>電話番号</th>
                    <th>配達日時</th>
                    <th>注文金額</th>
                    <th>支払い種別</th>
                </tr>
                <tr>
                    <td> 名前がはいります</td>
                    <td> 住所がはいります</td>
                    <td> 電話番号がはいります</td>
                    <td> 配達日時がはいります</td>
                    <td> 注文金額がはいります</td>
                    <td> 支払い種別がはいります</td>
                </tr>
            </table>
          </div>

          <div class="status">
            <table class="table table-bordered">
              <!-- 注文情報詳細 -->
                <tr>
                    <th>商品ID</th>
                    <th>商品名</th>
                    <th>数量</th>
                </tr>
                <tr>
                    <td> 商品IDがはいります</td>
                    <td> 商品名がはいります</td>
                    <td> 数量がはいります</td>
                </tr>
            </table>
          </div>

          <div class="text-center">
              <input type="submit" class="btn btn-default btn-lg" name="" value="戻る">
              <input type="submit" class="btn btn-primary btn-lg" name="" value="注文確定">
          </div>

        </form>
    </div>

@endsection
