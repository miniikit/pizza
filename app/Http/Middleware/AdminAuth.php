<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
     /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
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
            
            // auth_idが 4（会員）　なら
            if($authid == 4){
                 return redirect('/');
            }

            // auth_idが 0　（異常処理）　なら
            if($authid == 0){
                 return redirect('/');
            }

            //　 auth_idが 1/2/3（定員）　なら 
            if($authid == 1 || $authid == 2 || $authid == 3){
                 //　正常時の処理
                return $next($request);
            }

        }

        //　異常処理（通常はたどり着かない
            return redirect('/');
    }


}


