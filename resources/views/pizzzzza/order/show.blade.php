@extends('template/admin')

@section('title', '従業員管理画面')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order">ホーム</a></li>
        <li><a href="/pizzzzza/order/history">注文履歴</a></li>
        <li class="active">詳細</li>
    </ol>
@endsection

@section('main')
    <h1>注文詳細</h1>
    <div class="row">
        <div class="col-md-7">

            <h2>注文情報</h2>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="text-center" >注文日</th>
                    <td>{{ \Carbon\Carbon::parse($order->order_date)->format('Y年m月d日 H時i分') }}</td>
                </tr>
                <tr>
                    <th class="text-center" >注文日</th>
                    <td>{{ \Carbon\Carbon::parse($order->order_appointment_date)->format('Y年m月d日 H時i分') }}</td>
                </tr>
                <tr>
                    @if(is_null($order->coupon))
                    <th class="text-center" >クーポン</th>
                    <td>無し</td>
                    @else
                    <th class="text-center" >クーポン</th>
                    <td>{{ $order->coupon->coupon_name }}</td>
                    @endif
                </tr>
                <tr>
                    <th class="text-center" >担当者</th>
                    @if(is_null($order->employee))
                        <td>Web注文</td>
                    @else
                        <td>{{ $order->employee->user->name }}</td>
                    @endif
                </tr>
                </tbody>
            </table>

            <h2>顧客情報</h2>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th class="text-center" >氏名</th>
                        <td>{{ $order->user->name }}</td>
                    </tr>
                    <tr>
                        <th class="text-center" >フリガナ</th>
                        <td>{{ $order->user->kana }}</td>
                    </tr>
                    <tr>
                        <th class="text-center" >性別</th>
                        <td>{{ $order->user->gender->gender_name }}</td>
                    </tr>
                    <tr>
                        <th class="text-center" >生年月日</th>
                        <td>{{ \Carbon\Carbon::parse($order->user->birthday)->format('Y年m月d日') }}</td>
                    </tr>
                    <tr>
                        <th class="text-center" >郵便番号</th>
                        <td>{{ $order->user->postal }}</td>
                    </tr>
                    <tr>
                        <th class="text-center" >住所</th>
                        <td>{{ $order->user->address1 . $order->user->address2 . $order->user->address3}}</td>
                    </tr>
                    <tr>
                        <th class="text-center" >電話番号</th>
                        <td>{{ $order->user->phone }}</td>
                    </tr>
                    <tr>
                        <th class="text-center" >メールアドレス</th>
                        <td>{{ $order->user->email }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-5">
            <h2>注文内容</h2>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="text-center" >注文日</th>
                    <td>{{ \Carbon\Carbon::parse($order->order_date)->format('Y年m月d日 H時i分') }}</td>
                </tr>
                <tr>
                    <th class="text-center" >注文日</th>
                    <td>{{ \Carbon\Carbon::parse($order->order_appointment_date)->format('Y年m月d日 H時i分') }}</td>
                </tr>
                <tr>
                    @if(is_null($order->coupon))
                        <th class="text-center" >クーポン</th>
                        <td>無し</td>
                    @else
                        <th class="text-center" >クーポン</th>
                        <td>{{ $order->coupon->coupon_name }}</td>
                    @endif
                </tr>
                <tr>
                    <th class="text-center" >担当者</th>
                    @if(is_null($order->employee))
                        <td>Web注文</td>
                    @else
                        <td>{{ $order->employee->user->name }}</td>
                    @endif
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4 col-md-offset-4 mt">
            <a href="/pizzzzza/order/history" class="btn btn-default btn-lg btn-block">戻る</a>
        </div>
    </div>
@endsection
