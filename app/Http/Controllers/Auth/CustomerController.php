<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CustomerController extends Controller
{
    public function login(Request $request){
        //リクエストを取得
        $email = $request->get('email');
        $password = $request->get('password');
        $remember = $request->get('remember');

        //DBからメアドが一致するやつを取得
        $pizza = DB::table('users')->where('users.email',$email)->get();;

        //DB結果をカウントし、件数が１件でなければ、エラー処理
        $count = count($pizza);
        if($count != 1){
        return "メール登録されていません。";
        }

        
        $userinfo = $pizza[0];
        //dd($userinfo);
        $authId = $userinfo->authority_id;

        if($authId === 1 || $authId === 2 || $authId === 3){
            if(Auth::attempt(['email' => $email, 'password' => $password ],$remember)){

                return "ログイン成功"; //メール、パスワード、権限がすべて一致した場合

            }else{
                return "メールアドレスまたはパスワードが間違っています"; //メール、パスワードが一致していない場合
            }
        
        }else{
            return "権限がありません"; //権限が４の場合
        }
        
    }

        public function logout(Request $request){ //ログアウト処理
            $this->guard()->logout();

            $request->session()->flush();

            $request->session()->regenerate();

            return redirect('/');
        }

    }
}
