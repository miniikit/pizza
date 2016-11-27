@extends('template.admin')

@section('title', '電話注文')

@section('css')
    <link rel="stylesheet" href="/css/accept/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order/top">ホーム</a></li>
        <li class="active"><a href="/pizzzzza/order/accept/input">電話番号入力</a></li>
        <li class="active"><a href="/pizzzzza/order/accept/detail">お客様情報確認</a></li>
        <li class=""><a href="/pizzzzza/order/accept/edit">編集</a></li>
    </ol>
@endsection

@section('main')
    <div class="wrap">
        <h1>お客様情報確認</h1>
        <div class="form-group table-responsive">
            <form action="/pizzzzza/order/accept/item/select">
                <table class="table side">
                    <tbody>
                    <tr>
                        <th class="text-center"><label for="">登録日</label></th>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">名前(漢字)</label></th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">名前(カナ)</label></th>
                        <td>{{ $user->kana }}</td>
                    </tr>
                    @if(isset($user->birthday) || isset($user->gender))
                    <tr>
                        <th class="text-center"><label for="">生年月日</label></th>
                        <td>{{ $user->birthday }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">性別</label></th>
                        <td>{{ $user->gender->gender_name }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th class="text-center"><label for="">郵便番号</label></th>
                        <td>{{ $user->postal }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">住所1</label></th>
                        <td>{{ $user->address1 }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">住所2</label></th>
                        <td>{{ $user->address2 }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">住所3</label></th>
                        <td>{{ $user->address3 }}</td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">電話番号</label></th>
                        <td>{{ $user->phone }}</td>
                    </tr>
                    @if(isset($user->email))
                        <tr>
                        <th class="text-center"><label for="">メールアドレス</label></th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    @endif
                    </tbody>
                </table>
            </form>
        </div>
        <div class="text-center">
            <button type="button" class="btn btn-primary btn-lg" name="button">戻る</button>
            <button type="button" class="btn btn-primary btn-lg" name="button">次へ</button>
        </div>
        <div class="text-right">
            <a href="/pizzzzza/order/accept/customer/edit" type="button" class="btn btn-primary btn-lg"
               name="button">編集</a>
        </div>
    </div>
@endsection
