@extends('template/master')

@section('title', 'お問い合わせ')

@section('css')
    <link rel="stylesheet" href="/css/contact/index.css" media="all" title="no title">
@endsection

@section('plug')

@endsection

@section('main')
    <div class="container wrap">
        <h2>CONTACT</h2>
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
                    <li class="title">メールアドレス</li>
                    <li><input type="text" name="email" class="form-mail" placeholder="example@xxx.com"></li>
                    <li class="title">内容</li>
                    <li><textarea name="body" rows="10" cols="100" placeholder="テキストを入れてください"></textarea></li>
                </ul>
                <div class="form-bottom"><a onClick="return double()">送信</a></div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
  var set=0;
  function double() {
  if(set==0){ set=1; } else {
  return false; }}
</script>
@endsection
