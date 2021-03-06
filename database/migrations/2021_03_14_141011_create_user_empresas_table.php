<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_empresas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas');

            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::table('user_empresas', function (Blueprint $table) {
            $table->dropForeign(['empresa_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('user_empresas');
    }
}
