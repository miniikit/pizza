@extends('template/admin')

@section('title', '従業員管理画面')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
<ol class="breadcrumb">
<li><a href="/pizzzzza/order/top">ホーム</a></li>
<li><a href="/pizzzzza/employee">従業員一覧</a></li>
<li class="active">詳細</li>
</ol>
@endsection

@section('main')
<h1>従業員管理</h1>
<div class="row">
<div class="col-md-7">
<table class="table table-bordered">
<tbody>
<tr>
<th class="text-center" >名前</th>
<td>{{ $employee->user->name }}</td>
</tr>
<tr>
<th class="text-center" >フリガナ</th>
<td>{{ $employee->user->kana }}</td>
</tr>
<tr>
<th class="text-center" >生年月日</th>
<td>{{ $employee->user->birthday }}</td>
</tr>
<tr>
<th class="text-center" >性別</th>
<td>{{ $employee->user->gender->gender_name }}</td>
</tr>
<tr>
<th class="text-center" >郵便番号</th>
<td>{{ $employee->user->postal }}</td>
</tr>
<tr>
<th class="text-center" >住所</th>
<td>{{ $employee->user->address1.$employee->user->address2.$employee->user->address3 }}</td>
</tr>
<tr>
<th class="text-center" >電話番号</th>
<td>{{ $employee->user->phone }}</td>
</tr>
<tr>
<th class="text-center" >メールアドレス</th>
<td>{{ $employee->user->email }}</td>
</tr>
</tbody>
</table>
</div>
<div class="col-md-5">
<table class="table table-bordered">
<tbody>
<tr>
<th class="text-center" >従業員ID</th>
<td>{{ $employee->id }}</td>
</tr>
<tr>
<th class="text-center" >契約開始日</th>
<td>{{ $employee->emoloyee_agreement_date }}</td>
</tr>
<tr>
<th class="text-center" >契約終了日</th>
<td>{{ $employee->emoloyee_agreement_enddate }}</td>
</tr>
<tr>
<th class="text-center" >登録日</th>
<td>{{ $employee->created_at }}</td>
</tr>
<tr>
<th class="text-center" >更新日</th>
<td>{{ $employee->updated_at }}</td>
</tr>
</tbody>
</table>
<form class="ar" action="/pizzzzza/employee/{{$employee->id}}/delete" method="post">
    <a href="/pizzzzza/employee/{{$employee->id}}/edit" class="btn btn-default btn-sm" >編集</a>
    @if ($employee->user->authority_id != 1)
    <input class="btn btn-danger btn-sm ml" type="submit" name="delete" value="削除">
    @endif
    {{ csrf_field() }}
</form>
</div>
<div class="col-md-4 col-md-offset-4 mt">
    <a href="/pizzzzza/employee" class="btn btn-default btn-lg btn-block">戻る</a>
</div>
</div>
@endsection
