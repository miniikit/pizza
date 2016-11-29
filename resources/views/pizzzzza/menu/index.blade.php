@extends('template/admin')

@section('title', 'メニュー一覧')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/menu/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order/top">ホーム</a></li>
        <li class="active">商品一覧</li>
    </ol>
@endsection

@section('main')
    <h1>商品一覧</h1>

    <div class="form-group table-responsive">

        @if(session()->has('message'))
            <?php $a = session()->pull('message'); ?>
            <div class="{{$a["class"]}}">
                {{ $a["text"] }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="text-align: center;">ID</th>
                <th>メニュー名</th>
                <th style="text-align: center;">価格</th>
                <th style="text-align: center;">販売開始日</th>
                <th style="text-align: center;">販売終了日</th>
            </tr>
            </thead>
            <tbody>
            @if($products)
                @foreach ($products as $product)
                    <tr class="link" data-href="/pizzzzza/employee/{{ $product->product_id }}/show" >
                        <td style="width:5%;text-align: center;">{{ $product->product_id }}</td>
                        <td style="width:20%;">{{ $product->product_name }}</td>
                        <td style="text-align: center;">{{ number_format($product->product_price )}}円</td>
                        <td style="text-align: center;">{{ $product->sales_start_date }}</td>
                        <td style="text-align: center;">
                            @if ($product->sales_end_date == null)
                                未設定
                            @else
                                {{ $product->sales_end_date }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
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