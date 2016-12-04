@extends('template/admin')

@section('title', 'クーポン新規発行')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order/top">ホーム</a></li>
        <li class="active">クーポン</li>
    </ol>
@endsection

@section('main')
    <h1>クーポン新規発券</h1>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/pizzzzza/employee/store" method="post">
        <table class="table table-bordered ">
            <tbody>
            <tr>
                <th class="text-center">クーポン名</th>
                <td><input class="form-control" type="text" name="name" value="" placeholder="冬限定５００円OFFクーポン"></td>
            </tr>
            <tr>
                <th class="text-center">クーポン番号</th>
                <td><input class="form-control" type="text" name="kana" value="" placeholder="GREAT-WINTER2016"></td>
            </tr>
            <tr>
                <th class="text-center">値引き額</th>
                <td><input class="form-control" type="number" name="birthday" value="" placeholder="500"></td>
            </tr>
            <tr>
                <th class="text-center">利用開始日</th>
                <td><input class="form-control" type="date" name="gender_id" value="1" checked>
                </td>
            </tr>
            <tr>
                <th class="text-center">利用終了日</th>
                <td><input class="form-control" type="date" name="postal" value="" placeholder="ハイフン抜き"></td>
            </tr>
            <tr>
                <th class="text-center">対象者</th>
                <td><select class="form-control" name="coupon_conditions_first" id="">
                        <option value="0" checked>全員</option>
                        <option value="1">当店初回利用者限定</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th class="text-center">利用上限回数</th>
                <td><input class="form-control" type="number" name="address3" value="" placeholder="１人あたりの使用上限回数を指定します">
                </td>
            </tr>
            <tr>
                <th class="text-center">利用条件金額</th>
                <td><input class="form-control" type="number" name="address2" value=""
                           placeholder="カート内合計金額により使用可否を指定します"></td>
            </tr>
            <tr>
                <th class="text-center">利用条件商品</th>
                <td><input class="form-control" type="text" name="phone" value="" placeholder="カート内にこの商品が必要です"></td>
            </tr>
            </tbody>
        </table>
        <div class="col-md-4 col-md-offset-4 ac">
            <a class="btn btn-default btn-lg mr" href="/pizzzzza/employee">戻る</a>
            <input type="submit" class="btn btn-primary btn-lg" name="store" value="追加">
        </div>
        {{ csrf_field() }}
    </form>
@endsection