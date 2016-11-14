
@extends('template/master')

@section('title', 'メニュー')

@section('css')
    <link rel="stylesheet" href="/css/cart/index.css" media="all" title="no title">
@endsection

@section('plug')
    <script src="/plug/heightLine/heightLine.js" charset="utf-8"></script>
@endsection

@section('main')
    <div id="cart" class="wrap">
        <h2>CART</h2>

        @if (false)

        @else
            <div class="empty">
                <div class="inner">
                    <i class="fa fa-cube" aria-hidden="true"></i>
                    <h3>カートの中にはなにもありませんでした。</h3>
                </div>

            </div>
            <div class="btn">
                <div class="inner"><a href="/menu">商品一覧へ</a></div>
            </div>
        @endif
    </div>
@endsection

@section('script')

@endsection
