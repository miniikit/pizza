@extends('template.master')

@section('title', '新規登録')

@section('css')
    <link rel="stylesheet" href="/css/pages/index.css" media="all" title="no title">
    <link rel="stylesheet" href="/css/mypage/detail.css" media="all" title="no title">
@endsection

@section('js')
    <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
@endsection

@section('main')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">氏名</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" maxlength="50" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                            <div class="form-group{{ $errors->has('kana') ? ' has-error' : '' }}">
                            <label for="kana" class="col-md-4 control-label">カナ</label>

                            <div class="col-md-6">
                                <input id="kana" type="text" class="form-control" name="kana" maxlength="100" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('kana'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('kana') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Eメールアドレス</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" maxlength="256" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">パスワード</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" maxlength="128" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">確認パスワード</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" maxlength="128" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

 <div class="form-group{{ $errors->has('postal') ? ' has-error' : '' }}">
  <label for="postal" class="col-md-4 control-label">郵便番号 (半角)</label>

   <div class="col-md-2">
    <input type="text" class="form-control" name="postal" size="4" maxlength="3">
    </div>

    <div class="col-md-2">
     <input type="text" class="form-control" name="postal" size="5" maxlength="4">
      </div>
      <input type="button" class="btn btn-default" value="〒→変換" onClick="AjaxZip3.zip2addr('postal','postal','pref','address1','address2')"
                    onkeyup="AjaxZip3.zip2addr('postal','postal','pref','address1','address2');">
    </div>



<div class="form-group{{ $errors->has('pref') ? ' has-error' : '' }}">
 <label for="pref" class="col-md-4 control-label">都道府県</label>
  <div class="col-md-6">
            <select class="form-control" name="pref">
            <option value="">-- 選択してください --</option>
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
</div>

<div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
 <label for="address1" class="col-md-4 control-label">市区町村 (全角)</label>
  <div class="col-md-5">
   <input type="text" class="form-control" name="address1" size="40">
  </div>
 </div>

<div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
  <label for="address2" class="col-md-4 control-label">町名・番地 (全角)</label>
   <div class="col-md-5">
    <input type="text" class="form-control" name="address2" size="40">
  </div>
 </div>

<div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
 <label for="address3" class="col-md-4 control-label">建物名 (全角)</label>
  <div class="col-md-5">
   <input type="text" class="form-control" name="address3" size="40">
</div>
</div>

      <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">電話番号</label>

                            <div class="col-md-6">
                                <input id="phone" type="number" class="form-control" name="phone" value="{{ old('phone') }}" required>

                            </div>
                        </div>


<div class="form-group{{ $errors->has('gender_id') ? ' has-error' : '' }}">
  <label for="gender_id" class="col-md-4 control-label">性別</label> 
       <div class="col-sm-3">
                 <input type="radio" name="gender_id" value="1" />男性
        </div>
        <div class="col-sm-3">
             <label class="radio-inline">
                  <input type="radio" name="gender_id" value="2"  />女性
         </div>
   </div>

   <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                            <label for="birthday" class="col-md-4 control-label">誕生日</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="birthday" value="{{ old('birthday') }}" required>

                            </div>
                        </div>

   <div class="form-group{{ $errors->has('authority_id') ? ' has-error' : '' }}">
   <input type="hidden" name="authority_id" value="4">
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
