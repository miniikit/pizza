@extends('template.admin')

@section('title', '注文確認')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/order/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order/top">ホーム</a></li>
        <li class="active">注文確認</li>
    </ol>
@endsection

@section('main')
    <h1>注文確認</h1>
    <div class="container">
        <div id="app" class="row">
            <div class="col-md-6">
                <div id="order-top">
                    <table class="table">
                        <thead>
                        <tr >
                            <th>注文番号</th>
                            <th>名前</th>
                            <th>場所</th>
                            <th>配達希望日時</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class="link" v-for="(order, index) in orders">
                                <td>@{{ index + 1 }}</td>
                                <td>@{{ order.user.name }}</td>
                                <td>@{{ order.user.address1 + order.user.address2}} <span v-if="order.user.address3 != null">@{{ order.user.address3 }}</span></td>
                                <td>@{{ order.order_appointment_date }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">

            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="/plug/Notifit/notifIt.min.js" charset="utf-8"></script>
    <script src="/js/vender.js" charset="utf-8"></script>
    <script src="/js/order/index.js" charset="utf-8"></script>
@endsection
