@extends('template/admin')

@section('title', '従業員追加画面')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
<ol class="breadcrumb">
<li><a href="/pizzzzza/order/top">ホーム</a></li>
<li class="active">従業員追加</li>
</ol>
@endsection

@section('main')
        <h1>従業員追加</h1>
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
        @endif
            <form action="/pizzzzza/employee/add/store" method="post">
                <table class="table table-bordered ">
                    <tbody>
                    <tr>
                        <th class="text-center" >氏名</th>
                        <td><input class="form-control" type="text" name="name" value=""></td>
                    </tr>
                    <tr>
                        <th class="text-center" >フリガナ</th>
                        <td><input class="form-control" type="text" name="kana" value=""></td>
                    </tr>
                    <tr>
                        <th class="text-center" >生年月日</th>
                        <td><input class="form-control" type="date" name="birthday" value="" ></td>
                    </tr>
                    <tr>
                        <th class="text-center" >性別</th>
                        <td><input class="" type="radio" name="gender_id" value="1"> 男 <input class="" type="radio" name="gender_id" value="2"> 女 </td>
                    </tr>
                    <tr>
                        <th class="text-center" >郵便番号</th>
                        <td><input class="form-control" type="text" name="postal" value="" ></td>
                    </tr>
                    <tr>
                        <th class="text-center" >住所</th>
                        <td><input class="form-control" type="text" name="address1" value="" ></td>
                    </tr>
                    <tr>
                        <th class="text-center" >番地</th>
                        <td><input class="form-control" type="text" name="address2" value="" ></td>
                    </tr>
                    <tr>
                        <th class="text-center" >建物名</th>
                        <td><input class="form-control" type="text" name="address3" value="" ></td>
                    </tr>
                    <tr>
                        <th class="text-center" >電話番号</th>
                        <td><input class="form-control" type="text" name="phone" value="" ></td>
                    </tr>
                    <tr>
                        <th class="text-center" >メールアドレス</th>
                        <td><input class="form-control" type="text" name="email" value="" ></td>
                    </tr>
                    <tr>
                        <th class="text-center" >パスワード</th>
                        <td><input class="form-control" id="example-date-input" type="password" name="password" value="" ></td>
                    </tr>
                    <tr>
                        <th class="text-center" >パスワード(確認)</th>
                        <td><input class="form-control" id="example-date-input" type="password" name="password_confirm" value="" ></td>
                    </tr>
                    </tbody>
                </table>
                <div class="col-md-4 col-md-offset-4 ac">
                    <a class="btn btn-default btn-lg">戻る</a>
                    <input type="submit" class="btn btn-primary btn-lg" name="store" value="追加">
                </div>
                {{ csrf_field() }}
            </form>
@endsection
