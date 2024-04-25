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
        Schema::create('materiaprofesors', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('profesor_id');
            $table->foreign('profesor_id')->references('id')->on('profesors');
            $table->unsignedInteger('materia_id');
            $table->foreign('materia_id')->references('id')->on('materias');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiaprofesors');
    }
};
