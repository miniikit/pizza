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
                    <th>お支払金額（税込）</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    @foreach($users as $user)
                    <td class="font_left">{{ $user->address1 }}<br>{{ $user->address2 }}<br>{{ $user->address3 }}</td>
                        @foreach($orders as $order)
                        <td align="2">{{ $order->coupon_name }}</td>
                        <td>¥ {{ number_format($order->total_price) }}</td>
                        @endforeach
                    @endforeach
                </tr>
                </tbody>
            </table>
            <ul>
                @foreach($contents as $product)
                <a href="#">
                    <li class="order">
                        <div class="contents">
                            <img class="item img" src="{{ url($product->product_image) }}" alt="">
                            <div class="item name">{{ $product->product_name }}</div>
                            <div class="item price">¥ {{ number_format($product->product_price) }}</div>
                            <div class="item num">{{ $product->number }} 個</div>
                        </div>
                    </li>
                </a>
                @endforeach
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