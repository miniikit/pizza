@extends('template.admin')

@section('title', 'お客様情報編集')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order">ホーム</a></li>
        <li class="active"><a href="/pizzzzza/order/accept/input">電話注文受付</a></li>
        <li class="active"><a href="/pizzzzza/order/accept/customer/{{ $user->id }}/show">お客様情報確認</a></li>
        <li class="active">お客様情報編集</li>
    </ol>
@endsection

@section('main')
    <div class="wrap">
        <h1>お客様情報編集</h1>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(isset($user))
        <form id="updateForm" action="#" method="post">
            <div class="form-group table-responsive">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th class="text-center"><label for="">氏名(漢字)</label></th>
                        <td><input class="form-control" type="text" name="name" value="{{ $user->name }}" placeholder="姓"></td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">氏名(カナ)</label></th>
                        <td><input class="form-control" type="text" name="name_katakana" value="{{ $user->kana }}" placeholder="セイ"></td>
                    </tr>
                    @if(isset($user->birthday) || isset($user->gender_name))
                        <tr>
                            <th class="text-center"><label for="">生年月日</label></th>
                            <td><input type="date" name="birthday" value="{{ $user->birthday }}"></td>
                        </tr>
                        @if(isset($genders))
                        <tr>
                            <th class="text-center"><label for="">性別</label></th>
                            <td>
                                    @foreach($genders as $gender)
                                        @if($gender->id == $user->gender_id)
                                            <input type="radio" name="gender" value="{{$gender->id}}" checked>{{ $gender->gender_name }}
                                        @else
                                            <input type="radio" name="gender" value="{{$gender->id}}">{{ $gender->gender_name }}
                                        @endif
                                    @endforeach
                                </td>
                        </tr>
                        @endif
                    @endif
                    <tr>
                        <th class="text-center"><label for="">郵便番号</label></th>
                        <td><input class="form-control" maxlength="8" type="text" name="postal" size="10" maxlength="8" value="{{ $user->postal }}"
                                   placeholder="ハイフンなし" onKeyUp="AjaxZip3.zip2addr(this,'','address1','address1');"></td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">住所</label></th>
                        <td><input class="form-control" type="text" name="address1" value="{{ $user->address1 }}" size="60" placeholder="市区町村"></td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">番地</label></th>
                        <td><input class="form-control" type="text" name="address2" value="{{ $user->address2 }}" placeholder="番地"></td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">建物名</label></th>
                        <td><input class="form-control" type="text" name="address3" value="{{ $user->address3 }}" placeholder="建物名"></td>
                    </tr>
                    <tr>
                        <th class="text-center"><label for="">電話番号</label></th>
                        <td><input class="form-control" type="number" name="phone" value="{{ $user->phone }}" placeholder=""></td>
                    </tr>
                    @if(isset($user->email))
                        <tr>
                            <th class="text-center"><label for="">メールアドレス</label></th>
                            <td><input type="email" name="email" value="{{ $user->email }}"></td>
                        </tr>
                    @endif
                    </tbody>

                </table>
                <div class="text-center">
                    <a type="button" class="btn btn-default btn-sm ml" href="/pizzzzza/order/accept/customer/{{ $user->id }}/show">戻る</a>
                    <input id="submit" type="submit" class="btn btn-primary btn-sm ml" name="editPost" value="更新" onclick="changeData()">
                </div>
            </div>
            {{  csrf_field()  }}
        </form>
        @endif
    </div>
@endsection

@section('script')
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
    <script>
        $(function(){
            @if($user->authority_id == 3)   //web
                var element = document.getElementById("updateForm");
                element.setAttribute("action", "/pizzzzza/order/accept/customer/{{$user->id}}/update/web");
            @elseif($user->authority_id == 4)   //電話
                var element = document.getElementById("updateForm");
                element.setAttribute("action", "/pizzzzza/order/accept/customer/{{$user->id}}/update/phone");
            @endif
        });

    </script>
@endsection