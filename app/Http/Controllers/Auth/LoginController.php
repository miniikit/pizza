<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function login(Request $request) {
    //リクエストを取得
    $email = $request->get('email');
    $password = $request->get('password');
    

    //DBからメアドが一致するやつを取得
    $pizza = DB::table('users')->where('users.email',$email)->get();;

    //DB結果をカウントし、件数が１件でなければ、エラー処理
    $count = count($pizza);
    if($count != 1){
     flash('メールアドレスが登録されていません。', 'danger');
     return redirect('/login');
    }

    //ユーザ表の情報を取得。
    $userinfo = $pizza[0];

    //権限を取得。
    $authId = $userinfo->authority_id;
    
    if($authId == 3){
        if(Auth::attempt(['email' => $email, 'password' => $password ])){

            session()->put('auth_id',$authId);
            return redirect('/'); //メール、パスワード、権限がすべて一致した場合

        }else{
            flash('メールアドレスまたはパスワードが間違っています', 'danger');
            return redirect('/login'); //メール、パスワードが一致していない場合
        }
    
    }else{
        flash('無効なログインです', 'danger');
        return redirect('/login'); //権限が1,2,3の場合
    }
    
}

    public function logout(Request $request) //ログアウト処理
    {
        
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
        
    }
}
