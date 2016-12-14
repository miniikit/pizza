@extends('template.admin')

@section('title', '商品選択')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
    <link rel="stylesheet" href="/css/pizzzzza/order/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order">ホーム</a></li>
        <li><a href="/pizzzzza/order/accept/input">電話注文受付</a></li>
        <li><a href="/pizzzzza/order/accept/customer/{{$id}}/show">お客様情報確認</a></li>
        <li class="active">商品選択</li>
    </ol>
@endsection

@section('main')
    <h1 class="title">商品選択</h1>
    <div class="container">
        @if(isset($products))
            <form action="#">
                <div class="row">
                    <div class="col-xs-12 col-md-10">
                        <div id="pizza">
                            <h1 class="text-center title">ピザ</h1>
                        </div>
                        <div class="row">
                            @foreach($products as $product)
                                @if ($product->genre_id == 1)
                                    <div class="col-xs-6 col-md-4 mb">
                                        <div class="item">
                                            <div class="text-center">
                                                <image src="{{ $product -> product_image }}"></image>
                                            </div>
                                            <p class="text-center space name">{{ $product->product_name }}</p>
                                            <div class="text-center space">{{ $product->product_price }}円</div>
                                            <div class="text-center space">
                                                <select name="product_num" id="{{ $product->product_name }}" class="{{ $product->genre_name }}">
                                                    @for($i = 0; $i<= 10; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <h1 class="text-center title-space">サイド</h1>
                        <div class="row">
                            @foreach($products as $product)
                                @if ($product->genre_id == 2)
                                    <div class="col-xs-6 col-md-4 mb">
                                        <div class="item">
                                            <div class="text-center">
                                                <image src="{{ $product -> product_image }}"></image>
                                            </div>
                                            <p class="text-center space name prduct_name">{{ $product->product_name }}</p>
                                            <div class="text-center space">{{ $product->product_price }}円</div>
                                            <div class="text-center space">
                                                <select name="product_num" id="{{ $product->product_name }}" class="{{ $product->genre_name }}">
                                                    @for($i = 0; $i<= 10; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <div id="drink">
                            <h1 class="text-center title-space">ドリンク</h1>
                        </div>
                        <div class="row">
                            @foreach($products as $product)
                                @if ($product->genre_id == 3)
                                    <div class="col-xs-6 col-md-4 mb">
                                        <div class="item">
                                            <div class="text-center">
                                                <image src="{{ $product -> product_image }}"></image>
                                            </div>
                                            <p class="text-center space name">{{ $product->product_name }}</p>
                                            <div class="text-center space">{{ $product->product_price }}円</div>
                                            <div class="text-center space">
                                                <select name="product_num" id="{{ $product->product_name }}" class="{{ $product->genre_name }}">
                                                    @for($i = 0; $i<= 10; $i++)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
            </form>
        @endif
    </div>
    <div class="col-xs-6 col-md-2">
        <h3 class="list">カテゴリ</h3>
        　
        <ul class="list-group list-none">
            <li class="list" data-href="#">
                <a href="#pizza"><h4>ピザ<span class="badge menu-space">{{ $pizzacnt }}</span></h4></a>
            </li>

            <li class="list">
                <a href="#side"><h4>サイド<span class="badge menu-space">{{ $sidecnt }}</span></h4></a>
            </li>
            <li class="list">
                <a href="#drink"><h4>ドリンク<span class="badge menu-space">{{ $drinkcnt }}</span></h4></a>
            </li>
        </ul>
    </div>
    </div>
    

    <div class="cart">
        <h1>Cart</h1>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>商品</th>
                <th>数量</th>
                <th>ジャンル</th>
            </tr>
            </thead>
            <tbody id="cart">
            {{-- ここに追加商品が増加 --}}
        </table>
    </div>
</div>

@endsection

@section('script')
    <script src="/plug/heightLine/heightLine.js" charset="utf-8"></script>
    <script type="text/javascript">

        $(window).on('load', function () {
            $('.item .name').heightLine();
            $('.product .text').heightLine();
        });


        $('.ul li[data-href]').addClass('clickable').click(function () {
            window.location = $(this).attr('data-href');
        }).find('a').hover(function () {
            $(this).parents('li').unbind('click');
        }, function () {
            $(this).parents('li').click(function () {
                window.location = $(this).attr('data-href');
            });
        });



        $(function() {

            //セレクトボックスが切り替わったら発動
            $('select').change(function() {

                //選択したvalue値を変数に格納
                var num = $(this).val();
                var name = $(this).attr("id");
                var genre = $(this).attr("class");

                //選択したvalue値をp要素に出力
                $('#cart').append('<tr><td>' + name + '</td><td>' + num + '</td><td>' + genre + '</tr>');
            });
        });


        $(function()
        {
            $('select').change(function()
            {


                {{-- トークンをmetaに設定し、送る --}}
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                        {{-- 入力値をdataに設定 --}}
                var data = {
                            product_id : $(this).attr('id'),
                            product_num : $(this).val(),
                            "_token": "{{ csrf_token() }}"
                };

                $.ajax(
                        {
                            type:"POST",
                            url: "/pizzzzza/order/accept/customer/cart",
                            data: data,
                            success: function(message, dataType)
                            {
                                console.log(message)

                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown)
                            {
                                alert('Error : ' + errorThrown);
                                $("#XMLHttpRequest").html("XMLHttpRequest : " + XMLHttpRequest.status);
                                $("#textStatus").html("textStatus : " + textStatus);
                                $("#errorThrown").html("errorThrown : " + errorThrown);
                            }
                        });
                //ページをリロードしない
                return false;
            });
        });



    </script>
@endsection