@extends('template.auth')

@section('title', '本登録確認')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
    <link rel="stylesheet" href="/css/auth/register/index.css" media="all" title="no title">
@endsection

@section('js')
<script type="text/javascript" src="https://ajaxzip3.github.io/ajaxzip3.js" charset="utf-8"></script>
<script src="/js/common/autokana/jquery.autoKana.js" language="javascript" type="text/javascript"></script>
@endsection

@section('main')
<div class="container">
  <div class="text-center">
    <h1 style="">新規会員登録確認</h1>
  </div>
    <div class="row">
        <div class="col-md-9 col-md-offset-1">
            <div class="">
                <div class="">
                    <form class="" role="form" method="POST" action="{{ url('/register') }}">
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
                              <p><!-- 名前 --></p>
                              </div>
                            </td>
                        </div>
                        </tr>
                        <tr>
                            <div class="form-group{{ $errors->has('kana') ? ' has-error' : '' }}">
                              <th>
                            <label for="kana" class="">カナ<font color="#FF0000">※</font></label>
                            </th>
                            <td>
                            <div class="col-md-4">
                              <p><!-- カナ --></p>
                              </div>
                            </td>
                        </div>
                        </tr>
                        <tr>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                          <th>
                            <label for="email" class="">Eメールアドレス<font color="#FF0000">※</font></label>
                            </th>
                            <td>
                            <div class="col-md-5">
                                <p><!-- メールアドレス --></p>
                              </div>
                            </td>
                        </div>
                      </tr><tr>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                          <th>
                            <label for="password" class="">パスワード<font color="#FF0000">※</font></label>
                          </th>
                          <td>
                            <div class="col-md-4">
                                <p><!-- パスワード --></p>
                                </div>
                            </td>
                        </div>
                      </tr><tr>
                          <th>
                          <label for="postal" class="control-label">郵便番号 (半角)<font color="#FF0000">※</font></label>
                        </th><td>
                          <div class="col-sm-2 form-inline">
                            <p><!-- 郵便番号 --></p>
                      </div>
                </td></tr><tr>
                  <div class="form-group{{ $errors->has('pref') ? ' has-error' : '' }}">
                    <th>
                    <label for="pref" class="">都道府県<font color="#FF0000">※</font></label>
                  </th><td>
                    <div class="col-md-2">
                      <p><!-- 都道府県 --></p>
      </div>
    </td>
  </div>
</tr><tr>
<div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
  <th>
 <label for="address1" class="">市区町村 (全角)<font color="#FF0000">※</font></label>
 </th><td>
  <div class="col-md-4">
   <p><!--  --></p>
   </div>
</td>
 </div>
</tr><tr>
<div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
  <th>
  <label for="address2" class="">町名・番地 (全角)<font color="#FF0000">※</font></label>
</th><td>
   <div class="col-md-4">
    <p><!--  --></p>
    </div>
</td>
 </div></tr><tr>
<div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
  <th>
 <label for="address3" class="">建物名 (全角)</label>
 </th><td>
  <div class="col-md-4">
   <p><!--  --></p>
 </div>
</td>
</div></tr><tr>
      <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
        <th>
                      <label for="phone" class="">電話番号<font color="#FF0000">※</font></label>
                          </th><td>
                            <div class="col-md-2">
                              <p><!-- 電話番号 --></p>
                            </div>
                          </td></div></tr><tr>
                            <div class="form-group{{ $errors->has('gender_id') ? ' has-error' : '' }}">
                              <th>
                              <label for="gender_id" class="">性別<font color="#FF0000">※</font></label>
                            </th><td><div class="">
                              <div class="col-sm-2">
                 <p><!-- 性別 --></p>
         </div>
         </div></td></tr><tr>
         <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
           <th>
                            <label for="birthday" class="">誕生日<font color="#FF0000">※</font></label>
                          </th><td>
                            <div class="col-md-3">
                                <p><!-- 誕生日 --></p>
                              </div>
                              </td>
                        </div></tr>
                      </table>
   <div class="form-group{{ $errors->has('authority_id') ? ' has-error' : '' }}">
     <input type="hidden" name="authority_id" value="3">
   </div>
   <div class="">
     よろしければ、「登録」を押してください。
   </div>

                        <div class="form-group">
                            <div class="text-center">
                                <a href="auth/register/register" class="btn btn-default btn-lg">
                                  修正
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg">
                                  登録
                                </button>
                              </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
