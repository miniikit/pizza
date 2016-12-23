@extends('template.admin')

@section('title', 'お客様情報確認')

@section('css')
    <link rel="stylesheet" href="/css/accept/index.css" media="all" title="no title">
    <link rel="stylesheet" href="/css/pizzzzza/phone/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order">ホーム</a></li>
        <li class="active"><a href="/pizzzzza/order/accept/input">電話注文</a></li>
        <li class="active">お客様情報確認</li>
    </ol>
@endsection

@section('main')
    <div class="wrap">
        <h1>お客様情報確認</h1>
        <div class="row">
            <form action="/pizzzzza/order/accept/customer/handler" method="post">
                @if(isset($orderCount))
                    <div class="col-md-7">
                        @else
                            <div class="col-md-12">
                                @endif
                                @if (count($errors) > 0)
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger">{{ $error }}</div>
                                    @endforeach
                                @endif
                                <div class="form-group table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <th class="text-center">登録日</th>
                                            <td>{{ $user->created_at }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">名前(漢字)</th>
                                            <td>{{ $user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">名前(カナ)</th>
                                            <td>{{ $user->kana }}</td>
                                        </tr>
                                        @if(isset($user->birthday) || isset($user->gender_id))
                                            <tr>
                                                <th class="text-center">生年月日</th>
                                                <td>{{ $user->birthday }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-center">性別</th>
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
                                            <th class="text-center">郵便番号</th>
                                            <td>{{ $user->postal }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">住所</th>
                                            <td>{{ $user->address1 }} {{ $user->address2 }} {{ $user->address3 }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">電話番号</th>
                                            <td>{{ $user->phone }}</td>
                                        </tr>
                                        @if(isset($user->email))
                                            <tr>
                                                <th class="text-center">メールアドレス</th>
                                                <td>{{ $user->email }}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <input type="hidden" name="customer_id" value="{{ $user->id }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </div>{{-- col-md-12の終わりタグ --}}
                            @if(isset($orderCount))
                                <div class="col-md-5">

                                    <table class="table table-bordered">
                                        <tr>
                                            <th>累計注文金額</th>
                                            <td>{{ number_format($orderTotal) }}円</td>
                                        </tr>
                                        <tr>
                                            <th>累計注文回数</th>
                                            <td>{{ $orderCount }}回</td>
                                        </tr>
                                        <tr>
                                            <th>平均注文金額</th>
                                            <td>{{ number_format($orderAvg) }}円</td>
                                        </tr>
                                        <tr>
                                            <th>累計クーポン使用金額</th>
                                            @if(isset($orderCouponTotal))
                                                <td>{{ number_format($orderCouponTotal) }}円</td>
                                            @endif
                                        </tr>
                                    </table>
                                    <div class="text-right">
                                        <a href="/pizzzzza/order/accept/customer/{{ $id }}/edit"
                                           class="btn btn-default btn-sm">編集</a>
                                    </div>
                                </div>
                    </div>{{-- col-md-7の終わりタグ --}}
                @endif
                <div class="text-center">
                    <input type="submit" class="btn btn-default btn-lg mr" name="detailPost" value="戻る">
                    <input type="submit" class="btn btn-primary btn-lg ml" name="detailPost"
                           value="注文へ">
                </div>
            </form>
            @if(isset($orderCount))
                <div id="status" class="mt-b">
                    <h1>注文履歴</h1>
                    <table class="table table-bordered">
                        <tr>
                            <th>注文ID</th>
                            <th>注文日時</th>
                            <th>配達日時</th>
                            <th>注文状況</th>
                        </tr>
                        @foreach($orders as $order)
                            <tr class="link" data-href="/pizzzzza/order/{{ $order->id }}/show">
                                <td>{{ $order->id }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->order_date)->format('Y年m月d日 H時i分') }}</td>
                                <td>{{ \Carbon\Carbon::parse($order->order_appointment_date)->format('Y年m月d日 H時i分') }}</td>
                                <td>{{ $order->state_name }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endif
        </div>
@endsection

@section('script')
            <script type="text/javascript">
                $('.table tr[data-href]').addClass('clickable').click(function () {
                    window.location = $(this).attr('data-href');
                }).find('a').hover(function () {
                    $(this).parents('tr').unbind('click');
                }, function () {
                    $(this).parents('tr').click(function () {
                        window.location = $(this).attr('data-href');
                    });
                });
            </script>
@endsection