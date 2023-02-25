<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFornecedoresNovasColunas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fornecedores', function (Blueprint $table) {
            $table->string('uf', 2);
            $table->string('email', 150);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fornecedores', function (Blueprint $table) {
            // $table->dropColumn('uf');
            // $table->dropColumn('email');

            $table->dropColumn(['uf', 'email']);

            // o dropcolumn, como visto acima, pode tanto receber o nome das colunas
            // individualmente quanto receber um array com o nome das colunas que serão
            // removidas, é interessante notar também que as colunas que o método down serve para
            // revertermos o que for feito no método up, então as colunas que estamos removendo
            // por aqui são as criadas dentro do up
        });
    }
}
