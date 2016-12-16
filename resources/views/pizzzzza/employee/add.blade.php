@extends('template/admin')

@section('title', '従業員追加')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
<ol class="breadcrumb">
<li><a href="/pizzzzza/order">ホーム</a></li>
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
            <form action="/pizzzzza/employee/store" method="post">
                <table class="table table-bordered ">
                    <tbody>
                    <tr>
                        <th class="text-center" >名前</th>
                        <td><input class="form-control" type="text" name="name" value="" placeholder="例）山田太郎"></td>
                    </tr>
                    <tr>
                        <th class="text-center" >フリガナ</th>
                        <td><input class="form-control" type="text" name="kana" value="" placeholder="例）ヤマダタロウ"></td>
                    </tr>
                    <tr>
                        <th class="text-center" >生年月日</th>
                        <td><input class="form-control" type="date" name="birthday" value="1990-01-01" ></td>
                    </tr>
                    <tr>
                        <th class="text-center" >性別</th>
                        <td><input class="" type="radio" name="gender_id" value="1" checked > 男 <input class="" type="radio" name="gender_id" value="2"> 女 </td>
                    </tr>
                    <tr>
                        <th class="text-center" >郵便番号</th>
                        <td><input class="form-control" type="text" name="postal" value="" placeholder="ハイフン抜き"></td>
                    </tr>
                    <tr>
                        <th class="text-center" >住所</th>
                        <td><input class="form-control" type="text" name="address1" value="" placeholder="例）大阪府大阪市天王寺区"></td>
                    </tr>
                    <tr>
                        <th class="text-center" >番地</th>
                        <td><input class="form-control" type="text" name="address2" value="" placeholder="例）１−１−１"></td>
                    </tr>
                    <tr>
                        <th class="text-center" >建物名</th>
                        <td><input class="form-control" type="text" name="address3" value="" placeholder="例）東マンション　５０２号室"></td>
                    </tr>
                    <tr>
                        <th class="text-center" >電話番号</th>
                        <td><input class="form-control" type="text" name="phone" value="" placeholder="例）08012345678"></td>
                    </tr>
                    <tr>
                        <th class="text-center" >メールアドレス</th>
                        <td><input class="form-control" type="text" name="email" value="" placeholder="例）example@example.com" ></td>
                    </tr>
                    <tr>
                        <th class="text-center" >パスワード</th>
                        <td><input class="form-control" id="example-date-input" type="password" name="password" value="" placeholder="※英小文字・英大文字・数字を「各１つ以上」ご使用ください" ></td>
                    </tr>
                    <tr>
                        <th class="text-center" >パスワード(確認)</th>
                        <td><input class="form-control" id="example-date-input" type="password" name="password_confirm" value="" placeholder="確認用"></td>
                    </tr>
                    </tbody>
                </table>
                <div class="col-md-4 col-md-offset-4 ac">
                    <a class="btn btn-default btn-lg mr" href="/pizzzzza/employee" >戻る</a>
                    <input type="submit" class="btn btn-primary btn-lg" name="store" value="追加">
                </div>
                {{ csrf_field() }}
            </form>
@endsection
