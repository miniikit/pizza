@extends('template/master')

@section('title', 'レジ')

@section('css')
    <link rel="stylesheet" href="/css/order/index.css" media="all" title="no title">
@endsection

@section('plug')

@endsection

@section('main')
    <div class="container wrap">
        <h2 class="title">ORDER</h2>
        <div id="complete">
            <div class="inner">
                <i class="fa fa-truck" aria-hidden="true"></i>
                <h3>ご注文ありがとうございます。</h3>
            </div>
       </div>
       <div class="btn">
           <div class="inner special"><a href="/">トップへ戻る</a></div>
       </div>
    </div>
@endsection

@section('script')
<script type="text/javascript">
    $('#submit').on('click',function () {
        $('#post').submit();
    })
</script>
@endsection
