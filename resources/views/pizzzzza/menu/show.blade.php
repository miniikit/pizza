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
                    <th class="text-center">名前</th>
                    <td>{{ $product->product_name }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-5">
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <th class="text-center">従業員ID</th>
                    <td>{{ $product->productPrice->id }}</td>
                </tr>
                </tbody>
            </table>
            {{--<form class="ar" action="/pizzzzza/employee/{{$employee->id}}/delete" method="post">--}}
                {{--<a href="/pizzzzza/employee/{{$employee->id}}/edit" class="btn btn-default btn-sm">編集</a>--}}
                {{--@if ($employee->user->authority_id != 1 && is_null($employee->deleted_at))--}}
                    {{--<input class="btn btn-danger btn-sm ml" type="submit" name="delete" value="削除">--}}
                {{--@endif--}}
                {{--{{ csrf_field() }}--}}
            {{--</form>--}}
        </div>
        <div class="col-md-4 col-md-offset-4 mt">
            <a href="/pizzzzza/employee" class="btn btn-default btn-lg btn-block">戻る</a>
        </div>
    </div>
@endsection
