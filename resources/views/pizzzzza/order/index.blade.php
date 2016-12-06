@extends('template.admin')

@section('title', '注文確認')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/order/index.css" media="all" title="no title">
    <link rel="stylesheet" href="/plug/Notifit/notifIt.css">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order">ホーム</a></li>
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
                            <th>配達場所</th>
                            <th>配達日時</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class="link" v-for="(order, index) in orders" v-on:click="showdetail(index)">
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
                <div class="">
                    <h3 class="title">注文内容</h3>
                    <table class="table table-borderd">

                    </table>
                    <div v-for="detail in detail.detail">

                        @{{ detail.product_price.product.product_name }}
                        @{{ detail.product_price.product.genre_id }}
                        @{{ detail.product_price.product_price }}
                        @{{ detail.number }}
                    </div>
                    <h3 class="title">注文情報</h3>
                    <table class="table table-borderd">
                        <tbody>
                            <tr>
                                <th>注文日</th>
                                <td>@{{ detail.order_date }}</td>
                            </tr>
                            <tr>
                                <th>配達日時</th>
                                <td>@{{ detail.order_appointment_date }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <h3 class="title">ユーザー情報</h3>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                              <th>名前</th>
                              <td>@{{ detail.user.name }}</td>
                            </tr>
                            <tr>
                              <th>フリガナ</th>
                              <td>@{{ detail.user.kana }}</td>
                            </tr>
                            <tr>
                              <th>性別</th>
                              <td><span v-if="detail.user.gender_id == 1">男</span><span v-if="detail.user.gender_id == 2">女</span></td>
                            </tr>
                            <tr>
                              <th>生年月日</th>
                              <td>@{{ detail.user.birthday }}</td>
                            </tr>
                            <tr>
                              <th>生年月日</th>
                              <td>@{{ detail.user.birthday }}</td>
                            </tr>
                            <tr>
                              <th>郵便番号</th>
                              <td>@{{ detail.user.postal }}</td>
                            </tr>
                            <tr>
                              <th>住所</th>
                              <td>@{{ detail.user.address1 + detail.user.address2 }} <span v-if="detail.user.address3 != null">@{{ detail.user.address3 }}</span></td>
                            </tr>
                            <tr>
                              <th>電話番号</th>
                              <td>@{{ detail.user.phone }}</td>
                            </tr>
                            <tr>
                              <th>メールアドレス</th>
                              <td>@{{ detail.user.email }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="/plug/Notifit/notifIt.min.js" charset="utf-8"></script>
    <script src="/js/vender.js" charset="utf-8"></script>
    <script src="/js/order/index.js" charset="utf-8"></script>
@endsection
