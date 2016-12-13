@extends('template.admin')

@section('title', 'お届け先情報登録')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order">ホーム</a></li>
        <li><a href="/pizzzzza/order/accept/input">電話注文受付</a></li>
        <li class="active">お届け先情報登録</li>
    </ol>
@endsection

@section('main')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
        </div>
    @endif
    <h1>お届け先情報登録</h1>
    <form action="/pizzzzza/order/accept/customer/input/add" method="post">
        <table class="table table-bordered ">
            <tbody>
            <tr>
                <th class="text-center">氏名</th>
                <td><input class="form-control" type="text" name="name" value="" placeholder="例）山田太郎"></td>
            </tr>
            <tr>
                <th class="text-center">フリガナ</th>
                <td><input class="form-control" type="text" name="kana" value="" placeholder="例）ヤマダタロウ"></td>
            </tr>
            <tr>
                <th class="text-center">郵便番号</th>
                <td><input class="form-control" type="number" name="postal" value="" placeholder="ハイフン抜き"></td>
            </tr>
            <tr>
                <th class="text-center">住所</th>
                <td><input class="form-control" type="text" name="address1" value="" placeholder="例）大阪府大阪市天王寺区"></td>
            </tr>
            <tr>
                <th class="text-center">番地</th>
                <td><input class="form-control" type="text" name="address2" value="" placeholder="例）１−１−１"></td>
            </tr>
            <tr>
                <th class="text-center">建物名</th>
                <td><input class="form-control" type="text" name="address3" value="" placeholder="例）東マンション　５０２号室"></td>
            </tr>
            <tr>
                <th class="text-center">電話番号</th>
                <td><input class="form-control" type="number" name="phone" value="" placeholder="例）08012345678"></td>
            </tr>
            </tbody>
        </table>
        <div class="col-md-4 col-md-offset-4 ac">
            <a class="btn btn-default btn-lg mr" href="/pizzzzza/order/accept/input">戻る</a>
            <input type="submit" class="btn btn-primary btn-lg" name="store" value="登録">
        </div>
        {{ csrf_field() }}
    </form>
@endsection