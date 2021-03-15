<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtributosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atributos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');

            $table->foreignId('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas');

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
        Schema::table('atributos', function (Blueprint $table) {
            $table->dropForeign(['empresa_id']);
        });

        Schema::dropIfExists('atributos');
    }
}
