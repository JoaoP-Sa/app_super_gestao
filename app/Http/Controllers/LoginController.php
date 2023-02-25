<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;

class LoginController extends Controller
{
    public function index(Request $request) {
        $titulo = 'Login';
        $erro = $request->get('erro');

        if ($request->get('erro') == 1) {
            $erro = 'Usuário e/ou senha não existe.';
        }

        if ($request->get('erro') == 2) {
            $erro = 'Necessário realizar login para ter acesso a página.';
        }

        return view('site.login', compact('titulo', 'erro'));
    }

    public function autenticar(Request $request) {
        // return 'Chegamos até aqui!';

        // regras de validação
        $regras = [
            'usuario' => 'email',
            'senha'   => 'required',
        ];


        // mensagens de feedback de validação
        $feedback = [
            'usuario.email'  => 'O campo usuário (email) é obrigatório',
            'senha.required' => 'O campo senha é obrigatório',
        ];

        // se não passar pelo validate
        $request->validate($regras, $feedback);

        $email = $request->get('usuario');
        $password = $request->get('senha');


        // iniciar model user
        $user = new User();

        $usuario = $user->where('email', $email)
                        ->where('password', $password)
                        ->get()
                        ->first();


        if (isset($usuario->name)) {
            //dd($usuario);

            session_start();

            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;

            //dd($_SESSION);

            return redirect()->route('app.home');
        }

        return redirect()->route('site.login', ['erro' => 1]);
    }

    public function sair() {
        session_destroy();
        return redirect()->route('site.index');
    }
}
