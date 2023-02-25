<?php

namespace App\Http\Middleware;

use Closure;

class AutenticacaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $metodo_autenticacao, $perfil)
    {
        // echo $metodo_autenticacao.' - '.$perfil.'<br />';
        // // verifica se o usuário possui acesso a rota
        // if ($metodo_autenticacao == 'padrao') {
        //     echo "Verificar o usuário e senha no banco de dados - $perfil<br />";
        // }

        // if ($metodo_autenticacao == 'ldap') {
        //     echo "Verificar o usuário e senha no AD - $perfil<br />";
        // }

        // if ($perfil == 'visitante') {
        //     echo 'Exibir apenas alguns recursos';
        // } else {
        //     echo 'Carregar o perfil do banco de dados';
        // }

        // if (false) {
        //     return $next($request);
        // }

        // return Response('Acesso negado! Rota exige autenticação !!!');

        session_start();

        if (isset($_SESSION['email']) && $_SESSION['email'] != '') {
            return $next($request);
        }

        return redirect()->route('site.login', ['erro' => 2]);
    }
}
