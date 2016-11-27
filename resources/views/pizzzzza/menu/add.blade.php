@extends('template/admin')

@section('title', 'メニュー追加')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">   {{-- たぶんこれ不要 --}}
    <link rel="stylesheet" href="/css/pizzzzza/menu/index.css" media="all" title="no title">
@endsection

@section('js')
    <script>
        function postAdd() {
            event.preventDefault();
            document.getElementById('AddButton').submit();
        }
    </script>
@endsection

@section('main')
    <h1>メニュー追加</h1>
    <div class="form-group table-responsive" id="menuadd">
        <form action="/pizzzzza/menu/add" method="post" id="AddButton" enctype="multipart/form-data">
            @if(count($errors) > 0)
                <ul class="error-message">
                @foreach ($errors->all() as $message)
                           <li>{{ $message }}</li>
                @endforeach
                </ul>
            @endif
            <table id="menu-add-table" class="table">
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
                    <td><select name="product_genre_id">
                            @foreach($genres as $genre)
                                <option value="{{ $genre->id }}">{{  $genre->genre_name }}</option>
                            @endforeach
                        </select></td>
                </tr>
                <tr>
                    <th>販売開始日</th>
                    <td><input class="form-control" id="example-date-input" type="date" name="product_sales_start_day" value="" size="5">
                    </td>
                </tr>
                <tr>
                    <th>販売終了日</th>
                    <td><input class="form-control" id="example-date-input" type="date" name="product_sales_end_day" value="" size="5">
                    </td>
                </tr>
                <tr>
                    <th>商品画像</th>
                    <td><input type="file" name="product_img" value=""></td>
                </tr>
                <tr>
                    <th>商品説明文</th>
                    <th><textarea class="form-control" id="exampleTextarea" rows="6" name="product_text" maxlength="255"></textarea></th>
                </tr>
                </tbody>
            </table>
            <input type="hidden" name="_token" value="{{  csrf_token()  }}">
            <input id="postButton" type="submit" name="post" style="display:none">
        </form>
        <div class="menu">
            <a type="button" class="add-button btn btn-danger btn-lg" name="button">戻る</a>
            <a type="button" class="add-button btn btn-primary btn-lg" name="button" onclick="postAdd()">確認</a>
        </div>
    </div>


@endsection