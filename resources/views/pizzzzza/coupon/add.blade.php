@extends('template.admin')

@section('title', 'Coupon')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('main')
<h1>クーポン新規発行</h1>
<div class="menu_wrap">
<ul>
<li><a class="btn btn-primary btn-block" href="/pizzzzza/coupon/add/discount/input">値引き</a></li>
<li><a class="btn btn-primary btn-block" href="/pizzzzza/coupon/add/gift/input">プレセント</a></li>
</ul>
</div>
@endsection