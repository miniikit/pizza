
@extends('template/master')

@section('title', 'お問い合わせ')

@section('css')
    <link rel="stylesheet" href="/css/contact/index.css" media="all" title="no title">
@endsection

@section('plug')

@endsection

@section('main')
    <div class="container wrap">
        <h2>お問い合わせ</h2>
        @if (count($errors) > 0)
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
         <div id="contact">
          <form action="/contact" method="post">
              <ul id="from-group">
                <li>メールアドレス</li>
                <li><input type="text" name="email" class="form-mail"></li>
                <li>内容</li>
                <li><textarea name="body" rows="10" cols="100"></textarea></li>
              </ul>
              <div class="form-bottom"><a>送信</a></div>
              {{ csrf_field() }}
          </form>
        </div>
    </div>
@endsection

@section('scrip')

@endsection
