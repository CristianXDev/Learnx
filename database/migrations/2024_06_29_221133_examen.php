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

        Schema::create('examenes', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('profesor_id');
            $table->foreign('profesor_id')->references('id')->on('users');
            $table->string('nombre');
            $table->text('descripcion');
            $table->enum('tipo', ['clasico', 'multiple']);
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('lim_tiempo')->nullable();
            $table->enum('estatus', ['activo', 'inactivo']);
            $table->unsignedBigInteger('materia_id');
            $table->foreign('materia_id')->references('id')->on('materias');
            $table->unsignedBigInteger('submateria_id');
            $table->foreign('submateria_id')->references('id')->on('submaterias');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{

        Schema::dropIfExists('examenes');
    }
};
