@extends('template.admin')

@section('title', '電話注文')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('main')
    <div class="wrap">
        <h1>商品選択</h1>
        <form action="#">
            <div class="product">
                <div class="image"><image src=""></image></div>
                <div class="title"></div>
                <div class="price"></div>
                <div class="sum"></div>

            </div>
        </form>
    </div>
@endsection
