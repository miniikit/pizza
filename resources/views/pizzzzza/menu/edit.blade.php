@extends('template/admin')

@section('title', 'メニュー追加画面')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/menu/index.css" media="all" title="no title">
@endsection

@section('main')
    <h1>商品情報　編集</h1>

    <form method="post" enctype="multipart/form-data">
        <table id="edit-table" class="table">
            @if($products)
                <tr>
                    <th>現在の画像</th>
                    <td class="center"><img src="{{ $products->product_image }}" alt=""></td>
                </tr>
                <tr>
                    <th>販売状況</th>
                    <td id="sales_status" class="{{ $sales_status["class"] }}">{{ $sales_status["status"] }}</td>
                </tr>
                <tr>
                    <th>商品名</th>
                    <td><input class="form-control" type="text" maxlengt="255" name="name" value="{{ $products->product_name }}">
                    </td>
                </tr>
                <tr>
                    <th>商品説明</th>
                    <td><input class="form-control" type="text" size="100" rows="1" value="{{ $products->product_text }}"></td>
                </tr>
                <tr>
                    <th>販売価格（税込）</th>
                    <td><input class="form-control" type="number" name="name" value="{{ $products->product_price }}"
                               style=></td>
                </tr>
                <tr>
                    <th>商品ジャンル</th>
                    <td><select name="genre_id" id="{{ $products->genre_id }}">
                            @foreach($genres as $genre)
                                @if($genre->id == $products->genre_id)
                                    <option value="{{ $genre->id }}" selected>{{ $genre->genre_name }}</option>
                                @else
                                    <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                                @endif
                            @endforeach
                        </select></td>
                </tr>
                <tr>
                    <th>画像の更新</th>
                    <td><input type="file" name="pic"></td>
                </tr>
                <tr>
                    <th>販売開始日</th>
                    <td><input type="date" value="{{ $products->sales_start_date }}"></td>
                </tr>
                <tr>
                    <th>販売終了日</th>
                    @if(is_null($products->sales_end_date))
                        <td><input type="date"><b>　※未設定</b></td>
                    @else
                        <td><input type="date" value="{{ $products->sales_end_date }}"></td>
                    @endif
                </tr>
                <tr></tr>
            @else
                エラー！一度ログアウトしてください
            @endif

        </table>
        <div class="menu-edit">
            <div class="button">
                <a id="edit-back" class="btn btn-danger btn-lg" type="button" href="/pizzzzza/menu" name="button">戻る</a>
            </div>
            <div class="button">
                <a id="edit-go" class="btn btn-primary btn-lg" type="button" name="button">確認画面へ</a>
            </div>
        </div>
    </form>

    </div>

@endsection