@extends('template/admin')

@section('title', 'メニュー追加画面')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/menu/index.css" media="all" title="no title">
@endsection

@section('main')
      <h1>メニュー管理画面</h1>
      <div id="menu_button">
        <button type="button" class="btn btn-primary btn-lg"name="button">編集</button>
        <a class="btn btn-danger btn-lg" data-featherlight="#delete">削除</a>
        {{-- <button type="button" class="btn btn-primary btn-lg"name="button">追加</button> --}}
      </div>

      <div id="delete" class="delete">
          <div class="inner">
              本当に削除しますか？
              <div class="button">
                  <a class="btn btn-default" aria-label="Close" onclick="$.featherlight.current().close();">キャンセル</a>
                  <a class="btn btn-danger">　削除　</a>
              </div>
          </div>
      </div>

      <div class="form-group table-responsive">
        <table class="table">
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
              <form class="" action="index.html" method="post">
                  @foreach ($products as $product)
                  <tr>
                    <td style="text-align: center;"><input type="checkbox" name="id[]" value="{{ $product->id }}"></td>
                    <td style="width:5%;text-align: center;">{{ $product->id }}</td>
                    <td style="width:20%;">{{ $product->product_name }}</td>
                    <td style="width:20%;"><img src="{{ $product->product_image }}" alt="{{ $product->product_name }}" /></td>
                    <td style="width:25%;">{{ $product->product_text }}</td>
                    <td style="text-align: center;">{{ number_format($product->productPrice->product_price)}}円</td>
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
                  {{-- <form method="post" enctype="multipart/form-data"><input type="file" name="pic"></form> --}}
              </form>
          </tbody>
        </table>
        </div>
    </div>
@endsection
