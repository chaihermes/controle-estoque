<?php

namespace App\Http\Middleware;

use Closure;
use Auth;   //tudo que for usuário logado, usa o Auth.

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    //o método handle usa o closure pra deixar passar o usuário logado.
    //o next $request passou pela validação e permite que o usuário continue.
    //o Auth recupera as informações (como a session)

    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        //se o usuário estiver logado, ele deixa passar
        //se não estiver logado, redireciona para a página de login.
        if($user){
            return $next($request);
        } else {
            return redirect('/login');
        }
    }
    
}
