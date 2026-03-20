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
        Schema::create('filmes', function (Blueprint $table) {
    $table->id();
    $table->string('nome',200);
    $table->string('capa',255)->nullable();
    $table->string('ano',200);
    $table->string('duracao',200);
    $table->string('nota',200);
    $table->string('genero',200);

    $table->foreignId('diretores_id')
          ->constrained('diretores')
          ->onDelete('cascade');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filmes');
    }
};
