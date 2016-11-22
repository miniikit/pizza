
@extends('template/master')

@section('title', 'お問い合わせ')

@section('css')
    <link rel="stylesheet" href="/css/contact/index.css" media="all" title="no title">
@endsection

@section('plug')

@endsection

@section('main')
    <div class="container wrap">
        <h1>お問い合わせ</h1>
         <div id="contact">
          <form action="/contact" method="post">
              <ul id="from-group">
                <li>
                  <label>メールアドレス(必須)</label>
                </li>
                <li>
                  <input type="text" name="email" label="email" class="form-mail">
                </li>
                <li>
                  <label>内容文</label>
                </li>
                <li>
                  <textarea name="textarea" label="text" rows="10" cols="100"></textarea>
                </li>
                <li class="checkbox">
                  <label>
                      <input type="checkbox">XXXに同意します
                  </label>
                </li>
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <button type="submit">送信</button>
              </ul>
          </form>
        </div>
    </div>
@endsection

@section('scrip')

@endsection
