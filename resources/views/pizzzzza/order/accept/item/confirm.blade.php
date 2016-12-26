@extends('template.admin')

@section('title', '注文確認')

@section('css')
    <link rel="stylesheet" href="/css/accept/index.css" media="all" title="no title">
    <link rel="stylesheet" href="/css/pizzzzza/phone/index.css" media="all" title="no title">
    <link rel="stylesheet" href="/css/accept/confirm.css" media="all" title="no title">
@endsection

@section('pankuzu')
<ol class="breadcrumb">
    <li><a href="/pizzzzza/order">ホーム</a></li>
    <li><a href="/pizzzzza/order/accept/input">電話注文</a></li>
    <li><a href="/pizzzzza/order/accept/customer/{{ $id }}/show">お客様情報確認</a></li>
    <li><a href="/pizzzzza/order/accept/item/{{ $id }}/select">商品選択</a></li>
    <li class="active">注文確認</li>
</ol>
@endsection

@section('main')
    <div class="wrap">
        <h1>注文確認</h1>
        <form action="/pizzzzza/order/accept/item/{{ $id }}/complete" method="post">

          <div class="info">
            <table class="table table-bordered">
              <!-- お客様情報 -->
                <tr>
                    <th>名前</th>
                    <th>住所</th>
                    <th>電話番号</th>
                    <th>配達希望日時</th>
                    <th>合計金額</th>
                    <th>支払い種別</th>
                </tr>
                <tr>
                    <td>{{ $user->name }}（{{ $user->kana }}）</td>
                    <td> {{ $user->address1 }} {{ $user->address2 }} {{ $user->address3 }}</td>
                    <td> {{ $user->phone }}</td>
                    <td>
                        <input type="date" name="date" value="{{ old('date',\Carbon\Carbon::now()->toDateString()) }}">
                        <input type="time" name="time" value="{{ old('time',\Carbon\Carbon::now()->addHour()->format('H:i')) }}">
                    </td>
                    <td> {{ number_format($total) }}円</td>
                    <td> 代引き</td>
                </tr>
            </table>
          </div>

          <div class="status">
            <table class="table table-bordered">
              <!-- 注文情報詳細 -->
                <tr>
                    <th>商品名</th>
                    <th>数量</th>
                    <th>単価</th>
                    <th>小計</th>
                </tr>
                @foreach($items as $item)
                <tr>
                    <td> <input type="hidden" name="{{ $item->product_name }}" value="{{ $item->num }}">{{ $item->product_name }}</td>
                    <td> {{ $item->num }}個</td>
                    <td> {{ number_format($item->product_price) }}円</td>
                    <td> {{ number_format($item->product_price * $item->num) }}円</td>
                </tr>
                @endforeach
            </table>
          </div>

          <div class="text-center">
              <a href="/pizzzzza/order/accept/item/{{ $id }}/select" class="btn btn-default btn-lg">戻る</a>
              <input type="submit" class="btn btn-primary btn-lg" name="" value="注文確定">
          </div>
        {{ csrf_field() }}
        </form>
    </div>

@endsection
