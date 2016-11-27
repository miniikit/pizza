@extends('template/admin')

@section('title', 'メニュー編集')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/menu/index.css" media="all" title="no title">
    <link href="/plug/featherlight/featherlight.css" title="Featherlight Styles" rel="stylesheet" />
@endsection

@section('js')
    <script src="/plug/featherlight/featherlight.js" type="text/javascript" charset="utf-8"></script>
@endsection

@section('main')
    <h1>メニュー　編集</h1>

    @foreach ($errors->all() as $message)
        <div class="error-message">
        {{ $message }}
        </div>
    @endforeach
    <form id="MenuEdit" method="post" action="/pizzzzza/menu/edit/do" enctype="multipart/form-data">
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
                    @if(is_null($products->deleted_at))     {{-- 販売中 --}}
                        <td><input class="form-control" type="text" maxlengt="255" name="product_name"
                                   value="{{ $products->product_name }}">
                        </td>
                    @else   {{-- 販売終了 --}}
                        <td><input class="form-control readonly" type="text" maxlengt="255" name="product_name"
                                   value="{{ $products->product_name }}" readonly="readonly">
                        </td>
                    @endif
                </tr>
                <tr>
                    <th>商品説明</th>
                    @if(is_null($products->deleted_at))     {{-- 販売中 --}}
                         <td><input class="form-control" type="text" size="100" rows="1" name="product_text"
                               value="{{ $products->product_text }}"></td>
                    @else   {{-- 販売終了 --}}
                        <td><input class="form-control" type="text" size="100" rows="1" name="product_text"
                                   value="{{ $products->product_text }}" readonly="readonly"></td>
                    @endif
                </tr>
                <tr>
                    <th>販売価格（税込）</th>
                    @if(is_null($products->deleted_at))     {{-- 販売中 --}}
                    <td><input class="form-control" type="number" name="product_price" value="{{ $products->product_price }}"
                               ></td>
                    @else   {{-- 販売終了 --}}
                    <td><input class="form-control" type="number" name="product_price" value="{{ $products->product_price }}"
                                readonly="readonly"></td>
                    @endif
                </tr>
                <tr>
                    <th>商品ジャンル</th>
                         <td><select name="product_genre_id" id="{{ $products->genre_id }}">
                             @if(is_null($products->deleted_at))     {{-- 販売中 --}}
                                 @foreach($genres as $genre)
                                     @if($genre->id == $products->genre_id)
                                         <option value="{{ $genre->id }}" selected>{{ $genre->genre_name }}</option>
                                     @else
                                         <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
                                     @endif
                                 @endforeach
                             @else   {{--  販売終了  --}}
                                 @foreach($genres as $genre)
                                     @if($genre->id == $products->genre_id)
                                         <option value="{{ $genre->id }}" selected disabled="disabled">{{ $genre->genre_name }}</option>
                                     @else
                                         <option value="{{ $genre->id }}" disabled="disabled">{{ $genre->genre_name }}</option>
                                     @endif
                                 @endforeach
                             @endif

                             </select></td>
                </tr>
                <tr>
                    <th>画像の更新</th>
                    @if(is_null($products->deleted_at))     {{-- 販売中 --}}
                        <td><input type="file" name="product_img">※1500KBまでのJPG/JPEG/PNG/BMPのみ</td>
                    @else       {{-- 販売終了 --}}
                        <td><input type="file" name="product_img" disabled="disabled"></td>
                    @endif
                </tr>
                <tr>
                    <th>販売開始日</th>
                    @if(is_null($products->deleted_at))     {{-- 販売中 --}}
                        <td><input type="date" name="product_sales_start_day" value="{{ $products->sales_start_date }}"></td>
                    @else       {{-- 販売終了 --}}
                        <td><input type="date" name="product_sales_start_day" value="{{ $products->sales_start_date }}" disabled="disabled"></td>
                    @endif
                </tr>
                <tr>
                    <th>販売終了日</th>
                    @if(is_null($products->deleted_at))     {{-- 販売中 --}}
                        @if(is_null($products->sales_end_date))
                            <td><input type="date" name="product_sales_end_day"><b>　※未設定</b></td>
                        @else
                            <td><input type="date" name="product_sales_end_day" value="{{ $products->sales_end_date }}"></td>
                        @endif
                    @else   {{--  販売終了  --}}
                        @if(is_null($products->sales_end_date))
                            <td><input type="date" name="product_sales_end_day" disabled="disabled">　※未設定・販売終了済み</td>
                        @else
                            <td><input type="date" name="product_sales_end_day" value="{{ $products->sales_end_date }}" disabled="disabled"></td>
                        @endif
                    @endif
                </tr>
                <tr>
                    <th>作成日</th>
                    <td>{{ $products->created_at }}</td>
                <tr>
                    <th>更新日</th>
                    <td>{{ $products->updated_at }}</td>
                </tr>

            @else
                エラー！一度ログアウトしてください
            @endif

        </table>

        @if(is_null($products->deleted_at))     {{-- 販売中 --}}
            <div class="menu-edit">
                <div class="button">
                    <a id="edit-back" class="btn btn-danger btn-lg" type="button" href="/pizzzzza/menu" name="button">戻る</a>
                </div>
                <div class="button">
                    <a id="edit-go" class="btn btn-primary btn-lg" type="button" name="button" data-featherlight="#menu-edit-do">確認画面へ</a>
                </div>
                <div class="lightbox" id="menu-edit-do">
                    <h2>更新してよろしいですか？</h2>
                    <p>　変更はすぐに反映されます。</p>
                    <div class="button">
                        <a id="edit-back" class="btn btn-danger btn-lg" type="button" onclick="$.featherlight.current().close();" name="button">キャンセル</a>
                        <a id="edit-go" class="btn btn-primary btn-lg" type="button" name="button" onclick="document.getElementById('MenuEdit').submit();">更新</a>
                    </div>
                </div>
            </div>
        @else   {{-- 販売終了 --}}
            <div class="menu-edit">
                <div class="button">
                    <a id="edit-back" class="btn btn-danger btn-lg" type="button" href="/pizzzzza/menu" name="button">戻る</a>
                </div>
            </div>
        @endif
        <input type="hidden" name="product_id" value="{{ $products->product_id }}">
        <input type="hidden" name="_token" value="{{  csrf_token()  }}">
        <input type="submit" name="" style="display:none">
    </form>

    </div>

@endsection