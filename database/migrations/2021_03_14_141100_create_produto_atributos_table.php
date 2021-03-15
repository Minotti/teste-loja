<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutoAtributosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_atributos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('produto_id');
            $table->foreign('produto_id')->references('id')->on('produtos');

            $table->foreignId('atributo_valor_id');
            $table->foreign('atributo_valor_id')->references('id')->on('atributo_valores');

            $table->foreignId('produto_estoque_id');
            $table->foreign('produto_estoque_id')->references('id')->on('produto_estoques');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produto_atributos', function (Blueprint $table) {
            $table->dropForeign(['produto_id']);
            $table->dropForeign(['atributo_valor_id']);
            $table->dropForeign(['produto_estoque_id']);
        });

        Schema::dropIfExists('produto_atributos');
    }
}
