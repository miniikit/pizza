@extends('template.master')
@section('title', '新規登録確認')
@section('css')
<link rel="stylesheet" href="/css/auth/register/index.css" media="all" title="no title"> @endsection @section('js')
<script type="text/javascript" src="https://ajaxzip3.github.io/ajaxzip3.js" charset="utf-8"></script>
<script src="/js/common/autokana/jquery.autoKana.js" language="javascript" type="text/javascript"></script>
@endsection @section('main')
<div class="container">
    <div class="wrap">
        <div class="main-title">
            <h1>新規会員登録確認</h1>
        </div>
        <div class="register">
            <form role="form" method="POST" action="{{ url('/register/complete') }}">
                {{ csrf_field() }}
                <table id="table">
                    <tbody>
                        <tr>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <th><label for="name">氏名<font class="red">※</font></label></th>
                                <td class="form-inline">
                                    <h4>{{ $data['name'] }}</h4>
                                    <input type="hidden" class="form-control" name="name" value="{{ $data['name'] }}">
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group{{ $errors->has('kana') ? ' has-error' : '' }}">
                                <th><label for="kana">カナ<font class="red">※</font></label></th>
                                <td class="form-inline">
                                    <h4>{{ $data['kana'] }}</h4>
                                    <input type="hidden" class="form-control" name="kana" value="{{ $data['kana'] }}">
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <th><label for="email">Eメールアドレス<font class="red">※</font></label></th>
                                <td class="form-inline">
                                    <h4>{{ $data['email'] }}</h4>
                                    <input type="hidden" class="form-control" name="email" value="{{ $data['email'] }}">
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <th><label for="postal" class="control-label">郵便番号 (半角)<font class="red">※</font></label></th>
                            <td class="form-inline">
                                <h4>{{ $data['postal'] }}</h4>
                                <input type="hidden" class="form-control" name="postal" value="{{ $data['postal'] }}">
                            </td>
                        </tr>
                        <tr>
                            <div class="form-group{{ $errors->has('pref') ? ' has-error' : '' }}">
                                <th><label for="pref">都道府県<font class="red">※</font></label></th>
                                <td class="form-inline">

                                    <h4>{{ $data['pref'] }}</h4>
                                    <input type="hidden" class="form-control" name="pref" value="{{ $data['pref'] }}">
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group{{ $errors->has('address1') ? ' has-error' : '' }}">
                                <th><label for="address1">市区町村 (全角)<font class="red">※</font></label></th>
                                <td class="form-inline">
                                    <h4>{{ $data['address1'] }}</h4>
                                    <input type="hidden" class="form-control" name="address1" value="{{ $data['address1'] }}">
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
                                <th><label for="address2">町名・番地 (全角)<font class="red">※</font></label></th>
                                <td class="form-inline">
                                    <h4>{{ $data['address2'] }}</h4>
                                    <input type="hidden" class="form-control" name="address2" value="{{ $data['address2'] }}">
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group{{ $errors->has('address2') ? ' has-error' : '' }}">
                                <th><label for="address3">建物名 (全角)</label></th>
                                <td class="form-inline">
                                    <h4>{{ $data['address3'] }}</h4>
                                    <input type="hidden" class="form-control" name="address3" value="{{ $data['address3'] }}">
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <th><label for="phone">電話番号<font class="red">※</font></label></th>
                                <td class="form-inline">
                                    <h4>{{ $data['phone'] }}</h4>
                                    <input type="hidden" class="form-control" name="phone" value="{{ $data['phone'] }}">
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group{{ $errors->has('gender_id') ? ' has-error' : '' }}">
                                <th><label for="gender_id">性別<font class="red">※</font></label></th>
                                <td class="form-inline">
                                    <h4>{{ $data['gender_id'] }}</h4>
                                    <input type="hidden" class="form-control" name="gender_id" value="{{ $data['gender_id'] }}">
                                </td>
                            </div>
                        </tr>
                        <tr>
                            <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                                <th><label for="birthday">誕生日<font class="red">※</font></label></th>
                                <td class="form-inline">
                                    <h4>{{ $data['birthday'] }}</h4>
                                    <input type="hidden" class="form-control" name="birthday" value="{{ $data['birthday'] }}">
                                </td>
                            </div>
                        </tr>
                    </tbody>
                </table>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="hidden" class="form-control" name="password" value="{{ $data['password'] }}">
                </div>

                <div class="btn-wrap">
                    <button type="submit" class="btn">登録</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
