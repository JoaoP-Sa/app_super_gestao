<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id'];

    // o método abaixo vai procurar se produto possui produto detalhe
    public function produtoDetalhe() {
        return $this->hasOne('\App\ProdutoDetalhe');

        // produto tem 1 produtoDetalhe

        // 1 registro relacionado em produto_detalhes (fk) -> produto_id
        // produtos (pk) -> id
    }
}
