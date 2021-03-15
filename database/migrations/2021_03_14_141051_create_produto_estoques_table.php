<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutoEstoquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_estoques', function (Blueprint $table) {
            $table->id();

            $table->string('nome')->nullable()->comment('Nome Atributo e Atributo Valores concatenados');
            $table->smallInteger('qtd');
            $table->integer('valor_cents');

            $table->foreignId('produto_id');
            $table->foreign('produto_id')->references('id')->on('produtos');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produto_estoques', function (Blueprint $table) {
            $table->dropForeign(['produto_id']);
        });

        Schema::dropIfExists('produto_estoques');
    }
}
