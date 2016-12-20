@extends('template.auth')

@section('title', '再発行完了')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('main')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                    送信完了しました!<br>
                    次回から再発行したパスワードを使ってログインしてください。<br>
                    <a href="/" class="btn btn-primary">TOPへ</a>
                </div>
            </div>
        </div>
    </div>
@endsection
