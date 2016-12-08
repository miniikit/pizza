@extends('template.admin')

@section('title', '電話注文')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
    <link rel="stylesheet" href="/css/pizzzzza/phone/index.css" media="all" title="no title">
@endsection

@section('main')
    <div class="wrap">
        <h1>電話注文</h1>
        <div id="tel">
            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">{{ $error }}</div>
                @endforeach
            @endif
            <form class="" action="/pizzzzza/order/accept/customer/check" method="post">
                <div class="form-group">
                    <input id="phone-number" type="text" class="form-control" placeholder="電話番号を入力してください" name="phone"
                           value="">
                </div>
                <a id="phone-submit" class="btn btn-primary btn-lg btn-block" href="#">確認</a>
                {{ csrf_field() }}
            </form>
            <div id="customer-detail" style="display: none;">

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {

            $('#phone-submit').click(function () {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var data = {
                    number: $('#phone-number').val(), {{-- 入力値をdataに設定 --}}
                    "_token": "{{ csrf_token() }}"
                };

                $.ajax(
                        {
                            type: "POST",
                            url: "/pizzzzza/order/accept/customer/check",
                            data: data,
                            success: function (code, users, dataType) {
                                //値引き後金額
                                if (code["check"]["status"] == "true") {
                                    $("#customer-detail").css('display', 'block');  //.removeClass('coupon-true').addClass('coupon-false');
                                    //$('#customer-detail').text(code["message"]);

                                    for (var i = 0; i < code["users"].length; i++) {
                                        //$('.customer0').text(code["users"][i]["address1"]);

                                        if(i = 0){
                                            $('#customer-detail').append("<table class=\"table\">");
                                        }
                                            $('#customer-detail').append(
                                                    "<tr><th>氏名</th> <th>郵便番号</th> <th>住所</th></tr>" +
                                                    "<tr><td>たたた</td> <td>111-1111</td> <td>aaaaaaaaaaaaaaaaaaaaa</td></tr>" +
                                                    );
                                        if(i = 0){
                                            $('#customer-detail').append("</table>");
                                        }

                                    }

                                } else if (code["status"] == "false") {
                                    $("#customer-detail").css('display', 'inline-block');
                                    $('#customer-detail').text(code["message"]);
                                    var newTotal = String(code["newTotal"]).toString().replace(/(\d)(?=(\d{3})+$)/g, '$1,');
                                    $("#total").text(newTotal + "円");
                                } else {
                                    //なにも設定されていない
                                    $("#customer-detail").css('display', 'inline-block').removeClass('coupon-true').addClass('coupon-false');
                                    $('#customer-detail').text("クーポンコードが不正です");
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