@extends('template/admin')

@section('title', '従業員管理画面')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('main')
<h1>従業員管理画面</h1>
<div class="row">
<form class="" action="index.html" method="post">
<div class="col-md-9">
<table class="table side">
<tbody>
<tr>
<th class="text-center" ><label for="">登録日</label></th>
<td>{{ $user->created_at }}</td>
</tr>
<tr>
<th class="text-center" ><label for="">名前(漢字)</label></th>
<td>{{ $user->name }}</td>
</tr>
<tr>
<th class="text-center" ><label for="">名前(カナ)</label></th>
<td>{{ $user->kana }}</td>
</tr>
<tr>
<th class="text-center" ><label for="">生年月日</label></th>
<td>{{ $user->birthday }}</td>
</tr>
<tr>
<th class="text-center" ><label for="">性別</label></th>
<td>{{ $user->gender->gender_name }}</td>
</tr>
<tr>
<th class="text-center" ><label for="">郵便番号</label></th>
<td>{{ $user->postal }}</td>
</tr>
<tr>
<th class="text-center" ><label for="">住所1</label></th>
<td>{{ $user->address1 }}</td>
</tr>
<tr>
<th class="text-center" ><label for="">住所2</label></th>
<td>{{ $user->address2 }}</td>
</tr>
<tr>
<th class="text-center" ><label for="">住所3</label></th>
<td>{{ $user->address3 }}</td>
</tr>
<tr>
<th class="text-center" ><label for="">電話番号</label></th>
<td>{{ $user->phone }}</td>
</tr>
<tr>
<th class="text-center" ><label for="">メールアドレス</label></th>
<td>{{ $user->email }}</td>
</tr>
</tbody>
</table>
</div>
<div class="col-md-3">
<button type="button" class="btn btn-default btn-lg btn-block">詳細</button>
<button type="button" class="btn btn-danger btn-lg btn-block">削除</button>
</div>
</form>
</div>


@endsection
