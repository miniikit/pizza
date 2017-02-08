@extends('template/admin')

@section('title', '売れ筋')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/analysis/index.css" media="all" title="no title">
@endsection

@section('main')
    <div class="wrap">
        <h1>売れ筋商品</h1>
        <div class="">
            <table class="table">
                <thead>
                <tr>
                    <th>順位</th>
                    <th>商品名</th>
                    <th>売上数</th>
                </tr>
                </thead>
                <tbody>
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
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="">
            <img src="images/test/popular.jpeg" alt=""/>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://d3js.org/d3.v4.min.js"></script>
@endsection