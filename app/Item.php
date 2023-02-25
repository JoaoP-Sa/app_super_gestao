<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'produtos';
    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id', 'fornecedor_id'];

    public function itemDetalhe() {
        return $this->hasOne('\App\ItemDetalhe', 'produto_id', 'id'); // colocamos o nome da coluna
                                // da fk no segundo parâmetro para que o laravel não tente procurar
                                // pelo nome padrão, que nesse caso seria 'item_id' por exemplo, e
                                // no terceiro parâmetro simplesmente colocamos o nome da pk
    }

    public function fornecedor() {
        return $this->belongsTo('\App\Fornecedor');
    }

    public function pedidos() {
        return $this->belongsToMany('App\Pedido', 'pedidos_produtos', 'produto_id', 'pedido_id');

        /*
            3 - Representa o nome da FK da tabela mapeada pelo model na tabela de relacionamento
            4 - Representa o nome da FK da tabela mapeada pelo model utilizado no relacionamento que estamos implementando
        */
    }
}
