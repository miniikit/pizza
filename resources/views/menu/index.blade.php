
@extends('template/master')

@section('title', 'メニュー')

@section('css')
    <link rel="stylesheet" href="/css/menu/index.css" media="all" title="no title">
@endsection

@section('plug')

@endsection

@section('main')
    <div class="container wrap">
        <div class="productsBox">
        @foreach ($products as $product)
            <div class="product">
                <div class="inner">
                    <div class="image"><img src="{{ $product->product_image }}" alt="" /></div>
                    <div class="title"><h3>{{ $product->product_name }}</h3></div>
                     <div class="praice"><p>{{ $product->productPrice->product_price }}円</p></div>
                    <div class="text"><p>{{ $product->product_text }}</p></div>
                    <div class="btn">{{ $product->id }}</div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection

@section('scrip')

@endsection
