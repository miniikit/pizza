@extends('template.admin')

@section('title', '電話注文')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('js')
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
    <script>

    </script>
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order/top">ホーム</a></li>
        <li class="active"><a href="/pizzzzza/order/accept/input">電話番号入力</a></li>
        <li class="active">お客様情報確認</li>
        <li class="active">編集</li>
    </ol>
@endsection

@section('main')
    <div class="wrap">
        <h1>お客様情報編集</h1>

        @if(isset($user))
        <form action="/pizzzzza/order/accept/customer/handler" method="post">
            <div class="form-group table-responsive">
                <table class="table">
                    <tbody>
                    <tr>
                        <th class="text-center"><label for="">氏名(漢字)</label></th>
                        <td><input class="form-control" type="text" name="name" value="{{ $user->name }}" placeholder="姓"></td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">氏名(カナ)</label></th>
                        <td><input class="form-control" type="text" name="name" value="{{ $user->kana }}" placeholder="セイ"></td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">郵便番号</label></th>
                        <td><input class="form-control" maxlength="8" type="text" name="zip11" size="10" maxlength="8" value="{{ $user->postal }}"
                                   placeholder="ハイフンなし" onKeyUp="AjaxZip3.zip2addr(this,'','addr11','addr11');"></td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">住所</label></th>
                        <td><input class="form-control" type="text" name="addr11" value="{{ $user->address1 }}" size="60" placeholder="市区町村"></td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">番地</label></th>
                        <td><input class="form-control" type="text" name="name" value="{{ $user->address2 }}" placeholder="番地"></td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">建物名</label></th>
                        <td><input class="form-control" type="text" name="name" value="{{ $user->address3 }}" placeholder="建物名"></td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">電話番号</label></th>
                        <td><input class="form-control" type="number" name="phone" value="{{ $user->phone }}" placeholder=""></td>
                    </tr>
                    </tbody>

                </table>
                <div class="text-center">
                    <input type="submit" class="btn btn-danger btn-lg" name="editPost" value="戻る">
                    <input type="submit" class="btn btn-primary btn-lg" name="editPost" value="更新">
                </div>
            </div>
            {{  csrf_field()  }}
        </form>
        @endif
    </div>
@endsection
