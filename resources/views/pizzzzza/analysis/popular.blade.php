@extends('template/admin')

@section('title', '売れ筋')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/analysis/index.css" media="all" title="no title">
@endsection

@section('main')
    <div class="wrap">
        <h1>売れ筋商品</h1>
        <div class="row">
            <div class="graph col-sm-6">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.js"></script>
                <div id="graph">
                   <canvas id="chart"></canvas>
                    <?php   // グラフで用いる、$labelと$dataを動的に生成する処理
                        $label = ""; // 結果格納用
                        $data = ""; // 結果格納用
                        $populars_num = count($populars); // 人気商品の数
                        $other_data = 0; // その他
                        $total = 0; // 人気商品　売上数の合計
                        $num = 0; // 人気商品　売上数の合計（割合算出用。for文で$iの個数を足してゆく。）

                        // トータルを算出
                        for($i=0; $i < $populars_num; $i++){
                            $total += $populars[$i]["number_of_sales"];
                        }

                        // グラフ用のデータを、$labelと$dataに文字列として保存。
                        for($i = 0; $i < $populars_num; $i++){

                            // 現在の割合を算出（全体の7割を越えれば、それ以降分は"その他"にまとめる。
                            $percentage = $num / $total;
                            $num += $populars[$i]["number_of_sales"];
                            echo $percentage;

                            // 5件以上人気商品がある場合は、"その他"に集約するためのif文
                            if($percentage < 0.7){
                                if($i != 0){
                                    $label = $label . ',';
                                    $data = $data . ',';
                                }
                                $label = $label . '"' . $populars[$i]["product_info"]->product_name . '"';
                                $data = $data . '"' . $populars[$i]["number_of_sales"] . '"';
                            } else if($i+1 == $populars_num){  // その他を出力
                                $label = $label . ',"その他"';
                                $data = $data . ',"' . $other_data . '"';
                            } else { // その他を作成
                                $other_data += $populars[$i]["number_of_sales"];
                            }
                    }
                    ?>
                    <script>
                     var ctx = document.getElementById('chart').getContext('2d');
                     var chart = new Chart(ctx, {
                         type: 'pie',
                         data: {
                             labels: [{!!  $label !!}],
                             datasets: [{
                                 label: 'Populars',
                                 data: [{!! $data !!}],
                                 backgroundColor: "tomato"
                             }]
                         }
                     });
                     </script>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>順位</th>
                        <th>商品名</th>
                        <th>売上数</th>
                        <th>シェア率</th>
                    </tr>
                    </thead>
                    <tbody id="insert-here">
                    <?php $i = 1; ?>
                    @foreach($populars as $popular)
                        @if($i === 1)
                            <tr id="no1">
                        @elseif($i === 2)
                            <tr id="no2">
                        @elseif($i === 3)
                            <tr id="no3">
                        @else
                            <tr>
                                @endif
                                <td><?php echo $i++; ?> 位</td>
                                <td>{{ $popular["product_info"]->product_name }}</td>
                                <td>{{ $popular["number_of_sales"] }}</td>
                                <td>{{ $popular["share"] }}%</td>
                            </tr>
                            @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-sm-6">
                <div>条件</div>
                <div id="conditions_errors">{{-- ajax時のエラーが入ります。--}}</div>
                <form action="/pizzzzza/analysis/popular/apply" method="POST">
                    <table class="table">
                        <tr>
                            <th>ジャンル</th>
                            <td>
                                <div class="radio-inline">
                                    <lavel><input type="radio" name="genre" value="pizza">ピザ</lavel>
                                </div>
                                <div class="radio-inline">
                                    <lavel><input type="radio" name="genre" value="side">サイド</lavel>
                                </div>
                                <div class="radio-inline">
                                    <lavel><input type="radio" name="genre" value="drink">ドリンク</lavel>
                                </div>
                                <div class="radio-inline">
                                    <lavel><input type="radio" name="genre" value="none" checked>指定しない</lavel>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>性別</th>
                            <td>
                                <div class="radio-inline">
                                    <lavel><input type="radio" name="gender" value="man">男</lavel>
                                </div>
                                <div class="radio-inline">
                                    <lavel><input type="radio" name="gender" value="woman">女</lavel>
                                </div>
                                <div class="radio-inline">
                                    <lavel><input type="radio" name="gender" value="none" checked>指定なし</lavel>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>会員種別</th>
                            <td>
                                <div class="radio-inline">
                                    <lavel><input type="radio" name="member_type" value="phone">電話</lavel>
                                </div>
                                <div class="radio-inline">
                                    <lavel><input type="radio" name="member_type" value="web">ウェブ</lavel>
                                </div>
                                <div class="radio-inline">
                                    <lavel><input type="radio" name="member_type" value="none" checked>指定なし</lavel>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>期間</th>
                            <td class="">
                                <div class="">
                                    <div class="radio-inline">
                                        <lavel><input type="radio" name="period" value="check"
                                                      onclick="period_check(1)">指定する
                                        </lavel>
                                    </div>
                                    <div class="radio-inline">
                                        <lavel><input type="radio" name="period" value="none" onclick="period_check(2)"
                                                      checked>指定しない
                                        </lavel>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="period" style="display:none">
                            <th>開始日</th>
                            <td>
                                <lavel><input type="date" class="form-control" name="start_date" value="">
                                </lavel>
                            </td>
                        </tr>
                        <tr class="period" style="display:none">
                            <th>終了日</th>
                            <td>
                                <lavel><input type="date" class="form-control" name="end_date" value="">
                                </lavel>
                            </td>
                        </tr>
                        <tr>
                            <th>年代（ウェブ会員）</th>
                            <td>
                                <select name="older" id="" class="form-control">
                                    <option value="0" selected>指定なし</option>
                                    <option value="10">〜満10代</option>
                                    <option value="20">満20代</option>
                                    <option value="30">満30代</option>
                                    <option value="40">満40代</option>
                                    <option value="50">満50代</option>
                                    <option value="60">満60代〜</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    {{ csrf_field() }}
                    <div class="ar">
                        <input type="submit" id="submit-btn" class="btn btn-primary btn-sm" name="" value="適用">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{--  Graph  --}}
    <script src="https://d3js.org/d3.v4.min.js"></script>


    {{--  ajax  --}}
    <script type="text/javascript">
        $(function () {
            $('#submit-btn').click(function () {

                // HTMLでの送信をキャンセル
                event.preventDefault();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax(
                        {
                            type: "POST",
                            url: "/pizzzzza/analysis/popular/apply",
                            data: $(this.form).serialize(),

                            success: function (result) {

                                $("#conditions_errors").text("");
                                if(result["error"]){
                                    $("#conditions_errors").append('<div class="alert alert-danger"><ul><li>'+ result["error"] +'</li></ul></div>');
                                    exit;
                                }

                                if(result.length > 0 || result["check_flg"] == 1){
                                    $("#insert-here").text("");
                                    var rank = 0;
                                    var share;
                                    for(var i in result){
                                        {{-- 小数点以下の桁数を取得し、2桁以上あれば1桁に。--}}
                                        share = result[i]["share"];
                                        var numbers = String(share).split('.'), num_result  = 0;
                                        if (numbers[1]) {
                                            num_result = numbers[1].length;
                                        }
                                        if(num_result > 1){
                                            share  = result[i]["share"].toFixed(1);
                                        }

                                        $("#insert-here").append("<tr><td>"+ ++rank + "位</td>" + "<td>" + result[i]["product_info"]["product_name"] + "</td>" + "<td>" + result[i]["number_of_sales"] + "</td>" + "<td>" + share + "%</td></tr>");
                                    }

                                } else {
                                    $("#insert-here").text("条件に合致するデータが存在しませんでした。");
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
        })
    </script>

    {{--  FORM  --}}
    <script type="text/javascript">
        function period_check(status) {
            if (status === 1) {
                $('.period').css('display', 'table-row');
            } else {
                $('.period').css('display', 'none');
            }
        }
    </script>
@endsection