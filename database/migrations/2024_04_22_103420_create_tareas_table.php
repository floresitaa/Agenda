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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_publicacion');
            $table->date('fecha_entrega');
            $table->text('descripcion');
            $table->string('estado');
            $table->text('archivo_url')->nullable();
            $table->unsignedInteger('materiacurso_id');
            $table->foreign('materiacurso_id')->references('id')->on('materiacursos');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
