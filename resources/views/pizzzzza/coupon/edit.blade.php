@extends('template.admin')

@section('title', 'クーポン編集')

@section('css')
    <link rel="stylesheet" href="/css/pizzzzza/menu/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order">ホーム</a></li>
        @if(is_null($coupon->deleted_at))
            <li><a href="/pizzzzza/coupon">開催中クーポン一覧</a></li>
        @else
            <li><a href="/pizzzzza/coupon">クーポン履歴</a></li>
        @endif
        <li><a href="/pizzzzza/coupon/{{ $id }}/show">クーポン詳細</a></li>
        <li class="active">クーポン編集</li>
    </ol>
@endsection

@section('main')
    <h1>クーポン編集</h1>
    <div class="row">
        <div class="col-md-7">
            <form action="/pizzzzza/coupon/{{$id}}/update" method="post">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th class="text-center">クーポン名</th>
                        <td><input class="form-control" type="text" name="coupon_name"
                                   value="{{ $coupon->coupon_name }}"></td>
                    </tr>
                    <tr>
                        <th class="text-center">クーポン番号</th>
                        <td><input class="form-control" type="text" name="coupon_num"
                                   value="{{ $coupon->coupon_number }}"></td>
                    </tr>
                    <tr>
                        <th class="text-center">値引き額</th>
                        <td><input class="form-control" type="text" name="coupon_discount_price"
                                   value="{{ $coupon->coupon_discount }}">
                        </td>
                    </tr>
                    <tr>
                        <th class="text-center">利用上限回数</th>
                        <td><input class="form-control" type="text" name="coupon_max"
                                   value="{{ $coupon->coupon_conditions_count }}"></td>
                    </tr>
                    <tr>
                        <th class="text-center">利用条件金額</th>
                        <td><input class="form-control" type="text" name="coupon_conditions_price"
                                   value="{{ $coupon->coupon_conditions_money }}"></td>
                    </tr>
                    <tr>
                        <th class="text-center">対象者</th>
                        <td><select class="form-control" name="coupon_conditions_first" id="">
                                @if($coupon->coupon_conditions_first == 1)
                                    <option value="0">全員</option>
                                    <option value="1" checked>当店初回利用者限定</option>
                                @else
                                    <option value="0" checked>全員</option>
                                    <option value="1">当店初回利用者限定</option>
                                @endif
                            </select></td>
                    </tr>
                    <tr>
                        <th class="text-center">クーポン種別</th>
                        <td>
                            <input class="form-control" name="coupon_type_id" id="" value="{{ $coupon->coupon_type }}" disabled>
                            </input>
                        </td>
                    </tr>
                    <tr>
                        @if($coupon->coupons_types_id == 1) {{-- クーポン種別が値引きであれば --}}
                        <th class="text-center">使用条件商品</th>
                        <td>
                            <select class="form-control" name="product_id">

                                    @if($coupon->product_id == NULL)
                                        <option value=NULL selected>なし</option>
                                    @else
                                        <option value=NULL>なし</option>
                                    @endif
                                @foreach($products as $product)
                                    @if($product->id == $product_id)
                                        <option value="{{ $product->id }}"
                                                selected>{{ $product->product_name }}</option>
                                    @else
                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                        @else {{-- クーポン種別がプレゼントであれば --}}

                        @endif
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
                    <td><input class="form-control" type="date" name="coupon_end_date"
                               value="{{ $coupon->coupon_end_date }}"></td>
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
            <!--
            <div class="ar">
                @if($coupon->deleted_at == NULL)
                @endif
                <input class="btn btn-primary btn-sm ml" type="submit" name="status" value="更新">
            </div>
            -->

            {{ csrf_field() }}
            <input type="hidden" name="coupons_types_id" value="{{  $coupon->coupons_types_id }}">
          </div>
          <div class="col-md-4 col-md-offset-4 ac">
              <a href="/pizzzzza/coupon/{{$id}}/show" class="btn btn-default btn-lg mr">戻る</a>
              <input class="btn btn-primary btn-lg" type="submit" name="status" value="更新">
          </div>
        </form>
  </div>

@endsection
