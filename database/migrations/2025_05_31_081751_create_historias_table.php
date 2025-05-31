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
            Schema::create('historias', function (Blueprint $table) {
        $table->id();
        $table->string('titulo', 150);
        $table->text('descripcion');
        $table->string('responsable', 100);
        $table->enum('estado', ['nueva', 'activa', 'finalizada', 'impedimento'])->default('nueva');
        $table->integer('puntos');
        $table->date('fecha_creacion');
        $table->date('fecha_finalizacion')->nullable();
        $table->foreignId('sprint_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historias');
    }
};
