<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
            //ログインしていない
       if (!Auth::check()){
        
            return redirect('pizzzzza/login'); 
        
        //　ログインしている
        }else{

            $authid = 0;

            //　 auth_id　を取得する
            if(session()->has('auth_id')){
                $authid = session()->get('auth_id');
            }

            // auth_idが 2(権限付き従業員）　なら
            if($authid == 2){
                 return redirect('/');
            }

             // auth_idが 3(従業員）　なら
            if($authid == 3){
                 return redirect('/');
            }

            //　 auth_idが 1/4（管理者、顧客）　なら 
            if($authid == 1 || $authid == 4){
                 //　正常時の処理
                return $next($request);
            }
        }

        //　異常処理（通常はたどり着かない
            return redirect('/');
    }
}
