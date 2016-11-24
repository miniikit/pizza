<?php

namespace App\Http\Middleware;

use Closure;

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
          if (!Auth::check()){
             return redirect('/login'); 
         }
          $authid = session()->get('auth_id');
                 if(!$authid == 4){
                return redirect('/'); //顧客以外のユーザーがアクセスされた場合,顧客側トップページに飛ばす
                 }

        return $next($request);
    }
}
