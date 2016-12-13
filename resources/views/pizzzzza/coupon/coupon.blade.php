@extends('template.admin')

@section('title', 'Coupon')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/coupon/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order">ホーム</a></li>
        <li class="active">開催中クーポン一覧</li>
    </ol>
@endsection

@section('main')
    <h1>開催中クーポン一覧</h1>

    <div class="row">
        <table class="table" >
            <thead>
            <tr>
                <th class="text">ID</th>
                <th class="text">クーポン名</th>
                <th class="text">開始日</th>
                <th class="text">終了日</th>
                <th class="text">登録日時</th>
                <th class="text">更新日時</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($coupons as $coupon)
                <tr class="link" data-href="/pizzzzza/coupon/{{ $coupon->id }}/show">
                    <td class="number">{{ $coupon->id }}</td>
                    <td class="name">{{ $coupon->coupon_name }}</td>
                    <td class="date">{{ $coupon->coupon_start_date }}</td>
                    <td class="date">{{ $coupon->coupon_end_date }}</td>
                    <td class="date">{{ $coupon->created_at }}</td>
                    <td class="date">{{ $coupon->updated_at }}</td>
                    </td>
                </tr>
                @endforeach
                </form>
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
