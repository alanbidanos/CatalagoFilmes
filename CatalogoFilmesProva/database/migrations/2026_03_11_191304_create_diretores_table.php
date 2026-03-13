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
        Schema::create('diretores', function (Blueprint $table) {
            $table->id();
            $table->string('nome',100);
            $table->string('nascimento',20);
            $table->string('idade',20);
            $table->string('pais',40);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diretores');
    }
};
