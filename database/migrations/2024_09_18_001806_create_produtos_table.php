<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id('cod_produto');
            $table->string('nome_produto');
            $table->float('valor_produto');
            $table->foreignId('marca_produto')->constrained('marcas', 'cod_marca');
            $table->float('estoque');
            $table->foreignId('cidade')->constrained('cidades', 'cod_cidade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
