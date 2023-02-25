<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\MotivoContato;

class PrincipalController extends Controller
{
    public function principal() {
        $motivo_contatos = MotivoContato::all();

        $titulo = 'Home';

        return view('site/principal', compact('titulo', 'motivo_contatos'));
    }
}
