@extends('template.auth') @section('title', '新規登録確認') @section('css')
<link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
<link rel="stylesheet" href="/css/auth/register/index.css" media="all" title="no title"> @endsection @section('js')
<script type="text/javascript" src="https://ajaxzip3.github.io/ajaxzip3.js" charset="utf-8"></script>
<script src="/js/common/autokana/jquery.autoKana.js" language="javascript" type="text/javascript"></script>
@endsection @section('main')
<div class="container">
  <div class="text-center">
    <h1>新規会員登録確認</h1>
  </div>
    <div class="row">
             <form role="form" method="POST" action="{{ url('/register/complete') }}">
             {{ csrf_field() }}
             <p>下記の内容で通りに登録します。</p>
                    
        <table class="table table-responsive">
            <tbody>
                <tr>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <th><label for="name">氏名<font style="red">※</font></label></th>
                        <td class="form-inline">
    <div class="text-center">
        <h1 style="">新規会員登録確認</h1>
    </div>
    <div class="row">
        <div class="col-md-9 col-md-offset-1">
            <div class="">
                <div class="">
                    <form class="" role="form" method="POST" action="{{ url('/register/complete') }}">
                        {{ csrf_field() }}
                        <div class="">
                            下記の内容で通りに登録します。<br>
                        </div>
                        <table class="table regist_table regist_confirm">

                          <tr>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <th>
                            <label for="name" class="">氏名<font color="#FF0000">※</font></label>
                            </th>
                            <td>
                            <div class="col-md-4">
                              <h4>{{ $data['name'] }}</h4>
                        </td>
                   </div>
               </tr>
               <tr>
                    <div class="form-group{{ $errors->has('kana') ? ' has-error' : '' }}">
                    <th><label for="kana" class="">カナ<font style="red">※</font></label></th>
                        <td class="form-inline">
                              <h4>{{ $data['kana'] }}</h4>
                        </td>
                   </div>
               </tr>
               <tr>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <th><label for="email" class="">Eメールアドレス<font style="red">※</font></label></th>
                        <td class="form-inline">
                              <h4>{{ $data['email'] }}</h4>
                        </td>
                   </div>
               </tr>
               <tr>
                    <th><label for="postal" class="control-label">郵便番号 (半角)<font style="red">※</font></label></th>
                    <td class="form-inline">
                              <h4>{{ $data['postal'] }}</h4>
                    </td>
               </tr>
               <tr>
                    <div class="form-group{{ $errors->has('pref') ? ' has-error' : '' }}">
                    <th><label for="pref" class="">都道府県<font style="red">※</font></label></th>
                        <td class="form-inline">
                        
                              <h4>{{ $data['pref'] }}</h4>
                        </td>
                   </div>
               </tr>
               <tr>
                    <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                    <th><label for="address1" class="">市区町村 (全角)<font style="red">※</font></label></th>
                        <td class="form-inline">
                              <h4>{{ $data['address1'] }}</h4>
                        </td>
                   </div>
               </tr>
               <tr>
                    <div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
                    <th><label for="address2" class="">町名・番地 (全角)<font style="red">※</font></label></th>
                        <td class="form-inline">
                              <h4>{{ $data['address2'] }}</h4>
                        </td>
                   </div>
               </tr>
               <tr>
                    <div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
                    <th><label for="address3" class="">建物名 (全角)</label></th>
                        <td class="form-inline">
                              <h4>{{ $data['address3'] }}</h4>
                        </td>
                   </div>
               </tr>
               <tr>
                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <th><label for="phone" class="">電話番号<font style="red">※</font></label></th>
                        <td class="form-inline">
                              <h4>{{ $data['phone'] }}</h4>
                        </td>
                   </div>
               </tr>
               <tr>
                    <div class="form-group{{ $errors->has('gender_id') ? ' has-error' : '' }}">
                    <th><label for="gender_id" class="">性別<font style="red">※</font></label></th>
                        <td class="form-inline">
                              <h4>{{ $data['gender_id'] }}</h4>
                        </td>
                   </div>
               </tr>
               <tr>
                    <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                    <th><label for="birthday" class="">誕生日<font style="red">※</font></label></th>
                        <td class="form-inline">
                              <h4>{{ $data['birthday'] }}</h4>
                        </td>
                   </div>
               </tr>
        </tbody>
 </table>
 
    <div class="form-group{{ $errors->has('authority_id') ? ' has-error' : '' }}">
        <input type="hidden" name="authority_id" value="3">
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary">登録</button>
    </div>
  </form>
 </div>
</div>
@endsection
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
