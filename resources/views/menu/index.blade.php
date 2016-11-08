
@extends('template/master')

@section('title', '個人情報保護方針')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('plug')

@endsection

@section('main')
    <div class="container wrap">
        {{ var_dump($products)}}
        @foreach ($products as $product)
            <div class="product">
                <div class="inner">
                    <div class="image"><img src="{{ $product->product_image }}" alt="" /></div>
                    <div class="title"><p>{{ $product->product_name }}</p></div>
                    {{-- <div class="praice"><p>{{ $product->product_price->product_price }}</p></div> --}}
                    <div class="praice"><p>praice</p></div>
                    <div class="text"><p>{{ $product->product_text }}</p></div>
                </div>
            </div>
            {{-- {{ $product }} --}}
        @endforeach
    </div>
@endsection

@section('scrip')

@endsection
