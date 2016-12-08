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
            <div id="customers" class="form-group table-responsive">
                <h1 id="title">顧客情報</h1>
                <table id="customer-detail" class="table table-bordered">
                    <tr>
                        <th>氏名</th>
                        <th>郵便番号</th>
                        <th>住所</th>
                        <th>会員種別</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {

            $('#phone-submit').click(function () {

                //毎回初期化
                $("#customers").css('display', 'none');
                $('.customer').remove();

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

                                if (code["check"]["status"] == "true") {

                                    $("#customers").css('display', 'block');
                                    $("#customer-detail").css('display', 'inline-table');  //.removeClass('coupon-true').addClass('coupon-false');
                                    //$('#customer-detail').text(code["message"]);

                                    //人数分出力
                                    var cnt = code["users"].length;
                                    for (var i = 0; i < cnt; i++) {

                                        if(code["users"][i]["address3"] == null){
                                            code["users"][i]["address3"] = "";
                                        }

                                        if(code["users"][i]["authority_id"] == 3){
                                            code["users"][i]["authority_id"] = "WEB";
                                        }else if(code["users"][i]["authority_id"] == 4){
                                            code["users"][i]["authority_id"] = "PHONE";
                                        }

                                        $('#customer-detail').append(
                                                "<tr class=\"customer link\" data-href=\"/pizzzzza/order/accept/customer/detail?"+ code["users"][i]["id"] +"\"><td>"+ code["users"][i]["name"] + "</td>" +
                                                "<td>" + code["users"][i]["postal"] + "</td>" +
                                                "<td>" + code["users"][i]["address1"] + " " + code["users"][i]["address2"] + " " + code["users"][i]["address3"] + "</td>" +
                                                "<td>" + code["users"][i]["authority_id"] + "</td></tr>"
                                        );

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


        $('.table tr[data-href]').addClass('clickable').click(function () {
            window.location = $(this).attr('data-href');
        }).find('a').hover(function () {
            $(this).parents('tr').unbind('click');
        }, function () {
            $(this).parents('tr').click(function () {
                window.location = $(this).attr('data-href');
            });
        });
    </script>
@endsection