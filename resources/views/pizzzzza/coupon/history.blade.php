@extends('template/admin')

@section('title', 'クーポン履歴')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order/top">ホーム</a></li>
        <li class="active">クーポン履歴</li>
    </ol>
@endsection

@section('main')
    <h1>クーポン履歴</h1>
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">クーポン名</th>
                <th class="text-center">開始日</th>
                <th class="text-center">終了日</th>
                <th class="text-center">登録日時</th>
                <th class="text-center">更新日時</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($coupons as $coupon)
                <tr class="link" data-href="/pizzzzza/coupon/{{ $coupon->id }}/show">
                    <td class="number text-center">{{ $coupon->id }}</td>
                    <td class="name text-center">{{ $coupon->coupon_name }}</td>
                    <td class="date text-center">{{ $coupon->coupon_start_date }}</td>
                    <td class="date text-center">{{ $coupon->coupon_end_date }}</td>
                    <td class="date text-center">{{ $coupon->created_at }}</td>
                    <td class="date text-center">{{ $coupon->updated_at }}</td>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
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