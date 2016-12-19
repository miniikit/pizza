@extends('template.master')

@section('title', '登録完了')

@section('css')
    <link rel="stylesheet" href="/css/auth/register/complete.css" media="all" title="no title">
@endsection

@section('main')
    <div class="container">
        <div class="wrap">
            <div class="test-box">
                <h1>会員完了しました!</h1>
                <p>
                    この度は、OIC PIZZAをご利用いただき、誠にありがとうございます。
                    次回から、この会員情報をご利用ください。
                </p>
            </div>

            <div class="btn-box">
                <div class="box1"><a href="/">TOPへ</a></div>
                <div class="box2"><a href="/login">ログイン</a></div>
            </div>
        </div>
    </div>
@endsection
