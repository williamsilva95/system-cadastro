<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadastroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cadastro', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('message');
            $table->string('email');
            $table->string('file');
            $table->string('telephone');
            $table->string('ip_address');
            $table->integer('total_gostei')->default(0);
            $table->integer('total_naogostei')->default(0);
            $table->integer('total_visualizacao')->default(0);
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
        Schema::dropIfExists('cadastro');
    }
}
