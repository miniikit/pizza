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
                <tr><th>名前</th><td>{{ $user->name }}</td></tr>
                <tr><th>フリガナ</th><td>{{ $user->kana }}</td></tr>
                <tr><th>郵便番号</th><td>〒{{ $postal }}</td></tr>
                <tr><th>住所１</th><td>{{ $user->address1 }}</td></tr>
                <tr><th>住所２</th><td>{{ $user->address2 }}</td></tr>
                <tr><th>住所３</th><td>{{ $user->address3 }}</td></tr>
                <tr><th>生年月日</th><td>{{ date('Y年 n月 j日', strtotime($user->birthday)) }}</td></tr>
                <tr><th>電話番号</th><td>{{ $user->phone }}</td></tr>
                <tr><th>性別</th><td>{{ $gender }}</td></tr>
                <tr><th>メールアドレス</th><td>{{ $user->email }}</td></tr>
                <tr><th>パスワード</th><td>**********</td></tr>
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
