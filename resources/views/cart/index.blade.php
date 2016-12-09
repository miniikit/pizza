
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

            <div class="clear btn">
                <form id="clear" action="/cart/clear" method="post">
                    <div class="inner form-bottom"><a>カートを空にする</a></div>
                    {{ csrf_field() }}
                </form>
            </div>

            <table id="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>商品名</th>
                        <th>詳細</th>
                        <th>金額</th>
                        <th>数量</th>
                        <th>小計</th>
                        <th>削除</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td><img src="{{$product->product_image}}" alt="" /></td>
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->product_text}}</td>
                        <td>{{number_format($product->productPrice->product_price)}}円</td>
                        <td class="btn">
                            <form class="" action="/cart/edit/" method="post">
                                <span>
                                    <select class="sum" name="sum">
                                        <option value="{{$productCount[$product->id]}}">{{$productCount[$product->id]}}</option>
                                        @for ($i=1; $i <= 10 ; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </span>
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                {{ csrf_field() }}
                            </form>
                        </td>
                        <td>{{number_format($productCount[$product->id] * $product->productPrice->product_price)}}円</td>
                        <td><form action="/cart/clear/{{$product->id}}" method="post"><div class="form-bottom"><a><i class="fa fa-times-circle" aria-hidden="true"></i></a></div>{{ csrf_field() }}</form></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="total">
                <p>合計金額: <span>{{ number_format($total) }}</span>円</p>
            </div>
            <div class="btn">
                <div class="inner special"><a href="/menu">買い物を続ける</a></div>
                <div class="inner"><a href="/order/confirm">注文へ進む</a></div>
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
    <script type="text/javascript">
    $(".sum").change(function(){
        var form = $(this).parent().parent();
        $(form).submit();
    });
    </script>
@endsection
