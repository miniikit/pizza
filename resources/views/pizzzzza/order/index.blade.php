@extends('template.admin')

@section('title', '注文確認')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/order/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order/top">ホーム</a></li>
        <li class="active">注文確認</li>
    </ol>
@endsection

@section('main')
    <h1>注文確認</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div id="order-top">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>注文番号</th>
                            <th>合計</th>
                            <th>配達希望日時</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->price_id }}</td>
                                <td>{{ $order->order_appointment_date }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-7">.col-md-7</div>
        </div>
    </div>
@endsection










@section('script')
    <script>
        $(function () {
            $('#GetAddress').click(function () {
                {{-- トークンをmetaに設定し、送る --}}
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });


                        {{--  どのラジオボタンが選択されたか  --}}
                var radio = document.getElementsByName("selected_id");
                var ans = 0;
                for (var i = 0; i < radio.length; i++) {
                    if (radio[i].checked) {
                        ans = radio[i].value;
                        break;
                    }
                }
                if (ans == 0) {
                    alert('注文IDを選択してください');
                    exit;
                }

                // valueをセット
                //  document.getElementById('abc').value=a;

                // 文字を追加？
                //  document.getElementById("result").innerHTML = str;

                {{--  ansをorderIdに設定  --}}
                document.getElementById('orderId').value = ans;

                        {{-- 入力値(orderId)をdataに設定 --}}
                var data = {order_id: $('#orderId').val()};

                $.ajax(
                        {
                            type: "GET",
                            url: "/pizzzzza/order/get",
                            data: data,
                            success: function (address, dataType) {
                                {{--  顧客情報をJSで書き換え  --}}
                                if (address["status"] == "error") {
                                    alert('errです');
                                } else if (address["status"] == "ok") {
                                    $("#customer-address").css('display', 'block');
                                    alert('OK');
                                    $("#cst-postal").text(address["postal"]);
                                    $("#cst-address1").text(address["address1"]);
                                    $("#cst-address2").text(address["address2"]);
                                    if (!address["address3"]) {
                                        alert('メモ：建物名はNULLなので非表示');
                                        $("#cst-address3").text('');
                                    } else {
                                        $("#cst-address3").text(address["address3"]);
                                    }
                                    $("#cst-name").text(address["name"]);
                                    $("#cst-name-kana").text(address["name_kana"]);
                                    $("#cst-phone").text(address["phone"]);
                                    $("#cst-menu").text('menu未実装');
                                    $("#cst-total").text('total未実装');
                                    $("#cst-coupon").text('coupon未実装');

                                } else {
                                    $("#customer-address").css('display', 'none');
                                    alert('DBから該当の注文IDが見つかりませんでした');

                                    //なにも設定されていない
                                    // $("#customer-address").css('display','inline-block').removeClass('coupon-true').addClass('coupon-false');
                                    // $('#customer-address').text("クーポンコードが不正です");
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
            });
        });
    </script>
@endsection