@extends('template/admin')

@section('title', 'メニュー一覧')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/menu/index.css" media="all" title="no title">
@endsection

@section('script')
    <script>
        function postEdit() {
            var element = document.getElementById("postButton");
            element.setAttribute("value", "edit");
            event.preventDefault();
            document.getElementById('edit').submit();
        }
        function postEnd() {
            var element = document.getElementById("postButton");
            element.setAttribute("value", "end");
            event.preventDefault();
            document.getElementById('edit').submit();
        }
    </script>
@endsection

@section('main')
    <h1>商品一覧</h1>

    <div class="form-group table-responsive">

        <form id="edit" action="/pizzzzza/menu/edit" method="get">
            <lavel name="select_button">
                <div id="menu_button">
                    <a type="button" class="btn btn-primary btn-lg" href="#"
                       onclick="postEdit()">編集</a>
                    <input id="postButton" type="hidden" name="menu" value="" style="display: none">
                    <a class="btn btn-danger btn-lg" data-featherlight="#delete" href="#">販売終了</a>
                    {{-- <button type="button" class="btn btn-primary btn-lg"name="button">追加</button> --}}
                </div>

                <div id="delete" class="delete">
                    <div class="inner">
                        選択した商品の販売を本当に終了しますか？
                        <div class="button">
                            <a class="btn btn-default" aria-label="Close" onclick="$.featherlight.current().close();">キャンセル</a>
                            <a class="btn btn-danger" href="#" onclick="postEnd()">　販売を終了　</a>
                        </div>
                    </div>
                </div>
            </lavel>

            @if(session()->has('message'))
                <?php $a = session()->pull('message'); ?>
                <div class="{{$a["class"]}}">
                    {{ $a["text"] }}
                </div>
            @endif

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th></th>
                    <th style="text-align: center;">ID</th>
                    <th>メニュー名</th>
                    <th>画像データ</th>
                    <th>説明</th>
                    <th style="text-align: center;">価格</th>
                    <th style="text-align: center;">販売開始日</th>
                    <th style="text-align: center;">販売終了日</th>
                </tr>
                </thead>
                <tbody>
                @if($products)
                    @foreach ($products as $product)
                        @if(is_null($product->deleted_at))
                            <tr>
                        @else
                            <tr class="menu-deleted">
                        @endif
                            <td style="text-align: center;"><input type="radio" name="id" value="{{ $product->product_id }}">
                            </td>
                            <td style="width:5%;text-align: center;">{{ $product->product_id }}</td>
                         @if(is_null($product->deleted_at))
                            <td style="width:20%;">{{ $product->product_name }}</td>
                         @else
                             <td style="width:20%;">{{ $product->product_name }}<br><b class="red">※販売終了</b></td>
                         @endif
                            <td style="width:20%;"><img src="{{ $product->product_image }}"
                                                        alt="{{ $product->product_name }}"/></td>
                            <td style="width:25%;">{{ $product->product_text }}</td>
                            <td style="text-align: center;">{{ number_format($product->product_price )}}円</td>
                            <td style="text-align: center;">{{ $product->sales_start_date }}</td>
                            <td style="text-align: center;">
                                @if ($product->sales_end_date == null)
                                    未設定
                                @else
                                    {{ $product->sales_end_date }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </form>
    </div>
    </div>
@endsection
