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
            <div class="col-md-5">
                <div id="order-top">
                    <table class="table">
                        <thead>
                        <tr >
                            <th>注文番号</th>
                            <th>合計</th>
                            <th>配達希望日時</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="order in orders">
                                <td>@{{ i }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-7">

            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="/js/common/vue.js" ></script>
    <script src="/js/common/vue-resource.min.js" charset="utf-8"></script>
    <script src="/js/order/index.js" charset="utf-8"></script>
@endsection
