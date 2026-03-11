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
       Schema::create('avaliacao', function (Blueprint $table) {
            $table->id();
            $table->string('usuario',100);
            $table->foreignId('filmes_id')->constrained('filmes');
            $table->string('comentario',1024);
            $table->string('nota',20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaliacao');
    }
};
