@extends('template.admin')

@section('title', '商品選択')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/order/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order">ホーム</a></li>
        <li><a href="/pizzzzza/order/accept/input">電話注文</a></li>
        <li><a href="/pizzzzza/order/accept/customer/{{ $id }}/show">お客様情報確認</a></li>
        <li class="active">商品選択</li>
    </ol>
@endsection

@section('main')
    <h1>商品選択</h1>
    @if(isset($products))
        <form action="/pizzzzza/order/accept/item/{{ $id }}/confirm">
            <div class="row">
                <div class="col-md-7">
                    <div id="pizza">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>商品（ピザ）</th>
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
                                            <select name="" id="{{ $product->product_name }}"
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
                    <div id="side">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>商品（サイド）</th>
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
                                            <select name="" id="{{ $product->product_name }}"
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
                                <th>商品（ドリンク）</th>
                                <th>値段</th>
                                <th>数量</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                @if ($product->genre_id == 3)
                                    <tr class="item">
                                        <td>
                                            <a href="/pizzzzza/menu/{{$product->id}}/show">{{ $product->product_name }}</a>
                                        </td>
                                        <td>{{ number_format($product->product_price) }} 円</td>
                                        <td>
                                            <select name="" id="{{ $product->product_name }}"
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
                        <div id="order" class="ar">
                            <a href="/pizzzzza/order/accept/customer/{{ $id }}/show" class="btn btn-default btn-sm">戻る</a>
                            <button id="form-button" class="btn btn-primary btn-sm ml" style="display: none;">確認</button>
                        </div>
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

            {{-- 初回読み込み時のみ実行 --}}
            $(document).ready(function () {

                {{-- トークンをmetaに設定し、送る --}}
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                {{-- 送信する値 --}}
                var data = {
                            "_token": "{{ csrf_token() }}"
                        };

                $.ajax(
                        {
                            type: "POST",
                            url: "/pizzzzza/order/accept/customer/cart/check",
                            data: data,
                            success: function (cart) {

                                // #cartを初期化
                                $('#cart').empty();

                                // カートに存在する、商品の種類数
                                var length = Object.keys(cart["cart"]).length;

                                // カート内に商品が入っていれば表示
                                if(length > 0) {

                                    // #cart内に一行ずつ、商品を書き足し
                                    $.each(cart["cart"], function (product_name, val) {

                                        // 一行書き出し
                                        $('#cart').append('<tr class="item"><td>' + product_name + '</td><td><select class="select form-control ' + product_name + '" id="' + product_name + '" name="'+ product_name +'"'+'"></select></td> <td class="ac"><button class="btn btn-danger btn-sm delete" name="product_name" value="' + product_name + '">削除</button></td></tr>');

                                        // selectタグ内に追加
                                        var max = 11;
                                        for (var i = 0; i < max; i++) {
                                            if (i == val) {
                                                $("." + product_name + "").append('<option value="' + i + '" selected>' + i + '</option>');
                                            } else {
                                                $("." + product_name + "").append('<option value="' + i + '">' + i + '</option>');
                                            }
                                        }
                                    });

                                // カート内に商品が入っていない場合
                                }else{
                                    $('#cart').append('<tr class="item"><td colspan="3">空です</td></tr>');
                                }

                                // 注文へ進むボタンを表示
                                $('#form-button').css('display','inline-block');

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

            });

            {{-- selectの値が変わるたびに実行 --}}
            $(document).on('change', 'select', function () {

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

                {{-- Ajax通信 --}}
                 $.ajax(
                        {
                            type: "POST",
                            url: "/pizzzzza/order/accept/customer/cart",
                            data: data,
                            success: function (cart) {

                                // #cartを初期化
                                $('#cart').empty();

                                // カートに存在する、商品の種類数
                                var length = Object.keys(cart["cart"]).length;

                                // カート内に商品が入っていれば表示
                                if(length > 0) {

                                    // #cart内に一行ずつ、商品を書き足し
                                    $.each(cart["cart"], function (product_name, val) {

                                        // 一行書き出し
                                        $('#cart').append('<tr class="item"><td>' + product_name + '</td><td><select class="select form-control ' + product_name + '" id="' + product_name + '" name="'+ product_name +'"'+'"></select></td> <td class="ac"><button class="btn btn-danger btn-sm delete" name="product_name" value="' + product_name + '">削除</button></td></tr>');

                                        // selectタグ内に追加
                                        var max = 11;
                                        for (var i = 0; i < max; i++) {
                                            if (i == val) {
                                                $("." + product_name + "").append('<option value="' + i + '" selected>' + i + '</option>');
                                            } else {
                                                $("." + product_name + "").append('<option value="' + i + '">' + i + '</option>');
                                            }
                                        }
                                    });

                                    // カート内に商品が入っていない場合
                                }else{
                                    $('#cart').append('<tr class="item"><td colspan="3">空です</td></tr>');
                                }

                                // 注文へ進むボタンを表示
                                $('#form-button').css('display','inline-block');

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

            });

            {{-- 削除ボタンが押されるたびに実行 --}}
            $(document).on('click', '.delete', function () {

                {{-- トークンをmetaに設定し、送る --}}
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                        {{-- 入力値をdataに設定 --}}
                var data = {
                            product_name: $(this).val(),
                            "_token": "{{ csrf_token() }}"
                        };

                {{-- Ajax通信 --}}
                 $.ajax(
                        {
                            type: "POST",
                            url: "/pizzzzza/order/accept/customer/cart/delete",
                            data: data,
                            success: function (cart) {
                                // #cartを初期化
                                $('#cart').empty();

                                // カートに存在する、商品の種類数
                                var length = Object.keys(cart["cart"]).length;

                                // カート内に商品が入っていれば表示
                                if(length > 0) {

                                    // #cart内に一行ずつ、商品を書き足し
                                    $.each(cart["cart"], function (product_name, val) {

                                        // 一行書き出し
                                        $('#cart').append('<tr class="item"><td>' + product_name + '</td><td><select class="select form-control ' + product_name + '" id="' + product_name + '" name="'+ product_name +'"'+'"></select></td> <td class="ac"><button class="btn btn-danger btn-sm delete" name="product_name" value="' + product_name + '">削除</button></td></tr>');

                                        // selectタグ内に追加
                                        var max = 11;
                                        for (var i = 0; i < max; i++) {
                                            if (i == val) {
                                                $("." + product_name + "").append('<option value="' + i + '" selected>' + i + '</option>');
                                            } else {
                                                $("." + product_name + "").append('<option value="' + i + '">' + i + '</option>');
                                            }
                                        }
                                    });

                                // カート内に商品が入っていない場合
                                }else{
                                    $('#cart').append('<tr class="item"><td colspan="3">空です</td></tr>');
                                }

                                // 注文へ進むボタンを表示
                                $('#form-button').css('display','inline-block');

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

            });
        });

        {{-- カート固定 --}}
        $(function () {
            var $sidebar = $("#sidebar"),
                    $window = $(window),
                    width = $(window).width(),
                    offset = $sidebar.offset(),
                    topPadding = 15;

            $window.scroll(function () {
                if (width > 991) {

                }
                if ($window.scrollTop() > offset.top) {
                    $sidebar.stop().css({
                        marginTop: $window.scrollTop() - offset.top + topPadding
                    })
                } else {
                    $sidebar.stop().css({
                        marginTop: 0
                    });
                }
            });
        });

        {{-- form submit --}}
        $(function () {
            $('#form-bottom').click(function () {
                var form = $(this).parent();
                $(form).submit();
            });
        })
    </script>
@endsection