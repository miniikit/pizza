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

@section('main')
    <div class="wrap">
        <h1>お客様情報編集</h1>

        <form action="/pizzzzza/order/accept/customer/detail" method="post">
            <div class="form-group table-responsive">
                <table class="table">
                    <tbody>
                    <tr>
                        <th class="text-center"><label for="">氏名(漢字)</label></th>
                        <td><input class="form-control" type="text" name="name" value="" placeholder="姓"></td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">氏名(カナ)</label></th>
                        <td><input class="form-control" type="text" name="name" value="" placeholder="セイ"></td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">郵便番号</label></th>
                        <td><input class="form-control" maxlength="8" type="text" name="zip11" size="10" maxlength="8" value=""
                                   placeholder="ハイフンなし" onKeyUp="AjaxZip3.zip2addr(this,'','addr11','addr11');"></td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">住所１</label></th>
                        <td><input class="form-control" type="text" name="addr11" value="" size="60" placeholder="市区町村"></td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">番地</label></th>
                        <td><input class="form-control" type="text" name="name" value="" placeholder="番地"></td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">建物名</label></th>
                        <td><input class="form-control" type="text" name="name" value="" placeholder="建物名"></td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">電話番号</label></th>
                        <td><input class="form-control" type="number" name="phone" value="" placeholder=""></td>
                    </tr>
                    </tbody>

                </table>
                <div class="text-center">
                    <a href="#" type="button" class="btn btn-primary btn-lg" name="button">キャンセル</a>
                    <a href="#" type="button" class="btn btn-primary btn-lg" name="button">完了</a>
                </div>


            </div>
        </form>
    </div>
@endsection
