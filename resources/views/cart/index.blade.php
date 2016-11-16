
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

        @if ($products)
            {{-- {{ dd($productMap) }} --}}

            <div class="clear btn">
                <form id="clear" action="/cart/clear" method="post">
                    <div class="inner form-bottom"><a>カートをカラにする</a></div>
                    {{ csrf_field() }}
                </form>
            </div>

            @foreach ($productMap as $product)
                <div class="pruduct">
                    <div class="image"><img src="{{$product->product_image}}" alt="" /></div>
                    <div class="content">
                        <table id="tablebox">
                            <tbody>
                                <tr>
                                    <td class="name">商品名</td>
                                    <td>{{$product->product_name}}</td>
                                </tr>
                                <tr>
                                    <td class="name">詳細</td>
                                    <td>{{$product->product_text}}</td>
                                </tr>
                                <tr>
                                    <td class="name">金額</td>
                                    <td>{{$product->productPrice->product_price}}</td>
                                </tr>
                                <tr>
                                    <td class="name">数量</td>
                                    <td>
                                        <select class="sum" name="sum">
                                            <option value="{{$productCount[$product->id]}}">{{$productCount[$product->id]}}</option>
                                            @for ($i=1; $i <= 10 ; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="subtotal">小計</td>
                                    <td>{{number_format($productCount[$product->id] * $product->productPrice->product_price)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach

            <div class="total">
                <p>合計金額: <span>{{ number_format($total) }}</span>円</p>
            </div>
            <div class="btn">
                <div class="inner special"><a href="/menu">買い物を続ける</a></div>
                <div class="inner"><a href="/menu">レジに進む</a></div>
            </div>
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
