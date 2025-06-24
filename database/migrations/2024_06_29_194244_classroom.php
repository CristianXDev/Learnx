<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{

        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->text('foto')->nullable();
            $table->string('nombre');
            $table->text('descripcion');
            $table->unsignedBigInteger('profesor_id');
            $table->foreign('profesor_id')->references('id')->on('users');
            $table->unsignedBigInteger('materia_id');
            $table->foreign('materia_id')->references('id')->on('materias');
            $table->string('codigo_acceso');
            $table->enum('estatus', ['activo', 'inactivo']);
            $table->enum('tipo', ['publico', 'privado']);
            $table->integer('max_estudiantes')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{

        Schema::dropIfExists('classrooms');
    }
};
