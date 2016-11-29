@extends('template.admin')

@section('title', '電話注文')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
    <link rel="stylesheet" href="/css/pizzzzza/order/index.css" media="all" title="no title">
@endsection

@section('main')
    <div class="wrap">
        <h1>商品選択</h1>
        <div class="left-contents">
            @if(isset($products))
                <form action="#">
                    @foreach($products as $product)
                        <div class="product">
                            <div class="image">
                                <image src=""></image>
                            </div>
                            <div class="title">{{ $product->product_name }}</div>
                            <div class="price">{{ $product->product_price }}</div>
                            <div class="sum">
                                <select name="product_num" id="">
                                    @for($i = 0; $i< 50; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    @endforeach
                </form>
            @endif
        </div>
        <div class="right-contents floating">
            <div class="order_cart">
                <div class="cart">カート</div>


            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/plug/heightLine/heightLine.js" charset="utf-8"></script>
    <script type="text/javascript">
        $(window).on('load',function () {
            $('.product .title').heightLine();
            $('.product .text').heightLine();
        });
    </script>
@endsection