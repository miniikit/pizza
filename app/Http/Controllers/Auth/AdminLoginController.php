<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{

public function form(){
    if(Auth::check()){
        return redirect()->route('orderTop');
    }
    return view('pizzzzza.login');
}

public function login(Request $request) {
    //リクエストを取得
    $email = $request->get('email');
    $password = $request->get('password');

    //DBからメアドが一致するやつを取得
    $userinfo = DB::table('users')->where('users.email',$email)->first();
    $userid = $userinfo->id;
    $employeeinfo = DB::table('employees_master')->where('employees_master.users_id','=',$userid)->where('employees_master.deleted_at','=',null)->first();

    //　会員情報がなければエラー処理
    if(!$userinfo){
     flash('メールアドレスが登録されていません。', 'danger');
     return redirect('/pizzzzza/login');
    }
    
     // アカウントが無効化されていた場合の処理
    if(!$employeeinfo){
     flash('アカウントが無効化されています。', 'danger');
     return redirect('/pizzzzza/login');
    }

    //権限を取得。
    $authId = $userinfo->authority_id;

    if($authId === 1 || $authId === 2){
        if(Auth::attempt(['email' => $email, 'password' => $password ])){

            session()->put('auth_id',$authId);
           flash('ログインしました。', 'success');
           return redirect('pizzzzza/order'); //メール、パスワード、権限がすべて一致した場合
            
        }else{
            flash('メールアドレスまたはパスワードが間違っています', 'danger'); 
            return redirect('/pizzzzza/login'); //メール、パスワードが一致していない場合
      }
    
    }else{
        flash('ログインする権限がありません', 'danger'); 
        return redirect('/pizzzzza/login');  //権限が４の場合
    }
}
    public function logout(Request $request){ //ログアウト処理
        Auth::logout();

        $request->session()->flush();

        $request->session()->regenerate();
        return redirect('/pizzzzza/login');
    }

}