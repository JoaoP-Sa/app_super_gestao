<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model
{
    use SoftDeletes;

    protected $table = 'fornecedores';
    protected $fillable = ['nome', 'site', 'uf', 'email'];

    public function produtos() {
        return $this->hasMany('\App\Item', 'fornecedor_id', 'id');

        // return $this->hasMany('\App\Item'); // podemos omitir os 2 últimos parâmetros, mas vamos
        // deixá-los explícitos por questão de aprendizagem
    }
}
