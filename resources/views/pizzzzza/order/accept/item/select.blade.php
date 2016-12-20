@extends('template.admin')

@section('title', '商品選択')

@section('css')
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
    <h1>商品選択</h1>
    @if(isset($products))
        <form action="#">
            <div class="row">
                <div class="col-md-7">
                    <div id="pizza">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>商品 (ピザ)</th>
                                <th>値段</th>
                                <th>数量</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                @if ($product->genre_id == 1)
                                    <tr class="item">
                                        <td>
                                            <a href="/pizzzzza/menu/{{$product->id}}/show">{{ $product->product_name }}</a>
                                        </td>
                                        <td>{{ number_format($product->product_price) }} 円</td>
                                        <td>
                                            <select name="product_num" id="{{ $product->product_name }}" class="{{ $product->genre_name }} form-control">
                                                @for($i = 0; $i<= 10; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="side">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>商品 (サイド)</th>
                                <th>値段</th>
                                <th>数量</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                @if ($product->genre_id == 2)
                                    <tr class="item">
                                        <td>
                                            <a href="/pizzzzza/menu/{{$product->id}}/show">{{ $product->product_name }}</a>
                                        </td>
                                        <td>{{ number_format($product->product_price) }} 円</td>
                                        <td>
                                            <select name="product_num" id="{{ $product->product_name }}"
                                                    class="{{ $product->genre_name }} form-control">
                                                @for($i = 0; $i<= 10; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div id="drink">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>商品 (ドリンク)</th>
                                <th>値段</th>
                                <th>数量</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                @if ($product->genre_id == 2)
                                    <tr class="item">
                                        <td>
                                            <a href="/pizzzzza/menu/{{$product->id}}/show">{{ $product->product_name }}</a>
                                        </td>
                                        <td>{{ number_format($product->product_price) }} 円</td>
                                        <td>
                                            <select name="product_num" id="{{ $product->product_name }}"
                                                    class="{{ $product->genre_name }} form-control">
                                                @for($i = 0; $i<= 10; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
                <div class="col-md-5">
                    <div id="sidebar" class="cart">
                        <div class="btn-group btn-group-justified mb" role="group" aria-label="...">
                            <div class="btn-group" role="group">
                                <a class="btn btn-default" href="#pizza">ピザ</a>
                            </div>
                            <div class="btn-group" role="group">
                                <a class="btn btn-default" href="#side">サイド</a>
                            </div>
                            <div class="btn-group" role="group">
                                <a class="btn btn-default" href="#drink">ドリンク</a>
                            </div>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>商品</th>
                                <th>数量</th>
                                <th class="ac">削除</th>
                            </tr>
                            </thead>
                            <tbody id="cart">
                            <tr class="item">
                                <td>空です</td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>


@endsection

@section('script')
    <script src="/plug/heightLine/heightLine.js" charset="utf-8"></script>
    <script type="text/javascript">


        $(function () {

            var cart = {};

            $('select').change(function () {
                var product_id = $(this).attr('id');
                var product_num = $(this).val();

                cart[product_id] = product_num;

                // #cartを初期化
                $('#cart').empty();

                // #cartに書き足し
                $.each(cart, function (i, val) {
                    if (val != 0) {
                        $('#cart').append('<tr class="item"><td>' + i + '</td><td><select class="select form-control"><option value=' + val + ' selected>' + val + '</option></select></td><td class="ac"><button class="btn btn-danger btn-sm">削除</button></td> </tr>');
                    }
                });

                // option valueを追加
                for (var i = 0; i <= 10; i++) {
                    $('.select').append('<option values=' + i + '>' + i + '</option>');
                }

                /*

                {{-- トークンをmetaに設定し、送る --}}
                $.ajaxSetup({
                 headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
                 });

                {{-- 入力値をdataに設定 --}}
                var data = {
                 product_id: $(this).attr('id'),
                 product_num: $(this).val(),
                 "_token": "{{ csrf_token() }}"
                 };

                 $.ajax(
                 {
                 type: "POST",
                 url: "/pizzzzza/order/accept/customer/cart",
                 data: data,
                 success: function (cart,status,count) {
                 // 成功 alert(cart["cart"]["綾鷹"]);
                 // 成功 alert(cart["cart"].綾鷹);

                 // #cartを初期化
                 $('#cart').empty();

                 // #cartに書き足し
                 $.each(cart["cart"], function(i, val) {
                 $('#cart').append('<tr><td>' + i + '</td><td><select class="select form-control"><option value='+ val +' selected>' + val + '</option></select></td></tr>');
                 // $("#cart").append(i + " - " + val);
                 });

                 // option valueを追加
                 for(var i=0; i <= 10; i++) {
                 $('.select').append('<option values='+ i +'>'+ i +'</option>');
                 }

                 },
                 error: function (XMLHttpRequest, textStatus, errorThrown) {
                 alert('Error : ' + errorThrown);
                 $("#XMLHttpRequest").html("XMLHttpRequest : " + XMLHttpRequest.status);
                 $("#textStatus").html("textStatus : " + textStatus);
                 $("#errorThrown").html("errorThrown : " + errorThrown);
                 }
                 });
                 //ページをリロードしない
                 return false;
                 */
            });
        });

        $(function() {
            var $sidebar	= $("#sidebar"),
                $window		= $(window),
                width       = $(window).width(),
                offset		= $sidebar.offset(),
                topPadding	= 15;

            $window.scroll(function() {
                if (width > 991) {

                }
                if ($window.scrollTop() > offset.top) {
                    $sidebar.stop().css({
                        marginTop:$window.scrollTop() - offset.top + topPadding
                })
                } else {
                    $sidebar.stop().css({
                        marginTop:0
                });
                }
            });
        });

    </script>
@endsection