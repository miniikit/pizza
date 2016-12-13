@extends('template/admin')

@section('title', 'メニュー一覧')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/menu/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order">ホーム</a></li>
        <li class="active">注文履歴</li>
    </ol>
@endsection

@section('main')
    <h1>注文履歴</h1>

    <div class="form-group table-responsive">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="text-align: center;">注文日</th>
                <th style="text-align: center;">氏名</th>
                <th style="text-align: center;">お届け先</th>
                <th style="text-align: center;">電話番号</th>
                <th style="text-align: center;">担当者</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($orders as $order)
                <tr class="link" data-href="/pizzzzza/order/{{ $order->id }}/show">
                    <td style="text-align: center;">{{ \Carbon\Carbon::parse( $order->order_date )->format('Y年m月d日 H時i分') }}</td>
                    <td style="text-align: center;">{{ $order->user->name }}</td>
                    <td style="text-align: center;">{{ $order->user->address1.$order->user->address2.$order->user->address3 }}</td>
                    <td style="text-align: center;">{{ $order->user->phone }}</td>
                    @if(is_null($order->employee))
                        <td style="text-align: center;">Web注文</td>
                    @else
                        <td style="text-align: center;">{{ $order->employee->user->name }}</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
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
