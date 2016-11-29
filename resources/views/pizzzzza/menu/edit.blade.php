@extends('template/admin')

@section('title', 'メニュー編集')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/menu/index.css" media="all" title="no title">
    <link href="/plug/featherlight/featherlight.css" title="Featherlight Styles" rel="stylesheet"/>
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order/top">ホーム</a></li>
        @if(is_null($product->deleted_at))
            <li><a href="/pizzzzza/menu">商品一覧</a></li>
        @else
            <li><a href="/pizzzzza/menu/history">商品履歴一覧</a></li>
        @endif
        <li><a href="/pizzzzza/menu/{{$product->id}}/show">{{$product->product_name}}</a></li>
        <li class="active">編集</li>
    </ol>
@endsection

@section('main')
    <h1>商品編集</h1>
    <form action="/pizzzzza/menu/{{ $product->id }}/update" method="post">
        <div class="row">
            <div class="col-md-7">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th class="text-center" style="width:15%">名前</th>
                        <td><input class="form-control" type="text" value="{{ $product->product_name }}"></td>
                    </tr>
                    <tr>
                        <th class="text-center">画像</th>
                        <td><img src="{{ $product->product_image }}" alt=""></td>
                    </tr>
                    <tr>
                        <th class="text-center">内容</th>
                        <td><textarea class="form-control" rows="5" >{{ $product->product_text }}</textarea></td>
                    </tr>
                    <tr>
                        <th class="text-center">ジャンル</th>
                        <td>
                            <select name="language">
                                <option value="{{ $product->genre->id }}" selected>{{ $product->genre->genre_name }}</option>
                                ----
                                <option value="1">ピザ</option>
                                <option value="2">サイド</option>
                                <option value="3">ドリンク</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th class="text-center">金額</th>
                        <td><input class="form-control" type="text" value="{{ $product->productPrice->product_price }}"></td>
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
                        <td><input class="form-control" type="date" value="{{$product->sales_end_date }}"></td>
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
            </div>
            <div class="col-md-4 col-md-offset-4 ac">
                <a class="btn btn-default btn-lg mr" href="/pizzzzza/menu">戻る</a>
                <input type="submit" class="btn btn-primary btn-lg" name="update" value="更新">
            </div>
        </div>
        {{ csrf_field() }}
    </form>

@endsection