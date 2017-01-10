@extends('template/master')

@section('title', 'トップ')

@section('css')
    <link rel="stylesheet" href="/css/menu/index.css" media="all" title="no title">
    <link rel="stylesheet" href="/css/index/index.css" media="all" title="no title">
@endsection

@section('plug')
    <script src="/plug/flexSlier/jquery.flexslider-min.js" charset="utf-8"></script>
    <script src="/plug/heightLine/heightLine.js" charset="utf-8"></script>
    <link rel="stylesheet" href="/plug/flexSlier/flexslider.css" media="screen" title="no title">
@endsection
@section('main')
    <div class="flexslider">
        <ul class="slides">
            <li><img src="images/index/pizza01.png"/></li>
            <li><img src="images/index/pizza02.png"/></li>
            <li><img src="images/index/pizza03.png"/></li>
            <li><img src="images/index/pizza04.png"/></li>
            <li><img src="images/index/pizza05.png"/></li>
        </ul>
    </div>
    <div class="container wrap">
        <div class="productsBox">
            <h2>人気ピザランキング</h2>
            <div class="ranking">
                <ul>
                    <?php $rank = 0; ?>
                    @foreach ($popularPizza as $pizza)
                        <?php $rank += 1; ?>
                        <div class="product ranking">
                            <div class="inner">
                                <div class="rank">{{ $rank }}位</div>
                                <div class="image"><img src="{{ $pizza->product_image }}" alt=""/></div>
                                <div class="title"><h3>{{ $pizza->product_name }}</h3></div>
                                <div class="price"><p>{{ number_format($pizza->product_price) }}円</p></div>
                                <div class="text"><p>{{ $pizza->product_text }}</p></div>
                                <div class="btn">
                                    <form class="" action="/cart/store" method="post">
                                <span>
                                    <select class="" name="sum">
                                        @for ($i=1; $i <= 10 ; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </span>
                                        <input type="hidden" name="id" value="{{ $pizza->id }}">
                                        <div class="form-bottom">カートに入れる</div>
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </ul>
            </div>
            <h2>人気サイドランキング</h2>
            <div class="ranking">
                <ul>
                    <?php $rank = 0; ?>
                    @foreach ($popularSide as $side)
                        <?php $rank += 1; ?>
                        <div class="product ranking">
                            <div class="inner">
                                <div class="rank">{{ $rank }}位</div>
                                <div class="image"><img src="{{ $side->product_image }}" alt=""/></div>
                                <div class="title"><h3>{{ $side->product_name }}</h3></div>
                                <div class="price"><p>{{ number_format($side->product_price) }}円</p></div>
                                <div class="text"><p>{{ $side->product_text }}</p></div>
                                <div class="btn">
                                    <form class="" action="/cart/store" method="post">
                                <span>
                                    <select class="" name="sum">
                                        @for ($i=1; $i <= 10 ; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </span>
                                        <input type="hidden" name="id" value="{{ $side->id }}">
                                        <div class="form-bottom">カートに入れる</div>
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </ul>
            </div>
            <h2>キャンペーン情報</h2>
            <div class="campaign">
                <ul>
                    @foreach ($campaigns as $campaign)
                        <li><a href="/topicdetail?id={{ $campaign->id }}"><img src="{{ $campaign->campaign_banner }}"
                                                                               alt=""/></a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(window).load(function () {
            $('.flexslider').flexslider({
                animation: "slide"
            });
        });

        $(window).on('load', function () {
            $('.product .title').heightLine();
            $('.product .text').heightLine();
        });
        $(function () {
            $('.form-bottom').click(function () {
                var form = $(this).parent();
                $(form).submit();
            });
        })
    </script>
@endsection
