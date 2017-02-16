<!DOCTYPE html>
@extends('template/admin')

@section('title', '売れ筋')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/analysis/index.css" media="all" title="no title">
@endsection

@section('main')
    <h1>売上確認</h1>
    <div class="row">
        <div class="col-md-12">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.js"></script>
            <div id="graph">
                <canvas id="chart"></canvas>
                <?php
                    $label = "";
                    $data = "";
                    $i = 0;
                    foreach($earning["sales"] as $part){
                        if($i != 0){
                            $label = $label . ',';
                            $data = $data . ',';
                        }
                        $label = $label . '"' . $part["period_date"] . '"';
                        $data = $data . '"' . $part["sales_amount"] . '"';
                        $i++;
                    }//dd($label,$data)
                ?>
                <script>
                    var ctx = document.getElementById('chart');
                    var chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: [{!!  $label !!}],
                            datasets: [{
                                label: '売上高',
                                data: [{!! $data !!}],
                                backgroundColor: "tomato"
                            }]
                        }
                    });
                </script>
            </div>
        </div>
    </div>
    <!--
    <div class="dropdown mb">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="true">
            性別
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="#">性別</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">年代</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">期間</a></li>
        </ul>
    </div>
    !-->
    <div id="graph" class="ac">

    </div>
    <div class="row">
        <div class="col-md-8">
            <table class="table">
                <thead>
                <tr>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>クーポン使用率</th>
                    <th>売上数</th>
                    <th>売上金額</th>
                </tr>
                </thead>
                <tbody>
                @foreach($populars as $popular)
                    <tr>
                        <td>{{ $popular["product_info"]->product_name }}</td>
                        <td>{{ number_format($popular["product_info"]->product_price) }}円</td>
                        <td>{{ $popular["coupon_percentage"] }}%</td>
                        <td>{{ $popular["number_of_sales"] }}個</td>
                        <td>{{ number_format($popular["number_of_sales"] * $popular["product_info"]->product_price) }}円
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <table class="table">
                <tr>
                    <th>受注機会</th>
                    <td>{{ $earning["orders_count"] }}回</td>
                </tr>
                <tr>
                    <th>取引完了数</th>
                    <td>{{ $earning["orders_finish_count"] }}回</td>
                </tr>
                <tr>
                    <th>キャンセル数</th>
                    <td>{{ $earning["cancel_count"] }}回</td>
                </tr>
                <tr>
                    <th>キャンセル率</th>
                    <td>{{ $earning["cancel_percentage"] }}%</td>
                </tr>
                <tr>
                    <th>クーポン使用回数</th>
                    <td>{{ $earning["coupon_count"] }}回</td>
                </tr>
                <tr>
                    <th>クーポン使用率</th>
                    <td>{{ $earning["coupon_percentage"] }}%</td>
                </tr>
                <tr>
                    <th>累計受注金額</th>
                    <td>{{ number_format($earning["sales_amount_total"]) }}円</td>
                </tr>
                <tr>
                    <th>クーポン使用金額</th>
                    <td>{{ number_format($earning["coupon_discount"]) }}円</td>
                </tr>
                <tr>
                    <th>売上高（販促費込み）</th>
                    <td>{{ number_format($earning["sales_amount"]) }}円</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
