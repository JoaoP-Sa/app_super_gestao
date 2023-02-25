<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemDetalhe extends Model
{
    protected $table = 'produto_detalhes';
    protected $fillable = ['produto_id', 'comprimento', 'largura', 'altura', 'unidade_id'];

    public function item() {
        return $this->belongsTo('\App\Item', 'produto_id', 'id'); // a diferença maior entre o
                                // hasOne() e o belongsTo() é que no hasOne() colocamos as colunas
                                // da tabela que estamos usando, enquanto no belongsTo() colocamos
                                // as colunas da tabela externa que estamos selecionando
    }
}
