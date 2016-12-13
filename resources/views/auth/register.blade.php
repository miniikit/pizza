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
    <h1 class="text-center title">新規会員登録</h1>
</div>
<div class="row">
    <div class="col-md-12">
        <form role="form" method="POST" action="{{ url('/register/confirm') }}">
        {{ csrf_field() }}
    <font class="red">※</font>の項目は必ず入力してください
<table class="table table-responsive">
    <tbody>
        <tr>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <th class="w17">
                    <label for="name">氏名<font class="red">※</font></label>
                </th>
                    <td class="form-inline">
                      <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                      <span class="example">例)情報太郎</span>
                         @if ($errors->has('name'))
                               <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                               </span>
                         @endif
                    </td>
              </div>
        </tr>
        <tr>
            <div class="form-group{{ $errors->has('kana') ? ' has-error' : '' }}">
                <th class="w17">
                    <label for="kana">カナ<font class="red">※</font></label>
                </th>
                    <td class="form-inline">
                      <input id="kana" type="text" class="form-control" name="kana" value="{{ old('name') }}"  required autofocus>
                      <span class="example">例)ジョウホウタロウ</span>
                         @if ($errors->has('kana'))
                               <span class="help-block">
                                    <strong>{{ $errors->first('kana') }}</strong>
                               </span>
                         @endif
                    </td>
              </div>
        </tr>
        <tr>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <th class="w17">
                    <label for="email">Eメールアドレス<font class="red">※</font></label>
                </th>
                    <td class="form-inline">
                       <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                       <span class="example">例)oic@example.com</span>
                         @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                         @endif
                    </td>
              </div>
        </tr>
        <tr>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <th class="w17">
                    <label for="password">パスワード<font class="red">※</font></label>
                </th>
                    <td class="form-inline">
                       <input id="password" type="password" class="form-control" name="password" required>
                       <span class="example">数字とアルファベット大文字を一文字ずつ、6文字以上入力してください。</span>
                          @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                          @endif
                    </td>
             </div>
        </tr>
        <tr>
            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <th class="w17">
                    <label for="password-confirm">確認パスワード<font class="red">※</font></label>
                </th>
                    <td class="form-inline">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        <span class="example">確認の為、もう一度入力してください。</span>
                           @if ($errors->has('password_confirmation'))
                                 <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                 </span>
                           @endif
                     </td>
              </div>
        </tr>
        <tr>
            <div class="form-group">
                <th class="w17">
                    <label for="postal" class="control-label">郵便番号 (半角)<font class="red">※</font></label>
                </th>
                    <td class="form-inline">
                       <input type="text" class="form-control" name="postal" onKeyup="this.value=this.value.replace(/[^0-9]+/i,'')" size="5" maxlength="7" onKeyup="AjaxZip3.zip2addr('postal','','pref','address1');">
                       <input type="button" class="form-control" name="postal" onClick="AjaxZip3.zip2addr('postal','','pref','address1');" value="〒→変換" onKeyup="AjaxZip3.zip2addr('postal','','pref','address1');">
                       <span class="example">例)0000000</span>
                    </td>
                </tr>
                <tr>
                    <div class="form-group{{ $errors->has('pref') ? ' has-error' : '' }}">
                        <th class="w17">
                            <label for="pref">都道府県<font class="red">※</font></label>
                        </th>
                            <td class="form-inline">
                               <select class="form-control w17" name="pref">
                                  <option>選択してください</option>
                                    @foreach($prefs as $index => $name)
                                        <option value="{{ $name }}">{{$name}}</option>
                                    @endforeach
                               </select>
                               <span class="example">例)大阪府</span>
                            </td>
                      </div>
                </tr>
                <tr>
                    <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                        <th class="w17">
                            <label for="address1">市区町村 (全角)<font class="red">※</font></label>
                        </th>
                            <td class="form-inline"> 
                               <input type="text" class="form-control" name="address1" size="40">
                               <span class="example">例)大阪市天王寺区上本町</span>
                            </td>
                     </div>
                </tr>
                <tr>
                    <div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
                        <th class="w17">
                            <label for="address2">町名・番地 (全角)<font class="red">※</font></label>
                        </th>
                            <td class="form-inline">
                                <input type="text" class="form-control" name="address2" size="40">
                                <span class="example">例)６－８－４</span>
                            </td>
                     </div>
                </tr>
                <tr>
                    <div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
                        <th class="w17">
                            <label for="address3">建物名 (全角)</label>
                        </th>
                            <td class="form-inline">
                                <input type="text" class="form-control" name="address3" size="40">
                                <span class="example">例)大阪情報コンピュータ専門学校</span>
                            </td>
                      </div>
                 </tr>
                 <tr>
                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <th class="w17">
                            <label for="phone">電話番号<font class="red">※</font></label>
                        </th>
                            <td class="form-inline">
                                <input id="phone" type="text" class="form-control" name="phone" onKeyup="this.value=this.value.replace(/[^0-9]+/i,'')" maxlength="11" value="{{ old('phone') }}" required>
                                <span class="example">例)0663400017　のようにハイフンを付けずに入力してください。</span>
                            </td>
                      </div>
                 </tr>
                 <tr>
                    {{ $errors->has('gender_id') ? ' has-error' : '' }}
                        <th class="w17">
                              <label for="gender_id">性別<font class="red">※</font></label>
                        </th>
                            <td class="form-inline">
                                <label for="gender" class="radio-inline"><input type="radio" name="gender_id" class="radio" value="1" />男性</label>
                                <label for="gender" class="radio-inline"><input type="radio" name="gender_id" class="radio" value="2"  />女性</label>
                                <span class="example">必ずどちらかを選択してください。</span>
                            </td>
                       </tr>
                       <tr>
                          <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                              <th class="w17">
                                  <label for="birthday">誕生日<font class="red">※</font></label>
                              </th>
                                <td class="form-inline">
                                   <input type="date" class="form-control" name="birthday" value="{{ old('birthday') }}" required>
                                   <span class="example">西暦で入力してください</span>
                                </td>
                           </div>
                       </tr>
                </tbody>
         </table>
         
         <div class="form-group{{ $errors->has('authority_id') ? ' has-error' : '' }}">
              <input type="hidden" name="authority_id" value="3">
         </div>
              <div class="text-center">
                   <button type="submit" class="btn btn-primary">次へ</button>
              </div>
        </form>
    </div>
</div>
@endsection
