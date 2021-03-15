<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimentacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimentacoes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('produto_estoque_id');
            $table->foreign('produto_estoque_id')->references('id')->on('produto_estoques');

            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->foreignId('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas');

            $table->smallInteger('anterior');
            $table->smallInteger('entrada');
            $table->smallInteger('atual');

            $table->tinyInteger('tipo')->comment('1 Entrada | 2 Saida');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movimentacoes', function (Blueprint $table) {
            $table->dropForeign(['produto_estoque_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['empresa_id']);
        });

        Schema::dropIfExists('movimentacoes');
    }
}
