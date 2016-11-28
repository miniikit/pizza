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
        <div class="fonts"><h2>会員情報更新</h2></div>
        <div class="register">


            @if (count($errors) > 0 || Session::has('flash_message'))
                <div class="error">
                    {{-- Laravelによるエラーメッセージ --}}
                    @foreach ($errors->all() as $message)
                        <div class="error-message">{{$message}}</div><br>
                    @endforeach
                    {{--  手動バリデーションチェックのエラーメッセージ  --}}
                    @if (Session::has('flash_message'))
                        <div class="error-message">{{ Session::get('flash_message') }}</div><br>
                    @endif
                </div>
            @endif
            <form class="submit" action="/mypage/confirm" method="post">
                <table id="table">
                    @foreach($users as $user)
                        {{-- 郵便番号にハイフンを合体。いっそ関数にしても？ --}}
                        <?php
                        $zip = $user->postal;
                        $postal = substr($zip, 0, 3) . '-' . substr($zip, 3);
                        ?>
                        <tr>
                            <th>名前</th>
                            <td><input type="text" placeholder="（例）大阪　太郎" size="20" maxlength="50" name="name"
                                       value="{{ $user->name }}"></td>
                        </tr>
                        <tr>
                            <th>フリガナ</th>
                            <td><input type="text" placeholder="（例）オオサカ　タロウ" size="20" maxlength="100"
                                       name="name_katakana" value="{{ $user->kana }}"></td>
                        </tr>
                        <tr>
                            <th>郵便番号</th>
                            <td><input type="text" placeholder="123456" size="8" name="postal" maxlength="7" value="{{ $user->postal }}"></td>
                        </tr>
                        <tr>
                            <th>住所</th>
                            <td><input type="text" placeholder="（例）大阪府大阪市天王寺区" size="40" name="address1" maxlength="255" value="{{ $user->address1 }}"></td>
                        </tr>
                        <tr>
                            <th>番地</th>
                            <td><input type="text" placeholder="（例）１−１−１" size="40" name="address2" maxlength="255" value="{{ $user->address2 }}"></td>
                        </tr>
                        <tr>
                            <th>建物名</th>
                            <td><input type="text" placeholder="（例）東マンション　５０２号室" size="40" maxlength="255" name="address3" value="{{ $user->address3 }}"></td>
                        </tr>
                        <tr>
                            <th>生年月日</th>
                            <td><input type="date" size="20" maxlength="50" name="birthday" value="{{ date('Y-0n-0j', strtotime($user->birthday)) }}"></td>
                        </tr>
                        <tr>
                            <th>電話番号</th>
                            <td><input type="tel" placeholder="08012345678" size="13" maxlength="11" name="phone" value="{{ $user->phone }}"></td>
                        </tr>
                        <tr>
                            <th>性別</th>
                            <td>
                                @if ($user->gender_id === 1)
                                    <label for=""><input type="radio" name="gender" value="男" checked > 男</label>
                                    <label for=""><input type="radio" name="gender" value="女" > 女</label>
                                @else
                                    <label for=""><input type="radio" name="gender" value="男" > 男</label>
                                    <label for=""><input type="radio" name="gender" value="女" checked > 女</label>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>メールアドレス</th>
                            <td><input type="email" size="20" maxlength="256" name="email" value="{{ $user->email }}">
                            </td>
                        </tr>
                        <tr>
                            <th class="edit-password">新しいパスワード</th>
                            <td><input type="password" placeholder="新しいパスワード" size="40" name="new_password" maxlength="128"><span class="caption">※英小文字・英大文字・数字を「各１つ以上」ご使用ください</span></td>
                        </tr>
                        <tr>
                            <th>新しいパスワード</th>
                            <td><input type="password" placeholder="新しいパスワード(確認)" size="40" name="new_password_confirm" maxlength="128"></td>
                        </tr>
                        <div class="space"></div>
                        <tr>
                            <th>現在のパスワード</th>
                            <td><input type="password" placeholder="必ず入力" size="20" name="confirm_password" value=""></td>
                        </tr>
                    @endforeach

                </table>
                <a class="form-bottom" href="/mypage/detail">キャンセル</a>
                <a class="form-bottom" href="#">確認へ</a>
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
