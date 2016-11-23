@extends('template/master')

@section('title', 'トップ')

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
    <?php  if(!isset($class)){$class = "";}  ?>



    <div class="container wrap">
        <div class="fonts"><h2>会員情報更新確認</h2></div>
        <div class="register">
            <table id="table">
                <tr><th>名前</th><td class="{{ $class }}"></td></tr>
                <tr><th>フリガナ</th><td class="{{ $class }}"></td></tr>
                <tr><th>郵便番号</th><td class="{{ $class }}"></td></tr>
                <tr><th>住所１</th><td class="{{ $class }}"></td></tr>
                <tr><th>住所２</th><td class="{{ $class }}"></td></tr>
                <tr><th>住所３</th><td class="{{ $class }}"></td></tr>
                <tr><th>生年月日</th><td class="{{ $class }}"></td></tr>
                <tr><th>電話番号</th><td class="{{ $class }}"></td></tr>
                <tr><th>性別</th><td class="{{ $class }}"></td></tr>
                <tr><th>メールアドレス</th><td class="{{ $class }}"></td></tr>
                <tr><th>パスワード</th><td class="{{ $class }}">**********</td></tr>
            </table>
            <form class="submit" action="#" method="post">  {{-- 送信先は、処理URL。--}}
                <a class="form-bottom" href="#">編集</a>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(window).load(function() {
            $('.flexslider').flexslider({
                animation: "slide"
            });
        });
    </script>
@endsection
