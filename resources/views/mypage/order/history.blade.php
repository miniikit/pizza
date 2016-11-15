@extends('template/master')

@section('title', '注文履歴')

@section('css')
    <link rel="stylesheet" href="/css/index/index.css" media="all" title="no title">
    <link rel="stylesheet" href="/css/mypage/index.css" media="all" title="no title">
@endsection

@section('plug')
    <script src="/plug/flexSlier/jquery.flexslider-min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="/plug/flexSlier/flexslider.css" media="screen" title="no title">
@endsection
@section('main')


    <div class="container wrap">
        <div class="fonts"><h2>注文履歴</h2></div>
        <div id="order">
            <a href="#">
            <ul>
                <!--    繰り返し  !-->
                <li class="history">
                    <div class="head">
                        <div class="date mini">注文日</div>
                        <div class="pay mini">注文金額</div>
                    </div>
                    <div class="contents">
                        <div class="date mini">2016/8/10</div>
                        <div class="pay mini">¥ 5,000</div>
                    </div>
                </li>
                <!--    繰り返し  !-->
                <li class="history">
                    <div class="head">
                        <div class="date mini">注文日</div>
                        <div class="pay mini">注文金額</div>
                    </div>
                    <div class="contents">
                        <div class="date mini">2016/10/10</div>
                        <div class="pay mini">¥ 3,000</div>
                    </div>
                </li>
            </ul>
            </a>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(window).load(function() {
            $('.flexslider').flexslider({
                animation: "slide"
            });
        });
    </script>
@endsection
