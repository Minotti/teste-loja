<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtributoValoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atributo_valores', function (Blueprint $table) {
            $table->id();
            $table->string('nome');

            $table->foreignId('atributo_id');
            $table->foreign('atributo_id')->references('id')->on('atributos');

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
        Schema::table('atributo_valores', function (Blueprint $table) {
            $table->dropForeign(['atributo_id']);
        });

        Schema::dropIfExists('atributo_valores');
    }
}
