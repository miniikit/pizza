@extends('template.admin')

@section('title', '電話注文')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
    <link rel="stylesheet" href="/css/pizzzzza/order/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order/top">ホーム</a></li>
        <li><a href="/pizzzzza/order/accept/input">電話番号入力</a></li>
        <li><a href="/pizzzzza/order/accept/customer/detail">お客様情報確認</a></li>
        <li class="active">商品選択</li>
    </ol>
@endsection

@section('main')
        <h1 class="title">商品選択</h1>
        <div class="container">
            @if(isset($products))
                <form action="#">
   <div class="row">
    <div class="col-xs-12 col-md-10">
    <div id="pizza">
    <h1 class="text-center title">ピザ</h1>
    </div>
      <div class="row">
                    @foreach($products as $product)
                        @if ($product->genre_id == 1)
                        <div class="col-xs-6 col-md-4">
                         <div class="item">
                            <div class="text-center"><image src="{{ $product -> product_image }}"></image></div>
                            <p class="text-center space name">{{ $product->product_name }}</p>
                            <div class="text-center space">{{ $product->product_price }}円</div>
                            <div class="text-center space">    
                                <select name="product_num" id="">
                                    @for($i = 0; $i< 50; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                          </div>
                         </div> 
                     @endif
                    @endforeach
                </div>

                    <h1 class="text-center title-space">サイド</h1>
                     <div class="row">
                        @foreach($products as $product)
                        @if ($product->genre_id == 2)
                        <div class="col-xs-6 col-md-4">
                         <div class="item">
                            <div class="text-center"><image src="{{ $product -> product_image }}"></image></div>
                            <p class="text-center space name">{{ $product->product_name }}</p>
                            <div class="text-center space">{{ $product->product_price }}円</div>
                            <div class="text-center space">    
                                <select name="product_num" id="">
                                    @for($i = 0; $i< 50; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                          </div>
                         </div> 
                     @endif
                    @endforeach
                </div>
                <div id="drink">
                 <h1 class="text-center title-space">ドリンク</h1>
                  </div>
                  <div class="row">
                        @foreach($products as $product)
                        @if ($product->genre_id == 3)
                        <div class="col-xs-6 col-md-4">
                         <div class="item">
                            <div class="text-center"><image src="{{ $product -> product_image }}"></image></div>
                            <p class="text-center space name">{{ $product->product_name }}</p>
                            <div class="text-center space">{{ $product->product_price }}円</div>
                            <div class="text-center space">    
                                <select name="product_num" id="">
                                    @for($i = 0; $i< 50; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                          </div>
                         </div> 
                     @endif
                    @endforeach
                </div>
                </form>
            @endif
        </div>
         <div class="col-xs-6 col-md-2">
         <h3 class="list">カテゴリ</h3>
        　<ul class="list-group list-none">
            <li class="list" data-href="#">
                <a href="#pizza"><h4>ピザ<span class="badge menu-space">{{ $pizzacnt }}</span></h4></a>
            </li>

            <li class="list">
                <a href="#side"><h4>サイド<span class="badge menu-space">{{ $sidecnt }}</span></h4></a>
            </li>
            <li class="list">
                <a href="#drink"><h4>ドリンク<span class="badge menu-space">{{ $drinkcnt }}</span></h4></a>
            </li>
        </ul>
         </div>
          </div>
           </div>
@endsection

@section('js')
    <script src="/plug/heightLine/heightLine.js" charset="utf-8"></script>
    <script type="text/javascript">
        $(window).on('load',function () {
            $('.item .name').heightLine();
            $('.product .text').heightLine();
        });
    </script>
@endsection

@section('script')
    <script type="text/javascript">
        $('.ul li[data-href]').addClass('clickable').click(function () {
            window.location = $(this).attr('data-href');
        }).find('a').hover(function () {
            $(this).parents('li').unbind('click');
        }, function () {
            $(this).parents('li').click(function () {
                window.location = $(this).attr('data-href');
            });
        });
    </script>
@endsection