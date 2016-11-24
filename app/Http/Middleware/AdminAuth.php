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
       if (!Auth::check()){
             return redirect('pizzzzza/login'); 
         }
          $authid = session()->get('auth_id');
                 if(!$authid == 1 || !$authid == 2 || !$authid == 3){
                return redirect('/'); //管理者権限以外のユーザーがアクセスされた場合,顧客側トップページに飛ばす
                 }

        return $next($request);
    }
}
