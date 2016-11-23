@extends('template/master')

@section('title', 'レジ')

@section('css')
    <link rel="stylesheet" href="/css/order/index.css" media="all" title="no title">
@endsection

@section('plug')

@endsection

@section('main')
    <div class="container wrap">
        <h2 class="title">ORDER</h2>
        <div class="userInfo">
            <div>
                <ul>
                    <li class="title">お届け先住所</li>
                    <li>名前: <span>近澤 邦彦</span></li>
                    <li>郵便番号: <span>232-3232</span></li>
                    <li>住所: <span>大阪府大阪市東和町1-1-1</span></li>
                    <li>電話番号: <span>080192939493</span></li>
                </ul>
            </div>
            <div>
                <ul>
                    <li class="title">支払い方法</li>
                    <li>代引き</li>
                    <li class="cap">※本サービスは代引き以外の支払い方法には対応していません。</li>
                    <li class="cap">※注文が確定した場合、キャンセルはできません。ご了承ください。</li>
                </ul>
            </div>
            <div class="special">
                <ul>
                    <li class="title">配達希望日時</li>
                    <li><label for=""><span>日付</span><input type="date" name="date" value=""></label></li>
                    <li><label for=""><span>時刻</span><input type="time" name="date" value=""></label></li>
                </ul>
            </div>
        </div>
        <div class="products">

        </div>
        <div class="coupon">
            <div class="inner">
                <h3>クーポン</h3>
            </div>
            <div class="input">
                <input type="text" name="name" value="" placeholder="クーポンコードを入力してください">
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
