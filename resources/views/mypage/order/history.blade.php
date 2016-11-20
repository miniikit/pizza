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
            <ul>
                @foreach($orders as $details)
                        {{--  クーポン使用後の金額を求め、日付のフォーマットをY/m/dに。  --}}
                <?php
                        $totalPrice = $details->total_price;
                        $coupon = $details->coupon_discount;
                        $price = $totalPrice-$coupon;
                        $date = Carbon\Carbon::parse($details->order_date)->format('Y年m月d日');
                ?>
                <a href="/mypage/order/detail/{{  $details->id }}">
                    <li class="history">
                        <div class="head">
                            <div class="date mini">注文日</div>
                            <div class="pay mini">注文金額</div>
                        </div>
                        <div class="contents">
                            <div class="date mini"><?php echo $date ?></div>
                            <div class="pay mini">¥ {{  number_format($price) }}</div>
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