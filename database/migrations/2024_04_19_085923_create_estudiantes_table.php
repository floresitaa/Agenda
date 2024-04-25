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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('ci')->unsigned();
            $table->integer('rude')->unsigned();
            $table->string('direccion', 50)->nullable();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('curso_id')
                ->nullable()
                ->constrained('cursos')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('tutor1_ci')
                ->nullable()
                ->constrained('tutors', 'ci')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('tutor2_ci')
                ->nullable()
                ->constrained('tutors', 'ci')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
