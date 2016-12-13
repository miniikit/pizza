@extends('template/admin')

@section('title', '従業員管理画面')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order">ホーム</a></li>
        @if(is_null($order->deleted_at))
            <li><a href="/pizzzzza/order">商品一覧</a></li>
        @else
            <li><a href="/pizzzzza/order//history">商品履歴</a></li>
        @endif
        <li class="active">{{$order->product_name}}</li>
    </ol>
@endsection

@section('main')
    <h1>商品詳細</h1>
    <div class="row">
        <div class="col-md-7">
            <table class="table table-bordered">
                <tbody>
                <tr>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-5">
            <table class="table table-bordered">
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="col-md-4 col-md-offset-4 mt">
            <a href="/pizzzzza/menu" class="btn btn-default btn-lg btn-block">戻る</a>
        </div>
    </div>
@endsection
