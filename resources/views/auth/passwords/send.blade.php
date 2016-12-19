@extends('template.auth')

@section('title', '送信完了')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('main')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    送信完了しました!<br>
                    登録されたメールアドレス宛にパスワード再発行の手続きのURLをお送りしましたので、<br>
                    そちらへアクセスしてください。<br>
                </div>
            </div>
        </div>
    </div>
@endsection
