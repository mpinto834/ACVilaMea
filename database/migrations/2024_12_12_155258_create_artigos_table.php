<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtigosTable extends Migration
{
    public function up()
    {
        Schema::create('artigos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->integer('stock')->default(0);
            $table->decimal('preco', 8, 2);
            $table->string('imagem');
            $table->foreignId('tipo_artigo_id')->constrained('tipos_artigos');
            $table->json('tamanhos_stock')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('artigos');
    }
}