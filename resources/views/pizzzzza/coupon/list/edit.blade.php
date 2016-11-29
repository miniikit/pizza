@extends('template.admin')

@section('title', '値引クーポン編集画面')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
  <ol class="breadcrumb">
    <li><a href="/pizzzzza/order/top">ホーム</a></li>
    <li><a href="/pizzzzza/coupon/menu">クーポンメニュー</a></li>
    <li><a href="/pizzzzza/coupon/show"></a></li>
    <li class="active">編集</li>
  </ol>
@endsection

@section('main')
  <h1>クーポン編集</h1>
  <div class="row">
    <div class="col-md-7">
      <table class="table table-bordered">
        <tbody>
        <tr>
          <th class="text-center">クーポン名</th>
          <td><input type="text" name="" value="{{ $coupon->coupon_name }}"></td>
        </tr>
        <tr>
          <th class="text-center">クーポン番号</th>
          <td><input type="text" name="" value="{{ $coupon->coupon_number }}"></td>
        </tr>
        <tr>
          @if($coupon->coupon_discount < 0)
            <th class="text-center">プレゼント商品名</th>
            <td><input type="text" name="" value=""></td>
          @else
            <th class="text-center">値引額</th>
            <td><input type="text" name="" value="{{ $coupon->coupon_discount }}"></td>
          @endif
        </tr>
        <tr>
          <th class="text-center">利用上限回数</th>
          <td><input type="text" name="" value="{{ $coupon->coupon_conditions_count }}"></td>
        </tr>
        <tr>
          <th class="text-center">利用条件金額</th>
          <td><input type="text" name="" value="{{ $coupon->coupon_conditions_money }}"></td>
        </tr>
        <tr>
          <th class="text-center">対象者</th>
          <td><input type="text" name="" value="{{ $coupon->coupon_conditions_first }}"></td>
        </tr>
        <tr>
          <th class="text-center">クーポン種別</th>
          <td>
            <select name="coupon_type_id" id="">
              <option value="{{ $coupon->coupon_id }}">{{ $coupon->couponType }}</option>
            </select>
          </td>
        </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-5">
      <table class="table table-bordered">
        <tbody>
        <tr>
          <th class="text-center">開始日</th>
          <td>{{ $coupon->coupon_start_date }}</td>
        </tr>
        <tr>
          <th class="text-center">終了日</th>
          <td><input type="date" name="" value="{{ $coupon->coupon_end_date }}"></td>
        </tr>
        <tr>
          <th class="text-center">登録日時</th>
          <td>{{ $coupon->created_at }}</td>
        </tr>
        <tr>
          <th class="text-center">更新日時</th>
          <td>{{ $coupon->updated_at }}</td>
        </tr>
        </tbody>
      </table>

      <form class="ar" action="/pizzzzza/coupon/{{$coupon->id}}/delete" method="post">
        <a href="/pizzzzza/coupon/{{$coupon->id}}/update" class="btn btn-primary btn-sm">更新</a>
        {{ csrf_field() }}
      </form>

    </div>
    <div class="col-md-4 col-md-offset-4 mt">
      <a href="/pizzzzza/coupon/list" class="btn btn-default btn-lg btn-block">戻る</a>
    </div>
  </div>
@endsection