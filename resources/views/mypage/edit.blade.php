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
                    ?>
                    <tr><th>名前</th><td><input type="text" size="20" maxlength="50" value="{{ $user->name }}"></td><td>（例）大阪太郎</td></tr>
                    <tr><th>フリガナ</th><td><input type="text" size="20" maxlength="50" value="{{ $user->kana }}"></td><td>（例）オオサカタロウ</td></tr>
                    <tr><th>郵便番号</th><td>〒 <input type="text" placeholder="123456" size="7" maxlength="7" value="{{ $user->postal }}"></td><td>（例）123456</td></tr>
                    <tr><th>住所１</th><td><input type="text" placeholder="大阪府大阪市天王寺区" size="40" maxlength="50" value="{{ $user->address1 }}"></td><td>（例）大阪府大阪市天王寺区</td></tr>
                    <tr><th>住所２</th><td><input type="text" placeholder="１−１−１" size="40" maxlength="50" value="{{ $user->address2 }}"></td><td>番地</td></tr>
                    <tr><th>住所３</th><td><input type="text" placeholder="マンション５０２" size="40" maxlength="50" value="{{ $user->address3 }}"></td><td>建物名</td></tr>
                    <tr><th>生年月日</th><td><input type="date" size="20" maxlength="50" value="{{ date('Y-0n-0j', strtotime($user->birthday)) }}"></td><td></td></tr>
                    <tr><th>電話番号</th><td><input type="tel" placeholder="08012345678" size="20" maxlength="11" value="{{ $user->phone }}"></td><td>ハイフンなし</td></tr>
                    <tr><th>性別</th><td><input type="radio" name="gender" value="男" <?if($user->gender_id === 1){echo "checked";}?>>男 <input type="radio" name="gender" value="女" <?if($user->gender_id === 2){echo "checked";}?>>女</td><td></td></tr>
                    <tr><th>メールアドレス</th><td><input type="email" size="20" maxlength="50" value="{{ $user->email }}"></td><td>aaa@yahoo.co.jp</td></tr>
                    <tr><th>新しいパスワード</th><td><input type="password" placeholder="任意" size="20" value=""></td><td>パスワード変更</td></tr>
                    <tr><th>新しいパスワード</th><td><input type="password" placeholder="確認" size="20" value=""></td><td>パスワード変更確認用</td></tr>
                    <div class = "space"></div>
                    <tr><th>変更用パスワード</th><td><input type="password" placeholder="必ず入力" size="20" value=""></td><td>必須</td></tr>
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
