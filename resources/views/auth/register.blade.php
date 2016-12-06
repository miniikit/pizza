@extends('template.auth')

@section('title', '新規登録')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
    <link rel="stylesheet" href="/css/auth/register/index.css" media="all" title="no title">
@endsection

@section('js')
<script type="text/javascript" src="https://ajaxzip3.github.io/ajaxzip3.js" charset="utf-8"></script>
<script src="/js/common/autokana/jquery.autoKana.js" language="javascript" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(
function() {
$.fn.autoKana('#name', '#kana', {
katakana : true  //true：カタカナ、false：ひらがな（デフォルト）
});
});
</script>
@endsection

@section('main')
<div class="container">
  <div class="text-center">
    <h1 style="">新規会員登録</h1>
  </div>
    <div class="row">
        <div class="col-md-12 col-md-offset-1">
            <div class="">
                <div class="">
                    <form class="" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}
                        <div class="">
                          下記の通りに入力してください<br>
                          <font color="#FF0000">※</font>の項目は必ず入力してください
                        </div>
                        <table class="table regist_table">
                          <tr>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                          <th style="width:17%;">
                            <label for="name" class="">氏名<font color="#FF0000">※</font></label>
                            </th>
                            <td>
                            <div class="col-md-4">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"  required autofocus>
                              </div>
                              <div class="regist_explain">
                                <span class="">例)情報太郎</span>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
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
                                <input id="kana" type="text" class="form-control" name="kana" value="{{ old('name') }}"  required autofocus>
                              </div>
                              <div class="regist_explain">
                                <span class="">例)ジョウホウタロウ</span>
                                @if ($errors->has('kana'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kana') }}</strong>
                                    </span>
                                @endif
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
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                </div>
                                <div class="regist_explain">
                                <span  class="">例)oic@example.com</span>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
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
                                <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                                <div class="regist_explain">
                                <span class="">数字とアルファベット大文字を一文字ずつ、6文字以上入力してください。</span>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            </td>
                        </div>
                      </tr><tr>
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                          <th>
                            <label for="password-confirm" class="">確認パスワード<font color="#FF0000">※</font></label>
                            </th>
                            <td>
                            <div class="col-md-4">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                                <div class="regist_explain">
                                  <span class="">確認の為、もう一度入力してください。</span>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div></td>
                        </div></tr><tr>
                          <th>
                          <label for="postal" class="control-label">郵便番号 (半角)<font color="#FF0000">※</font></label>
                        </th><td><div class="form-group">
                          <div class="col-sm-2 form-inline">
                            <input type="text" class="form-control" name="postal" onKeyup="this.value=this.value.replace(/[^0-9]+/i,'')" size="5" maxlength="7"
                      onKeyup="AjaxZip3.zip2addr('postal','','pref','address1');">
                      </div>
                      <div class="col-sm-2 form-inline">
                      <input type="button" class="form-control" name="postal" onClick="AjaxZip3.zip2addr('postal','','pref','address1');" value="〒→変換" onKeyup="AjaxZip3.zip2addr('postal','','pref','address1');">
                    </div><div class="col-sm-1 regist_explain">
                      <span class="">例)0000000</span>
                    </div></div>
                </td></tr><tr>
                  <div class="form-group{{ $errors->has('pref') ? ' has-error' : '' }}">
                    <th>
                    <label for="pref" class="">都道府県<font color="#FF0000">※</font></label>
                  </th><td>
                    <div class="col-md-2">
                      <select class="form-control" name="pref">
            <option value="">---------------------------------</option>
            <option value="北海道">北海道</option>
            <option value="青森県">青森県</option>
            <option value="岩手県">岩手県</option>
            <option value="宮城県">宮城県</option>
            <option value="秋田県">秋田県</option>
            <option value="山形県">山形県</option>
            <option value="福島県">福島県</option>
            <option value="茨城県">茨城県</option>
            <option value="栃木県">栃木県</option>
            <option value="群馬県">群馬県</option>
            <option value="埼玉県">埼玉県</option>
            <option value="千葉県">千葉県</option>
            <option value="東京都">東京都</option>
            <option value="神奈川県">神奈川県</option>
            <option value="新潟県">新潟県</option>
            <option value="富山県">富山県</option>
            <option value="石川県">石川県</option>
            <option value="福井県">福井県</option>
            <option value="山梨県">山梨県</option>
            <option value="長野県">長野県</option>
            <option value="岐阜県">岐阜県</option>
            <option value="静岡県">静岡県</option>
            <option value="愛知県">愛知県</option>
            <option value="三重県">三重県</option>
            <option value="滋賀県">滋賀県</option>
            <option value="京都府">京都府</option>
            <option value="大阪府">大阪府</option>
            <option value="兵庫県">兵庫県</option>
            <option value="奈良県">奈良県</option>
            <option value="和歌山県">和歌山県</option>
            <option value="鳥取県">鳥取県</option>
            <option value="島根県">島根県</option>
            <option value="岡山県">岡山県</option>
            <option value="広島県">広島県</option>
            <option value="山口県">山口県</option>
            <option value="徳島県">徳島県</option>
            <option value="香川県">香川県</option>
            <option value="愛媛県">愛媛県</option>
            <option value="高知県">高知県</option>
            <option value="福岡県">福岡県</option>
            <option value="佐賀県">佐賀県</option>
            <option value="長崎県">長崎県</option>
            <option value="熊本県">熊本県</option>
            <option value="大分県">大分県</option>
            <option value="宮崎県">宮崎県</option>
            <option value="鹿児島県">鹿児島県</option>
            <option value="沖縄県">沖縄県</option>
        </select>
      </div>
        <div class="regist_explain">
      <span class="">例)大阪府</span>
    </div>
    </td>
  </div>
</tr><tr>
<div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
  <th>
 <label for="address1" class="">市区町村 (全角)<font color="#FF0000">※</font></label>
 </th><td>
  <div class="col-md-4">
   <input type="text" class="form-control" name="address1" size="40">
   </div>
   <div class="regist_explain">
   <span class="">例)大阪市天王寺区上本町</span>
  </div>
</td>
 </div>
</tr><tr>
<div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
  <th>
  <label for="address2" class="">町名・番地 (全角)<font color="#FF0000">※</font></label>
</th><td>
   <div class="col-md-4">
    <input type="text" class="form-control" name="address2" size="40">
    </div>
    <div class="regist_explain">
    <span class="">例)６－８－４</span>
  </div>
</td>
 </div></tr><tr>
<div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
  <th>
 <label for="address3" class="">建物名 (全角)</label>
 </th><td>
  <div class="col-md-4">
   <input type="text" class="form-control" name="address3" size="40">
 </div>
 <div class="regist_explain">
   <span class="">例)大阪情報コンピュータ専門学校</span>
</div>
</td>
</div></tr><tr>
      <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
        <th>
                            <label for="phone" class="">電話番号<font color="#FF0000">※</font></label>
                          </th><td>
                            <div class="col-md-2">
                                <input id="phone" type="text" class="form-control" name="phone" onKeyup="this.value=this.value.replace(/[^0-9]+/i,'')" maxlength="11" value="{{ old('phone') }}" required>
                              </div>
                              <div class="regist_explain">
                                <span class="">例)0663400017　のようにハイフンを付けずに入力してください。</span>
                            </div>
                          </td></div></tr><tr>
                            <div class="form-group{{ $errors->has('gender_id') ? ' has-error' : '' }}">
                              <th>
                              <label for="gender_id" class="">性別<font color="#FF0000">※</font></label>
                            </th><td><div class="">
                              <div class="col-sm-2">
                 <label for="gender" class="radio-inline"><input type="radio" name="gender_id" class="radio" value="1" />男性</label>
               </div>
        <div class="col-sm-2">
                  <label for="gender" class="radio-inline"><input type="radio" name="gender_id" class="radio" value="2"  />女性</label>
         </div>
         <div class="regist_explain">
           <span class="">必ずどちらかを選択してください。</span>
         </div></div></td></tr><tr>
         <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
           <th>
                            <label for="birthday" class="">誕生日<font color="#FF0000">※</font></label>
                          </th><td>
                            <div class="col-md-3">
                                <input type="date" class="form-control" name="birthday" value="{{ old('birthday') }}" required>
                              </div>
                              <div class="regist_explain">
                                <span class="">西暦で入力してください</span>
                            </div></td>
                        </div></tr>
                      </table>
   <div class="form-group{{ $errors->has('authority_id') ? ' has-error' : '' }}">
   <input type="hidden" name="authority_id" value="3">
   </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    次へ
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
