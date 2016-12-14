@extends('template/admin')

@section('title', 'クーポン詳細')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/menu/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order">ホーム</a></li>
        @if(is_null($coupon->deleted_at))
            <li><a href="/pizzzzza/coupon">クーポン一覧</a></li>
        @else
            <li><a href="/pizzzzza/coupon">クーポン履歴</a></li>
        @endif
        <li class="active">クーポン詳細</li>
    </ol>
@endsection

@section('main')
    <h1>クーポン詳細</h1>
    <div class="row">
        <div class="col-md-7">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="text-center">クーポン名</th>
                    <td>{{ $coupon->coupon_name }}</td>
                </tr>
                <tr>
                    <th class="text-center">クーポン番号</th>
                    <td>{{ $coupon->coupon_number }}</td>
                </tr>
                <tr>
                    @if($coupon->coupons_types_id == 2)
                        <th class="text-center">プレゼント商品名</th>
                        @if(isset($product))
                            <td>{{ $product->product_name }}</td>
                        @else
                            <td> なし </td>
                        @endif
                    @else
                        <th class="text-center">値引額</th>
                        <td>{{ $coupon->coupon_discount }}</td>
                    @endif
                </tr>
                <tr>
                    <th class="text-center">利用上限回数</th>
                    <td>{{ $coupon->coupon_conditions_count }}</td>
                </tr>
                <tr>
                    <th class="text-center">利用条件金額</th>
                    <td>{{ $coupon->coupon_conditions_money }}</td>
                </tr>
                <tr>
                    <th class="text-center">対象者</th>
                    @if($coupon->coupon_conditions_first == 1)
                        <td>当店初回利用者限定</td>
                    @else
                        <td>全員</td>
                    @endif
                </tr>
                <tr>
                    <th class="text-center">クーポン種別</th>
                    <td>{{ $coupon->coupon_type}}</td>
                </tr>
                @if($coupon->coupons_types_id ==1)
                    <tr>
                        <th class="text-center">使用条件商品</th>
                        @if(isset($coupon->product_id))
                            <td>{{ $product->product_name }}</td>
                        @else
                            <td>なし</td>
                        @endif
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        <div class="col-md-5">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="text-center">開始日</th>
                    <td>{{ $coupon->coupon_start_date }}</td>
                </tr>
                <tr>
                    <th class="text-center">終了日</th>
                    <td>{{ $coupon->coupon_end_date }}</td>
                </tr>
                <tr>
                    <th class="text-center">登録日時</th>
                    <td>{{ $coupon->created_at }}</td>
                </tr>
                <tr>
                    <th class="text-center">更新日時</th>
                    <td>{{ $coupon->updated_at }}</td>
                </tr>
                </tbody>
            </table>

            <div class="ar">
                <a href="/pizzzzza/coupon/{{$id}}/edit" class="btn btn-default btn-sm ar">編集</a>
                <a href="/pizzzzza/coupon/{{$id}}/delete" class="btn btn-danger btn-sm ml">削除</a>
            </div>


        </div>
        <div class="col-md-4 col-md-offset-4 mt">
            <a href="/pizzzzza/coupon" class="btn btn-default btn-lg btn-block">戻る</a>
        </div>
    </div>
@endsection
