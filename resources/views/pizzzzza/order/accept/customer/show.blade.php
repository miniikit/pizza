@extends('template.admin')

@section('title', 'お届け先情報確認')

@section('css')
    <link rel="stylesheet" href="/css/accept/index.css" media="all" title="no title">
    <link rel="stylesheet" href="/css/pizzzzza/phone/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order">ホーム</a></li>
        <li class="active"><a href="/pizzzzza/order/accept/input">電話注文受付</a></li>
        <li class="active">お届け先情報確認</li>
    </ol>
@endsection

@section('main')
    <div class="wrap">
        <h1>お届け先情報確認</h1>

        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
        <div class="form-group table-responsive">
            <form action="/pizzzzza/order/accept/customer/handler" method="post">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th class="text-center"><label for="">登録日</label></th>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">名前(漢字)</label></th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">名前(カナ)</label></th>
                        <td>{{ $user->kana }}</td>
                    </tr>
                    @if(isset($user->birthday) || isset($user->gender_id))
                        <tr>
                            <th class="text-center"><label for="">生年月日</label></th>
                            <td>{{ $user->birthday }}</td>
                        </tr>
                        <tr>
                            <th class="text-center"><label for="">性別</label></th>
                            @if($user->gender_id == 1)
                                <td>男</td>
                            @elseif($user->gender_id == 2)
                                <td>女</td>
                            @else
                                <td>その他</td>
                            @endif
                        </tr>
                    @endif
                    <tr>
                        <th class="text-center"><label for="">郵便番号</label></th>
                        <td>{{ $user->postal }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">住所1</label></th>
                        <td>{{ $user->address1 }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">住所2</label></th>
                        <td>{{ $user->address2 }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">住所3</label></th>
                        <td>{{ $user->address3 }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">電話番号</label></th>
                        <td>{{ $user->phone }}</td>
                    </tr>
                    @if(isset($user->email))
                        <tr>
                            <th class="text-center"><label for="">メールアドレス</label></th>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div class="text-center">
                    <input type="submit" class="btn btn-default btn-lg mr" name="detailPost" value="戻る">
                    <input type="submit" class="btn btn-primary btn-lg ml" name="detailPost" value="注文へ">
                </div>
                <div class="text-right">
                    <input type="submit" class="btn btn-primary btn-lg" name="detailPost" value="編集">
                </div>
                <input type="hidden" name="customer_id" value="{{ $user->id }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </div>

        <div id="status">
            @if(isset($orderCount))
                <h1>統計情報</h1>
                <table class="table table-bordered">
                    <tr>
                        <th>累計注文金額</th>
                        <th>累計注文回数</th>
                        <th>平均注文金額</th>
                        <th>累計クーポン使用金額</th>
                    </tr>
                    <tr>
                        <td>¥ {{ number_format($orderTotal) }}</td>
                        <td>{{ $orderCount }}</td>
                        <td>¥ {{ number_format($orderAvg) }}</td>
                        @if(isset($orderCouponTotal))
                            <td>¥ {{ number_format($orderCouponTotal) }}</td>
                        @endif
                    </tr>
                </table>

                <h1>注文履歴</h1>
                <table class="table table-bordered">
                    <tr>
                        <th>件</th>
                        <th>注文日時</th>
                        <th>配達日時</th>
                        <th>注文状況</th>
                        <th>商品名</th>
                        <th>個数</th>
                        <th>注文金額</th>
                    </tr>
                    @foreach($orders as $order)
                        <tr>
                            {{--  どこまでが１件の注文かを、まとめる処理。  --}}
                            @if(!isset($order_id))
                                <?php // 最初だけ実行
                                    $order_id = 1;
                                    $order_date = $order->order_date;
                                ?>
                            @endif
                            <td><?php // 注文日時が違えば実行
                                    if($order->order_date != $order_date){
                                        $order_id += 1;
                                    }
                                    // 毎回実行
                                    echo $order_id;
                                    $order_date = $order->order_date;
                                ?>
                            </td>
                            {{--  ここまで　どこまでが１件の注文かをまとめる処理  --}}
                            <td>{{ \Carbon\Carbon::parse($order->order_date)->format('Y年m月d日 H時i分') }}</td>
                            <td>{{ \Carbon\Carbon::parse($order->order_appointment_date)->format('Y年m月d日 H時i分') }}</td>
                            <td>{{ $order->state_name }}</td>
                            <td>{{ $order->product_name }}</td>
                            <td>{{ $order->number }}</td>
                            <td>¥ {{ number_format($order->product_price * $order->number) }}</td>
                        </tr>
                    @endforeach
                </table>
            @else
                <h1>注文履歴がありませんでした</h1>
            @endif
        </div>
    </div>
@endsection
