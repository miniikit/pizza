@extends('template.admin')

@section('title', '電話注文')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
@endsection

@section('pankuzu')
    <ol class="breadcrumb">
        <li><a href="/pizzzzza/order/top">ホーム</a></li>
        <li class="active"><a href="/pizzzzza/order/accept/input">電話番号入力</a></li>
        <li class="active">お客様情報確認</li>
        <li class="active">編集</li>
    </ol>
@endsection

@section('main')
    <div class="wrap">
        <h1>お客様情報編集</h1>

        @if(isset($user))
        <form id="updateForm" action="a.html" method="post">
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
                        <tr>
                            <th class="text-center"><label for="">性別</label></th>
                            <td><select name="gender_id">
                                    @foreach($genders as $gender)
                                        @if($gender->id == $user->gender_id)
                                            <option value="{{$gender->id}}" selected>{{ $gender->gender_name }}</option>
                                        @else
                                            <option value="{{$gender->id}}">{{ $gender->gender_name }}</option>
                                        @endif
                                    @endforeach
                                </select></td>
                        </tr>
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
                    <input type="submit" class="btn btn-danger btn-lg" name="editPost" value="戻る">
                    <input id="submit" type="submit" class="btn btn-primary btn-lg" name="editPost" value="更新" onclick="changeData()">
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
            //なにかしらの処理

            @if(session()->get('phone_order_user_type') == "web")
                var status = "web";
            alert('webだね');
            @else
                var status = "phone";
            alert('phoneだね');
            @endif


/*
            $('#submit').click(function() {
                $(this).parents('form').attr('action', $(this).data('/pizzzzza/order/accept/customer/update/phone'));
                $(this).parents('form').submit();
                alert('submitがおされた！処理する');
            });
            */

            if(status  == "phone")
            {
                alert('phone');
                var element = document.getElementById("updateForm");
                element.setAttribute("action", "/pizzzzza/order/accept/customer/update/phone");
            }else if(status == "web"){
                alert('web');
                var element = document.getElementById("updateForm");
                element.setAttribute("action", "/pizzzzza/order/accept/customer/update/web");
            }
        });

    </script>
@endsection