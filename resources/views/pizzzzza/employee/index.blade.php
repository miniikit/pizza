@extends('template/admin')

@section('title', '従業員管理画面')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('main')
<h1>従業員管理画面</h1>
    <div id="manager_button">
       <a href="#"><input type="button" class="btn btn-primary btn-lg" name="name" value="編集"></a>
       <a href="#"><input type="button" class="btn btn-primary btn-lg" name="name" value="追加"></a>
     </div>
       <div class="container">
   <table class="table"> <!-- サンプル -->
     <thead>
       <tr>
         <th></th>
         <th>ID</th>
         <th>氏名</th>
         <th>フリガナ</th>
         <th>生年月日</th>
         <th>性別</th>
         <th>契約開始日</th>
         <th>契約終了日</th>
         <th>登録日時</th>
         <th>更新日時</th>
         <th>住所</th>
       </tr>
     </thead>
     <tbody>
     @foreach($employees as $employee)
       <tr>
         <th scope="row"><input type="radio" name="id" value="{{ $employee->id }}"></th>
           <td>{{ $employee->id }}</td>
           <td>{{ $employee->user->name }}</td>
           <td>{{ $employee->user->kana }}</td>
           <td>{{ \Carbon\Carbon::parse($employee->user->birthday)->format('Y年m月d日') }}</td>
           <td>{{ $employee->user->gender->gender_name }}</td>
           <td>{{ $employee->emoloyee_agreement_date }}</td>
           <td>
               @if($employee->emoloyee_agreement_enddate == null)
                   未設定
               @else
                   {{ $employee->emoloyee_agreement_enddate }}
               @endif
           </td>
           <td>{{ $employee->created_at }}</td>
           <td>{{ $employee->updated_at }}</td>
           <td>{{ $employee->user->address1 . $employee->user->address2 .$employee->user->address3 }}</td>
       </tr>
     @endforeach
     </tbody>
   </table>
 </div>

@endsection