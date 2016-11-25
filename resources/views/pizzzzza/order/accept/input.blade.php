@extends('template.admin')

@section('title', '電話注文')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
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
            <form class="" action="/pizzzzza/order/accept/customer/detail" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="電話番号を入力してください" name="phone" value="">
                </div>
                <input type="submit" class="btn btn-primary btn-lg btn-block">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection
