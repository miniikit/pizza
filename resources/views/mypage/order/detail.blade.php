@extends('template/master')

@section('title', '注文詳細')

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
        <div class="fonts"><h2>注文詳細</h2></div>
        <div id="order">
            <table id="table">
                <thead>
                <tr>
                    <th>お客様情報</th>
                    <th>クーポン</th>
                    <th>お支払金額</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="font_left">北海道札幌市<br>旭川町５−１<br>マンショントリップ１０１号室</td>
                    <td align="2">SPRING_PIZZA</td>
                    <td>¥ 8,800</td>
                </tr>
                </tbody>
            </table>
            <ul>
                <a href="#">
                    <!--    繰り返し    !-->
                    <li class="order">
                        <div class="contents">
                            <img class="item img" src="/images/product/2.jpg" alt="">
                            <div class="item name">パンナコッタ</div>
                            <div class="item price">¥ 4,400</div>
                            <div class="item num">3</div>
                        </div>
                    </li>
                    <!--    繰り返し    !-->
                    <li class="order">
                        <div class="contents">
                            <img src="/images/product/2.jpg" alt="">
                            <div class="item_name">パンナコッタ</div>
                            <div class="item_price">¥ 4,400</div>
                            <div class="item_num">3</div>
                        </div>
                    </li>
                </a>
            </ul>
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