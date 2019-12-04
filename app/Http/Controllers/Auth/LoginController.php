<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Socialite;

use App\User;

use Auth;

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


    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');          
    }


    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function receiveDataGoogle(){
        $userGoogle = Socialite::driver('google')->user();
        $userDb = $this->findOrCreateUser($userGoogle);

        //loga o usuário e confirma que ele vai acessar a página já logado.
        Auth::login($userDb, true);

        //aqui vai executar a função redirectTo, que lá em cima, essa função redireciona pra home:
        return redirect($this->redirectTo);
    }

    public function findOrCreateUser($userGoogle){
        //o find é apenas para o id, o where funciona para os outros campos.
        //o first retorna o primeiro registro que tem aquele email.
        $user = User::where('email', $userGoogle->email)->first();
        //validação que o usuário já existe:
        if($user){
            return $user;
        } 

        //se o usuário não existe e vai salvar as informações da API do google
        $newUser = new User();
        $newUser->name = $userGoogle->name;
        $newUser->email = $userGoogle->email;
        $newUser->img_profile = $userGoogle->avatar;
        $newUser->provider_id = $userGoogle->id;
        $newUser->active = 1;

        //salvando as informações no BD:
        $newUser->save();
        return $newUser;
        
    }
}
//middleware: verifica a condição da requisição, se a condição for atendida, a aplicação devolve a resposta ao usuário.