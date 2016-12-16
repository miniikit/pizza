@extends('template/master')

@section('title', 'レジ')

@section('css')
    <link rel="stylesheet" href="/css/order/index.css" media="all" title="no title">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('plug')

@endsection

@section('main')
    <div class="container wrap">
        <h2 class="title">ORDER</h2>
        <form id="post" action="/order/confirm/insert" method="post">
            @if (Session::has('error_text'))
            <div class="alert error">{{ Session::get('error_text') }}</div>
            @endif
            <div class="userInfo">
                <div>
                    <ul>
                        <li class="title">お届け先住所</li>
                        <li>名前: <span>{{ $user->name }}</span></li>
                        <li>郵便番号: <span>{{ $user->postal }}</span></li>
                        <li>住所: <span>{{ $user->address1 . $user->address2 .$user->address3 }}</span></li>
                        <li>電話番号: <span>{{ $user->phone }}</span></li>
                    </ul>
                </div>
                <div>
                    <ul>
                        <li class="title">支払い方法</li>
                        <li>代引き</li>
                        <li class="cap">※本サービスは代引き以外の支払い方法には対応していません。</li>
                        <li class="cap">※注文が確定した場合、キャンセルはできません。ご了承ください。</li>
                    </ul>
                </div>
                <div class="special">
                    <ul>
                        <li class="title">配達希望日時</li>
                        <li><label for=""><span>日付</span><input type="date" name="date" value="{{ \Carbon\Carbon::now()->toDateString() }}"></label></li>
                        <li><label for=""><span>時刻</span><input type="time" name="time" value="{{ \Carbon\Carbon::now()->addHour()->format('H:i') }}"></label></li>
                        <li class="cap">※デフォルトでは現在時刻の1時間後になっております</li>
                    </ul>
                </div>
                <div class="coupon">
                    <ul>
                        <li class="title">クーポン</li>
                        <li><input id="coupon_text" type="text" name="coupon" value="" placeholder="クーポンコードを入力してください"><a id="coupon-btn" class="input-btn" href="#">適用</a></li>
                        <li><div id="coupon-message"></div></li>
                    </ul>
                </div>
                <div class="sum">
                    <h3>合計金額 <span id="total">{{ number_format($total) }} 円</span></h3>
                </div>
                <div class="cap ar ls">※24時間いつでも。どこでも配達いたします。</div>
            </div>
            <div class="products">
                <h3 class="title">注文内容</h3>
                <table id="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>商品名</th>
                            <th>金額</th>
                            <th>数量</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td><img src="{{$product->product_image}}" alt="" /></td>
                            <td>{{$product->product_name}}</td>
                            <td>{{number_format($product->productPrice->product_price)}}円</td>
                            <td>{{$productCount[$product->id]}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="btn">
                <div class="inner special"><a href="/menu">カートに戻る</a></div>
                <div class="inner"><a id="submit" >購入する</a></div>
            </div>
            {{ csrf_field() }}
        </form>
        <form id="post_coupon" action="/order/confirm/coupon/" method="post">
            <input id="post_coupon_num" type="hidden" name="coupon_num" value="">
        </form>
    </div>
@endsection

@section('script')
<script type="text/javascript">

    var clicked = false;
    $('#submit').on('click',function () {
        if(!clicked) {
            clicked = true;
            $('#post').submit();
        }
    })

    $('#coupon-btn').on('click',function () {
        var num = $('#coupon_text').val();
        $('#post_coupon_num').val(num);
        // $('#post_coupon').submit();
    })


    $(function()
    {
        $('#coupon-btn').click(function()
        {
            {{-- トークンをmetaに設定し、送る --}}
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            {{-- 入力値をdataに設定 --}}
            var data = {number : $('#post_coupon_num').val()};

            $.ajax(
                    {
                        type:"POST",
                        url: "/order/confirm/coupon",
                        data: data,
                        success: function(message, dataType)
                        {
                            alert(message);
                            //値引き後金額
                            if(message["status"] == "error"){
                                $("#coupon-message").css('display','inline-block').removeClass('coupon-true').addClass('coupon-false');
                                $('#coupon-message').text(message["message"]);
                            }else if(message["status"] == "ok"){
                                $("#coupon-message").css('display','inline-block').removeClass('coupon-false').addClass('coupon-true');
                                $('#coupon-message').text(message["message"]);
                                var newTotal = String(message["newTotal"]).toString().replace(/(\d)(?=(\d{3})+$)/g, '$1,');
                                $("#total").text(newTotal + "円");
                            }else{
                                //なにも設定されていない
                                $("#coupon-message").css('display','inline-block').removeClass('coupon-true').addClass('coupon-false');
                                $('#coupon-message').text("クーポンコードが不正です");
                            }
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
