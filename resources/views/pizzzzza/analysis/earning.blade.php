<!DOCTYPE html>
@extends('template/admin')

@section('title', '売れ筋')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/analysis/index.css" media="all" title="no title">
@endsection

@section('main')
    <h1>売上確認</h1>
    <form action="#" method="POST">

    </form>

    <div class="dropdown mb">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="true">
            性別
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li><a href="#">性別</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">年代</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">期間</a></li>
        </ul>
    </div>
    <div class="ac">
        <img src="http://nmbr.jp/wp/wp-content/uploads/2015/02/mcdonaldhdjp.png" alt=""/>
    </div>
    <div class="row">
        <div class="col-md-8">
            <table class="table">
                <thead>
                <tr>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>クーポン使用率</th>
                    <th>売上数</th>
                    <th>売上金額</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-4">.col-md-4</div>
    </div>
@endsection
