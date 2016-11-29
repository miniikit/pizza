@extends('template/admin')

@section('title', '従業員管理画面')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order/top">ホーム</a></li>
        @if(is_null($product->deleted_at))
            <li><a href="/pizzzzza/menu">商品一覧</a></li>
        @else
            <li><a href="/pizzzzza/menu/history">商品履歴一覧</a></li>
        @endif
        <li class="active">{{$product->product_name}}</li>
    </ol>
@endsection

@section('main')
    <h1>商品詳細</h1>
    <div class="row">
        <div class="col-md-7">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="text-center" style="width:15%">名前</th>
                    <td>{{ $product->product_name }}</td>
                </tr>
                <tr>
                    <th class="text-center">画像</th>
                    <td><img src="{{ $product->product_image }}" alt=""></td>
                </tr>
                <tr>
                    <th class="text-center">内容</th>
                    <td>{{ $product->product_text }}</td>
                </tr>
                <tr>
                    <th class="text-center">ジャンル</th>
                    <td>{{ $product->genre->genre_name }}</td>
                </tr>
                <tr>
                    <th class="text-center">金額</th>
                    <td>{{ number_format($product->productPrice->product_price) }}円</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-5">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="text-center">販売開始日</th>
                    <td>{{ $product->sales_start_date }}</td>
                </tr>
                <tr>
                    <th class="text-center">販売終了日</th>
                    <td>
                        @if ($product->sales_end_date == null)
                            未設定
                        @else
                            {{ $product->sales_end_date }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="text-center">登録日</th>
                    <td>{{ $product->created_at }}</td>
                </tr>
                <tr>
                    <th class="text-center">更新日</th>
                    <td>{{ $product->updated_at }}</td>
                </tr>
                </tbody>
            </table>
            <form class="ar" action="/pizzzzza/menu/{{$product->id}}/delete" method="post">
                <a href="/pizzzzza/menu/{{$product->id}}/edit" class="btn btn-default btn-sm">編集</a>
                @if (is_null($product->deleted_at))
                    <input class="btn btn-danger btn-sm ml" type="submit" name="delete" value="削除">
                @endif
                {{ csrf_field() }}
            </form>
        </div>
        <div class="col-md-4 col-md-offset-4 mt">
            <a href="/pizzzzza/menu" class="btn btn-default btn-lg btn-block">戻る</a>
        </div>
    </div>
@endsection
