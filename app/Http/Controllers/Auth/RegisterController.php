<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [             //pega os name (dos inputs) e dá validações para os campos.
            'name' => ['required', 'string', 'max:255'],        //faz a validação antes de salvar no banco de dados
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $nomeArquivo = $data['img']->getClientOriginalName();
        $date = date('y-m-d');
        $nomeArquivo = $date.$nomeArquivo;
        $caminhoImg = "storage/profile/$nomeArquivo";       //concatena o nome do arquivo da imagem. Aqui não precisa todo o caminho das pastas.
        //salva a imagem dentro do storage
        $path = $data['img']->storeAs('public/profile',$nomeArquivo);       //aqui precisa dizer em qual lugar do storage vai salvar e o nome do arquivo.


        return User::create([           //cria métodos dentro do banco de dados.
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),    //criptografar a senha
            'img_profile' => $caminhoImg,           //aqui troca o $caminhoImg 
            'active' => 1
        ]);
    }
}
