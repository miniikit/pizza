@extends('template/admin')

@section('title', '商品履歴')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/menu/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order">ホーム</a></li>
        <li class="active">商品履歴</li>
    </ol>
@endsection

@section('main')
    <h1>商品履歴</h1>

    <div class="form-group table-responsive">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th style="text-align: center;">ID</th>
                <th>商品名</th>
                <th style="text-align: center;">価格</th>
                <th style="text-align: center;">ジャンル</th>
                <th style="text-align: center;">販売開始日</th>
                <th style="text-align: center;">販売終了日</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)
                <tr class="link" data-href="/pizzzzza/menu/{{ $product->id }}/show">
                    <td style="width:5%;text-align: center;">{{ $product->id }}</td>
                    <td style="width:20%;">{{ $product->product_name }}</td>
                    <td style="text-align: center;">{{ number_format($product->productPrice->product_price )}}円</td>
                    <td style="text-align: center;">{{ $product->genre->genre_name }}</td>
                    <td style="text-align: center;">{{ \Carbon\Carbon::parse($product->sales_start_date)->format('Y年m月d日') }}</td>
                    <td style="text-align: center;">
                        @if ($product->sales_end_date == null)
                            未設定
                        @else
                            {{ \Carbon\Carbon::parse($product->sales_end_date)->format('Y年m月d日') }}
                        @endif
                    </td>
                </tr>
            @endforeach
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
