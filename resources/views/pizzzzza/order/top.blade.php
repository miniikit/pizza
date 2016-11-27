@extends('template.admin')

@section('title', '注文確認')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/order/index.css" media="all" title="no title">
@endsection

@section('js')
    <script>
        $(function()
        {
            $('#GetAddress').click(function()
            {
                {{-- トークンをmetaに設定し、送る --}}
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });



                {{--  どのラジオボタンが選択されたか  --}}
                var radio = document.getElementsByName("selected_id");
                var ans = 0;
                for(var i=0; i<radio.length; i++){
                    if (radio[i].checked) {
                        ans = radio[i].value;
                        break;
                    }
                }
                if(ans == 0){
                    alert('注文IDを選択してください');
                    exit;
                }

                // valueをセット
                //  document.getElementById('abc').value=a;

                // 文字を追加？
                //  document.getElementById("result").innerHTML = str;

                {{--  ansをorderIdに設定  --}}
                document.getElementById('orderId').value=ans;

                {{-- 入力値(orderId)をdataに設定 --}}
                var data = {order_id : $('#orderId').val()};

                $.ajax(
                        {
                            type:"GET",
                            url: "/pizzzzza/order/get",
                            data: data,
                            success: function(address, dataType)
                            {
                                {{--  顧客情報をJSで書き換え  --}}
                                if(address["status"] == "error"){
                                    alert('errです');
                                }else if(address["status"] == "ok"){
                                    $("#customer-address").css('display','block');
                                    alert('OK');
                                    $("#cst-postal").text(address["postal"]);
                                    $("#cst-address1").text(address["address1"]);
                                    $("#cst-address2").text(address["address2"]);
                                    if(!address["address3"]){
                                        alert('メモ：建物名はNULLなので非表示');
                                        $("#cst-address3").text('');
                                    }else {
                                        $("#cst-address3").text(address["address3"]);
                                    }
                                    $("#cst-name").text(address["name"]);
                                    $("#cst-name-kana").text(address["name_kana"]);
                                    $("#cst-phone").text(address["phone"]);
                                    $("#cst-menu").text('menu未実装');
                                    $("#cst-total").text('total未実装');
                                    $("#cst-coupon").text('coupon未実装');

                                }else{
                                    $("#customer-address").css('display','none');
                                    alert('DBから該当の注文IDが見つかりませんでした');

                                    //なにも設定されていない
                                    // $("#customer-address").css('display','inline-block').removeClass('coupon-true').addClass('coupon-false');
                                    // $('#customer-address').text("クーポンコードが不正です");
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

@section('main')
    <div class="wrap">
        <h1>注文確認</h1>
        <div class="container">
            <div id="customer-address" style="display:none">
                <table class="table">
                    <tr>ステータス名</tr>
                    <tr>
                        <th>郵便番号</th>
                        <th>住所</th>
                        <th>氏名</th>
                        <th>電話番号</th>
                        <th>注文内容</th>
                        <th>クーポン</th>
                        <th>受取金額</th>
                    </tr>
                    <tr>
                        <td id="cst-postal">555-1111</td>
                        <td id="cst-address">
                            <div id="cst-address1">住所１</div>
                            <div id="cst-address2">住所２</div>
                            <div id="cst-address3">住所３</div>
                        </td>
                        <td>
                            <div id="cst-name">氏名</div>
                            <div id="cst-name-kana">カタカナ</div>
                        </td>
                        <td id="cst-phone">電話番号</td>
                        <td id="cst-menu">マルゲリータ　１</td>
                        <td id="cst-coupon">クーポン番号</td>
                        <td id="cst-total">５５０００円</td>
                    </tr>
                </table>
            </div>

            <a href="#" id="GetAddress">選択した顧客情報を確認</a>

            <h3>商品情報</h3>
            <div id="order-top">
                <form action="/pizzzzza/order/get" method="post">
                    <input id="orderId" type="hidden" name="order_id" value="">
                    <table class="table"> <!-- サンプル -->
                        <thead>
                        <tr>
                            <th>{{-- ID --}}</th>
                            <th>注文番号</th>
                            <th>商品名</th>
                            <th>個数</th>
                            <th>合計</th>
                            <th>配達希望日時</th>
                        </tr>
                        </thead>

                        @foreach($orders as $order)
                            {{--  オーダーIDが同じものだけをグループ化（tbody）するための前処理  --}}
                            @if(session()->has('orders_top_tmp_id'))
                            @else
                                <?php session()->put('orders_top_tmp_id',$order->id); ?>
                            @endif
                            @if($order->id == session()->get('orders_top_tmp_id'))
                                <tr>
                            @else
                                <tbody>
                                <tr>
                                    <td class="group_{{  $order->id }}" rowspan="2">
                                        <input type="radio" name="selected_id" value="{{ $order->id }}">
                                    </td>
                            @endif
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->price_id }}</td>
                                    <td>{{ $order->number }}</td>
                                    <td>{{ $order->price_id }}</td>
                                    <td>{{ $order->order_appointment_date }}</td>
                                </tr>
                            @if($order->id == session()->get('orders_top_tmp_id'))
                                </tbody>
                            @else
                                <?php session()->forget('orders_top_tmp_id'); ?>
                                <?php session()->put('orders_top_tmp_id',$order->id);?>
                            @endif
                        @endforeach
                    </table>
                    <input type="hidden" name="_token" value="{{  csrf_token() }}">
                </form>
            </div>
            <div class="text-right">
                <a href="#" class="btn btn-primary btn-lg">戻る</a>
                <a href="#" class="btn btn-primary btn-lg">決定</a>
            </div>
        </div>
    </div>
@endsection
