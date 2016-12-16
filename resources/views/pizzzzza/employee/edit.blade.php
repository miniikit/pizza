@extends('template/admin')

@section('title', '従業員編集')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
<ol class="breadcrumb">
<li><a href="/pizzzzza/order">ホーム</a></li>
<li><a href="/pizzzzza/employee">従業員一覧</a></li>
<li><a href="/pizzzzza/employee/{{$employee->id}}/show">{{$employee->user->name}}</a></li>
<li class="active">編集</li>
</ol>
@endsection

@section('main')
    <h1>従業員編集</h1>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/pizzzzza/employee/{{ $employee->id }}/update" method="post">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered ">
                    <tbody>
                    <tr>
                        <th class="text-center" >名前</th>
                        <td><input class="form-control" type="text" name="name" value="{{ $employee->user->name }}" placeholder="例）山田太郎"></td>
                    </tr>
                    <tr>
                        <th class="text-center" >フリガナ</th>
                        <td><input class="form-control" type="text" name="kana" value="{{ $employee->user->kana }}" placeholder="例）ヤマダタロウ"></td>
                    </tr>
                    <tr>
                        <th class="text-center" >生年月日</th>
                        <td><input class="form-control" type="date" name="birthday" value="{{ $employee->user->birthday }}" ></td>
                    </tr>
                    <tr>
                        <th class="text-center" >性別</th>
                        <td>
                            @if($employee->user->gender_id == 1)
                            <input class="" type="radio" name="gender_id" value="1" checked> 男
                            <input class="" type="radio" name="gender_id" value="2"> 女
                            @else
                            <input class="" type="radio" name="gender_id" value="1"> 男
                            <input class="" type="radio" name="gender_id" value="2" checked> 女
                            @endif

                        </td>
                    </tr>
                    <tr>
                        <th class="text-center" >郵便番号</th>
                        <td><input class="form-control" type="text" name="postal" value="{{ $employee->user->postal }}" placeholder="ハイフン抜き"></td>
                    </tr>
                    <tr>
                        <th class="text-center" >住所</th>
                        <td><input class="form-control" type="text" name="address1" value="{{ $employee->user->address1 }}" placeholder="例）大阪府大阪市天王寺区"></td>
                    </tr>
                    <tr>
                        <th class="text-center" >番地</th>
                        <td><input class="form-control" type="text" name="address2" value="{{ $employee->user->address2 }}" placeholder="例）１−１−１"></td>
                    </tr>
                    <tr>
                        <th class="text-center" >建物名</th>
                        <td><input class="form-control" type="text" name="address3" value="{{ $employee->user->address3 }}" placeholder="例）東マンション　５０２号室"></td>
                    </tr>
                    <tr>
                        <th class="text-center" >電話番号</th>
                        <td><input class="form-control" type="text" name="phone" value="{{ $employee->user->phone }}" placeholder="例）08012345678"></td>
                    </tr>
                    <tr>
                        <th class="text-center" >メールアドレス</th>
                        <td><input class="form-control" type="text" name="email" value="{{ $employee->user->email }}" placeholder="例）example@example.com" ></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
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
                        <td><input class="form-control" type="date" name="emoloyee_agreement_enddate" value="{{ $employee->emoloyee_agreement_enddate }}" ></td>
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
            </div>
        </div>

        <div class="col-md-4 col-md-offset-4 ac">
            <a class="btn btn-default btn-lg mr" href="/pizzzzza/employee" >戻る</a>
            <input type="submit" class="btn btn-primary btn-lg" name="update" value="更新">
        </div>
        {{ csrf_field() }}
    </form>
</div>

@endsection
