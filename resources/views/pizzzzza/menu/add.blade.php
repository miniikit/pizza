@extends('template/admin')

@section('title', '商品追加')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/menu/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order">ホーム</a></li>
        <li class="active">商品追加</li>
    </ol>
@endsection

@section('main')
    <h1>商品追加</h1>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="form-group" id="menuadd">
        <form action="/pizzzzza/menu/store" method="post" id="AddButton" enctype="multipart/form-data">
            <table id="menu-add-table" class="table table-bordered">
                <tbody>
                <tr>
                    <th>商品名</th>
                    <td><input class="form-control" type="text" name="product_name" value=""></td>
                </tr>
                <tr>
                    <th>価格</th>
                    <td><input class="form-control" type="number" name="product_price" value=""></td>
                </tr>
                <tr>
                    <th>ジャンル</th>
                    <td>
                        <select name="product_genre_id">
                            <option value="1">ピザ</option>
                            <option value="2">サイド</option>
                            <option value="3">ドリンク</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>販売開始日</th>
                    <td><input class="form-control" id="example-date-input" type="date" name="product_sales_start_day"
                               value="" size="5">
                    </td>
                </tr>
                <tr>
                    <th>販売終了日</th>
                    <td><input class="form-control" id="example-date-input" type="date" name="product_sales_end_day"
                               value="" size="5">
                    </td>
                </tr>
                <tr>
                    <th>商品画像</th>
                    <td class="imgInput">
                        <img id="preview" class="mb" src="/images/product/noimage.jpg" alt="">
                        <input type="file" id="getfile" name="product_img" value="" />
                        <div class="caption mt">※ 横:366px 縦:223px 拡張子: jpg jpeg</div>
                    </td>
                </tr>
                <tr>
                    <th>商品説明文</th>
                    <td><textarea class="form-control" id="exampleTextarea" rows="6" name="product_text" maxlength="255"
                                  resize="none"></textarea></td>
                </tr>
                </tbody>
            </table>
            <input id="postButton" type="submit" name="post" style="display:none">
            <div class="menu">
                <a href="/pizzzzza/menu/" class="add-button btn btn-default btn-lg" name="button">戻る</a>
                <input type="submit" class="add-button btn btn-primary btn-lg" name="submit" value="追加">
            </div>
            {{ csrf_field() }}
        </form>

    </div>


@endsection

@section('script')
    <script type="text/javascript">
        var file = document.querySelector('#getfile');

        file.onchange = function (){
            var fileList = file.files;
            //読み込み
            var reader = new FileReader();
            reader.readAsDataURL(fileList[0]);

            //読み込み後
            reader.onload = function  () {
                document.querySelector('#preview').src = reader.result;
            };
        };
    </script>
@endsection