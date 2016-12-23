@extends('template/admin')

@section('title', '注文詳細')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/order/show.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order">ホーム</a></li>
        @if(preg_match('{history}',$_SERVER["HTTP_REFERER"]))

        @else
            <li><a href="/pizzzzza/order/history">注文履歴</a></li>
        @endif
        <li class="active">注文詳細</li>
    </ol>
@endsection

@section('main')
    <h1>注文詳細</h1>
    <div class="row">
        <div class="col-md-7">

            <h2 class="title">注文情報</h2>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="text-center">注文日</th>
                    <td>{{ \Carbon\Carbon::parse($order->order_date)->format('Y年m月d日 H時i分') }}</td>
                </tr>
                <tr>
                    <th class="text-center">注文日</th>
                    <td>{{ \Carbon\Carbon::parse($order->order_appointment_date)->format('Y年m月d日 H時i分') }}</td>
                </tr>
                <tr>
                    @if(is_null($order->coupon))
                        <th class="text-center">クーポン</th>
                        <td>無</td>
                    @else
                        <th class="text-center">クーポン</th>
                        <td>{{ $order->coupon->coupon_name }}</td>
                    @endif
                </tr>
                <tr>
                    <th class="text-center">担当者</th>
                    @if(is_null($order->employee))
                        <td>Web注文</td>
                    @else
                        <td>{{ $order->employee->user->name }}</td>
                    @endif
                </tr>
                </tbody>
            </table>

            <h2 class="title">顧客情報</h2>
            <table class="table table-bordered">
                <tbody>
                @if(is_null($order->user->email))
                <tr>
                    <th class="text-center">Web登録</th>
                    <td>無</td>
                </tr>
                @else
                <tr>
                    <th class="text-center">Web登録</th>
                    <td>有</td>
                </tr>
                @endif
                <tr>
                    <th class="text-center">名前</th>
                    <td>{{ $order->user->name }}</td>
                </tr>
                <tr>
                    <th class="text-center">フリガナ</th>
                    <td>{{ $order->user->kana }}</td>
                </tr>
                @if($order->user->gender)
                <tr>
                    <th class="text-center">性別</th>
                    <td>{{ $order->user->gender->gender_name }}</td>
                </tr>
                @endif
                @if($order->user->birthday)
                <tr>
                    <th class="text-center">生年月日</th>
                    <td>{{ \Carbon\Carbon::parse($order->user->birthday)->format('Y年m月d日') }}</td>
                </tr>
                @endif
                <tr>
                    <th class="text-center">郵便番号</th>
                    <td>{{ $order->user->postal }}</td>
                </tr>
                <tr>
                    <th class="text-center">住所</th>
                    <td>{{ $order->user->address1 . $order->user->address2 . $order->user->address3}}</td>
                </tr>
                <tr>
                    <th class="text-center">電話番号</th>
                    <td>{{ $order->user->phone }}</td>
                </tr>
                @if($order->user->email)
                <tr>
                    <th class="text-center">メールアドレス</th>
                    <td>{{ $order->user->email }}</td>
                </tr>
                @endif
                </tbody>
            </table>
        </div>
        <div class="col-md-5">
            <h2 class="title">注文内容</h2>

            <?php
                $sum = 0;
                $total = 0;
            ?>

            {{--{{ dd($order) }}--}}
            @foreach($order->detail as $product)
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th class="text-center">商品名</th>
                        <td>
                            <a href="/pizzzzza/menu/{{$product->productPrice->product->id}}/show">{{ $product->productPrice->product->product_name }}</a>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-center">価格</th>
                        <td>
                            {{ number_format($product->productPrice->product_price) }} 円
                        </td>
                    </tr>
                    <tr>
                        <th class="text-center">数量</th>
                        <td>
                            {{ $product->number }}
                        </td>
                    </tr>
                    <tr>
                        <th class="text-center">小計</th>
                        <td>
                            {{ number_format($product->productPrice->product_price * $product->number) }} 円
                        </td>
                    </tr>
                    </tbody>
                </table>
                <?php
                    $sum += $product->number;
                    $total += $product->productPrice->product_price * $product->number;
                ?>
            @endforeach

            <h2 class="title">合計</h2>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="text-center">合計数量</th>
                    <td>
                        {{ $sum }}
                    </td>
                </tr>
                <tr>
                    <th class="text-center">合計金額</th>
                    <td>
                        {{ number_format($total) }} 円
                    </td>
                </tr>
                </tbody>
            </table>

        </div>
        <div class="col-md-4 col-md-offset-4 mt">
            @if(preg_match('{history}',$_SERVER["HTTP_REFERER"]))
                <a href="/pizzzzza/order/history" class="btn btn-default btn-lg btn-block">戻る</a>
            @else {{-- 電話注文ページからの繊維である場合 --}}
                <a href="{{ $_SERVER["HTTP_REFERER"] }}" class="btn btn-default btn-lg btn-block">戻る</a>
            @endif
        </div>
    </div>
@endsection
