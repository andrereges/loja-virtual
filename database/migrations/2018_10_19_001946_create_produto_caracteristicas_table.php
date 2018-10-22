<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutoCaracteristicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_caracteristicas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('caracteristica_id')->unsigned();
            $table->integer('produto_id')->unsigned();
            $table->string('valor');
            $table->foreign('caracteristica_id')->references('id')->on('caracteristicas');
            $table->foreign('produto_id')->references('id')->on('produtos');
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
        Schema::dropIfExists('produto_caracteristicas');
    }
}
