
@extends('template/master')

@section('title', 'メニュー')

@section('css')
    <link rel="stylesheet" href="/css/menu/index.css" media="all" title="no title">
@endsection

@section('plug')
    <script src="/plug/heightLine/heightLine.js" charset="utf-8"></script>
@endsection

@section('main')
    <div class="container menu wrap">
        <div class="productsBox">
            <h2>PIZZA</h2>
        @foreach ($products as $product)
            <div class="product">
                <div class="inner">
                    <div class="image"><img src="{{ $product->product_image }}" alt="" /></div>
                    <div class="title"><h3>{{ $product->product_name }}</h3></div>
                     <div class="praice"><p>{{ $product->productPrice->product_price }}円</p></div>
                    <div class="text"><p>{{ $product->product_text }}</p></div>
                    <div class="btn">
                        <form class="" action="/cart/store" method="post">
                            <span>
                                <select class="" name="sum">
                                    @for ($i=1; $i <= 10 ; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </span>
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <div class="form-bottom">カートに入れる</div>
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(window).on('load',function () {
            $('.product .title').heightLine();
            $('.product .text').heightLine();
        });
    </script>
@endsection
