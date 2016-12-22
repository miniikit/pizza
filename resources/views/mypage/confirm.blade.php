@extends('template/master')

@section('title', '会員情報更新確認')

@section('css')
    <link rel="stylesheet" href="/css/index/index.css" media="all" title="no title">
    <link rel="stylesheet" href="/css/mypage/detail.css" media="all" title="no title">
@endsection

@section('plug')
    <script src="/plug/flexSlier/jquery.flexslider-min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="/plug/flexSlier/flexslider.css" media="screen" title="no title">
@endsection
@section('main')
    {{-- クラスが設定されていなければ設定する--}}

    <div class="container wrap">
        <div class="fonts"><h2>会員情報更新確認</h2></div>

        <div class="register">
            <form class="submit" action="/mypage/update" method="post">  {{-- 送信先は、処理URL。--}}
                <table id="table">
                    <tr>
                        <th>名前</th>
                        <td class="{{ $class["name"] }}">{{ $user["name"] }}</td>
                    </tr>
                    <tr>
                        <th>フリガナ</th>
                        <td class="{{ $class["name_katakana"] }}">{{ $user["name_katakana"] }}</td>
                    </tr>
                    <tr>
                        <th>郵便番号</th>
                        <td class="{{ $class["postal"] }}">{{ $user["postal"] }}</td>
                    </tr>
                    <tr>
                        <th>住所</th>
                        <td class="{{ $class["address1"] }}">{{ $user["address1"] }}</td>
                    </tr>
                    <tr>
                        <th>番地</th>
                        <td class="{{ $class["address2"] }}">{{ $user["address2"] }}</td>
                    </tr>
                    <tr>
                        <th>建物名</th>
                        <td class="{{ $class["address3"] }}">{{ $user["address3"] }}</td>
                    </tr>
                    <tr>
                        <th>生年月日</th>
                        <td class="{{ $class["birthday"] }}">{{ $user["birthday"] }}</td>
                    </tr>
                    <tr>
                        <th>電話番号</th>
                        <td class="{{ $class["phone"] }}">{{ $user["phone"] }}</td>
                    </tr>
                    <tr>
                        <th>性別</th>
                        <td class="{{ $class["gender"] }}">{{ $user["gender"] }}</td>
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td class="{{ $class["email"] }}">{{ $user["email"] }}</td>
                    </tr>
                    <tr>
                        <th>新しいパスワード</th>
                        <td class="{{ $class["new_password"] }}">{{ $user["new_password"] }}</td>
                    </tr>
                </table>
                <a href="/mypage/edit">戻る</a>
                <a class="form-bottom" href="#">更新</a>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(window).load(function () {
            $('.flexslider').flexslider({
                animation: "slide"
            });
        });
    </script>
@endsection
