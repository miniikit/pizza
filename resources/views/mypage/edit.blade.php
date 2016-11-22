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
    <div class="container wrap">
        <div class="fonts"><h2>会員情報確認</h2></div>
        <div class="register">
            <table id="table">
                @foreach($users as $user)
                    {{-- 郵便番号にハイフンを合体。いっそ関数にしても？ --}}
                    <?php
                    $zip = $user->postal;
                    $postal = substr($zip, 0, 3).'-'.substr($zip, 3);
                    $gender = "男";
                    ?>
                    @if($user->gender_id == 2)
                        $gender = 女
                    @endif
                    <tr><th>名前</th><td><input type="text" size="20" maxlength="50" value="{{ $user->name }}"></td></tr>
                    <tr><th>フリガナ</th><td><input type="text" size="20" maxlength="50" value="{{ $user->kana }}"></td></tr>
                    <tr><th>郵便番号</th><td>〒<input type="text" size="20" maxlength="7" value="{{ $postal }}"></td></tr>
                    <tr><th>住所１</th><td><input type="text" size="40" maxlength="50" value="{{ $user->address1 }}"></td></tr>
                    <tr><th>住所２</th><td><input type="text" size="20" maxlength="30" value="{{ $user->address2 }} {{ $user->address3 }}"></td></tr>
                    <tr><th>生年月日</th><td><input type="date" size="20" maxlength="50" value="{{ date('Y年 n月 j日', strtotime($user->birthday)) }}"></td></tr>
                    <tr><th>電話番号</th><td><input type="tel" size="20" maxlength="11" value="{{ $user->phone }}"></td></tr>
                    <tr><th>性別</th><td><input type="radio" size="20" maxlength="50" value="{{ $gender }}"></td></tr>
                    <tr><th>メールアドレス</th><td><input type="email" size="20" maxlength="50" value="{{ $user->email }}"></td></tr>
                    <tr><th>パスワード</th><td>**********</td></tr>
                    <tr><th>新しいパスワード</th><td><input type="password" size="20"  value=""></td></tr>
                    <tr><th>新しいパスワード</th><td><input type="password" size="20"  value=""></td></tr>
                @endforeach
            </table>
            <form class="submit" action="/mypage/edit" method="post">
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
