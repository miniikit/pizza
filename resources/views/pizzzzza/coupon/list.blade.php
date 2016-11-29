@extends('template.admin')

@section('title', 'Coupon')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
    <link rel="stylesheet" href="/css/pizzzzza/coupon/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order/top">ホーム</a></li>
        <li class="active">開催中クーポン一覧</li>
    </ol>
@endsection

@section('main')
    <div class="wrap">
    <h1>開催中クーポン</h1>

    <div class="container">
     <div class="row">
      <div class="form-group table-responsive">
          <table class="table" style="margin-top:70px">
          <thead>
          <tr>
          <th class="text-center">クーポン番号</th>
          <th class="text-center">クーポン名</th>
          <th class="text-center">値引額</th>
          <th class="text-center">開始日</th>
          <th class="text-center">終了日</th>
          <th class="text-center">登録日時</th>
          <th class="text-center">更新日時</th>
          <th class="text-center">利用上限回数</th>
          <th class="text-center">対象者</th>
          </tr>
          </thead>
           <tbody>
                 @foreach ($coupons as $coupon)
                  <tr class="link" data-href="/pizzzzza/coupon/{{ $coupon->id }}/show">
                   <td class="number text-center">{{ $coupon->coupon_number }}</td>
                   <td class="name text-center">{{ $coupon->coupon_name }}</td>
                   <td class="discount text-center">{{ $coupon->coupon_discount }}</td>
                   <td class="date text-center">{{ $coupon->coupon_start_date }}</td>
                   <td class="date text-center">{{ $coupon->coupon_end_date }}</td>
                   <td class="date text-center">{{ $coupon->created_at }}</td>
                   <td class="date text-center">{{ $coupon->updated_at }}</td>
                   <td class="number text-center">{{ $coupon->coupon_conditions_count }}</td>
                   <td class="number text-center">{{ $coupon->coupon_conditions_first }}</td>
                   </td>
                 </tr>
                @endforeach
          </form>
          </tbody>
          </table>
           </div>
 </div>
  </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('.table tr[data-href]').addClass('clickable').click(function () {
            window.location = $(this).attr('data-href');
        }).find('a').hover(function () {
            $(this).parents('tr').unbind('click');
        }, function () {
            $(this).parents('tr').click(function () {
                window.location = $(this).attr('data-href');
            });
        });
    </script>
@endsection