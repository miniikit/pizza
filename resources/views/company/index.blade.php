
@extends('template/master')

@section('title', '会社概要')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
    <link rel="stylesheet" href="/css/company/index.css" media="all" title="no title">
@endsection

@section('plug')

@endsection

@section('main')
    <div class="container wrap">
        <div class="main-title">
          <h1>会社概要</h1>
        </div>
      <div class="table">
          <table class="table_info">
              <tbody><tr>
                <td class="td_head">名　称</td>
                <td class="td_detail">pizzaoic</td>
              </tr>
              <tr>
                <td class="td_head">代表者</td>
                <td class="td_detail">sample</td>
              </tr>
              <tr>
                <td class="td_head">事業内容</td>
                <td class="td_detail">pizzapizzapizzapizzapizzapizza</td>
              </tr>
              <tr>
                <td class="td_head">所在地</td>
                <td class="td_detail">〒543-0001 大阪府大阪市天王寺区 6丁目8−4</td>
              </tr>
              <tr>
                <td class="td_head">電話番号</td>
                <td class="td_detail">06-6772-2233</td>
              </tr>
              <tr>
                <td class="td_head">ＵＲＬ</td>
                <td class="td_detail">url</td>
              </tr>
              <tr>
                <td class="td_head">メールアドレス</td>
                <td class="td_detail">meado</td>
              </tr>
            </tbody>
          </table>
    </div>
    <h2 class="access">アクセス</h2>
    <div class="ggmap">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3281.641574182195!2d135.51633155107947!3d34.663753792607295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6000e751ae253873%3A0xf60305f82913d85f!2z5aSn6Ziq5oOF5aCx44Kz44Oz44OU44Ol44O844K_5bCC6ZaA5a2m5qChLU9JQy0!5e0!3m2!1sja!2sjp!4v1478229157623" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
    </div>
@endsection

@section('scrip')

@endsection
