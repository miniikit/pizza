@extends('template.auth')

@section('title', 'パスワードリセット')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
    <link rel="stylesheet" href="/css/auth/password/index.css" media="all" title="no title">
@endsection

@section('main')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">パスワード再発行のお手続き</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="">
                      <h5>パスワードをお忘れの場合、下記の入力フォームにてメールアドレスをご記入ください。</h5>
                    </div>

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">メールアドレス</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                <span class="emailreset_exaplain">例)oic@example.com</span>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    送信
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
